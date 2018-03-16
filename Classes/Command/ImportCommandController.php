<?php
namespace T3Dev\Programmevents\Command;


use TYPO3\CMS\Core\Utility\DebugUtility;
use TYPO3\CMS\Core\Utility\GeneralUtility;
use TYPO3\CMS\Core\Utility\PathUtility;
use TYPO3\CMS\Extensionmanager\Utility\FileHandlingUtility;
use TYPO3\CMS\Recordlist\Browser\FileBrowser;

/**
 *
 *
 * @license http://www.gnu.org/licenses/gpl.html GNU General Public License, version 3 or later
 *
 */
class ImportCommandController extends \T3Dev\Programmevents\Command\AbstractCommandController
{

    // Table names for domain models
    const EVENT_ITEM_TABLE_NAME = 'tx_programmevents_domain_model_event';
    const LOCATION_ITEM_TABLE_NAME = 'tx_programmevents_domain_model_location';

    // Save to database every COUNT_ITEMS_TO_PERSIST imported items
    const COUNT_ITEMS_TO_PERSIST = 150;

    // Posible values for field processingStatus in Classification model
    const PROCESSING_STATUS_IN_PROGRESS = 'in progress';
    const PROCESSING_STATUS_UPDATED = 'updated';
    const PROCESSING_STATUS_CREATED = 'created';

    /**
     * eventRepository
     *
     * @var \T3Dev\Programmevents\Domain\Repository\EventRepository
     * @inject
     */
    protected $eventRepository = null;

    /**
     * locationRepository
     *
     * @var \T3Dev\Programmevents\Domain\Repository\LocationRepository
     * @inject
     */
    protected $locationRepository = null;

    /**
     * @var int
     */
    protected $pid;


    /**
     * Parse 'Event' item
     *
     * @param SimpleXMLElement $xmlItem Item from XML
     */
    public function parseEvent($xmlItem)
    {
        $id = intval($xmlItem->id);

        $repository = $this->eventRepository;
        $modelItem = $repository->findOneById($id);

        // if record not found, then create it
        if (!$modelItem || $modelItem->getPid() != $this->pid) {
            $modelItem = GeneralUtility::makeInstance('T3Dev\Programmevents\Domain\Model\Event');
            $action = "Create";
            $modelItem->setId($id);
            $modelItem->setPid($this->pid);
        } else {
            $action = "Update";
        }

        $title = strval($xmlItem->title);
        $type = strval($xmlItem->type);
        $datebegin = strval($xmlItem->datebegin);
        $timebegin = strval($xmlItem->timebegin);
        $formatteddate = strval($xmlItem->formatteddate);
        $weekdaybegin = strval($xmlItem->weekdaybegin->long);
        //$categories = strval($xmlItem->categories);
        $image = strval($xmlItem->image->file);

        $modelItem->setTitle($title);
        $modelItem->setType($type);
        $modelItem->setDatebegin($datebegin);
        $modelItem->setTimebegin($timebegin);
        $modelItem->setFormatteddate($formatteddate);
        $modelItem->setWeekdaybegin($weekdaybegin);
        //$modelItem->setCategories($categories);
        $modelItem->setImage($image);

        // Parse location
        $locationId = intval($xmlItem->location->id);
        $name = strval($xmlItem->location->name);
        $address = strval($xmlItem->location->address);
        $city = strval($xmlItem->location->city);
        $zipcode = strval($xmlItem->location->zipcode);
        $xcoordinate = strval($xmlItem->location->geocoding->xcoordinate);
        $ycoordinate = strval($xmlItem->location->geocoding->ycoordinate);
        $portal = strval($xmlItem->location->geocoding->portal);

        $locationModelItem = $this->locationRepository->findOneById($locationId);
        if (!$locationModelItem || $locationModelItem->getPid() != $this->pid) {
            $locationModelItem = GeneralUtility::makeInstance('T3Dev\Programmevents\Domain\Model\Location');
            $locationModelItem->setPid($this->pid);
            $locationModelItem->setProcessingStatus(self::PROCESSING_STATUS_CREATED);

            $locationModelItem->setId($locationId);
            $locationModelItem->setName($name);
            $locationModelItem->setAddress($address);
            $locationModelItem->setCity($city);
            $locationModelItem->setZipcode($zipcode);
            $locationModelItem->setXcoordinate($xcoordinate);
            $locationModelItem->setYcoordinate($ycoordinate);
            $locationModelItem->setPortal($portal);

            $locationModelItem->addEvent($modelItem);

            $this->locationRepository->add($locationModelItem);
        } else {
            $locationModelItem->setPid($this->pid);
            $locationModelItem->setProcessingStatus(self::PROCESSING_STATUS_UPDATED);

            $locationModelItem->setId($locationId);
            $locationModelItem->setName($name);
            $locationModelItem->setAddress($address);
            $locationModelItem->setCity($city);
            $locationModelItem->setZipcode($zipcode);
            $locationModelItem->setXcoordinate($xcoordinate);
            $locationModelItem->setYcoordinate($ycoordinate);
            $locationModelItem->setPortal($portal);

            $locationModelItem->addEvent($modelItem);

            $this->locationRepository->update($locationModelItem);
        }

        $modelItem->setLocation($locationModelItem);

        // create or update record
        if ($action === "Create") {
            // new record
            $modelItem->setProcessingStatus(self::PROCESSING_STATUS_CREATED);
            $repository->add($modelItem);
        } else {
            // update existing record
            $modelItem->setProcessingStatus(self::PROCESSING_STATUS_UPDATED);
            $repository->update($modelItem);
        }

        $this->devLog("{$action} '<event>' item with id '{$id}'");
    }

    /**
     * Delete from database items if it not found in processed XML file
     * (i.e.'processing_status' is 'in progress')
     *
     * @return int Count of deleted items type 'ClassificationItem'
     */
    private function deleteOldRecordsFromDatabase()
    {
        // $GLOBALS['TYPO3_DB']->debugOutput = true;

        $status = self::PROCESSING_STATUS_IN_PROGRESS;
        $where = "pid={$this->pid}";
        $where .= " AND processing_status='{$status}'";

        // counting items
        $result = $GLOBALS['TYPO3_DB']->exec_SELECTquery('COUNT(*) as cnt', self::EVENT_ITEM_TABLE_NAME, $where);
        $count = $GLOBALS['TYPO3_DB']->sql_fetch_assoc($result)['cnt'];

        // delete items
        $result = $GLOBALS['TYPO3_DB']->exec_DELETEquery(self::EVENT_ITEM_TABLE_NAME, $where);
        $result = $GLOBALS['TYPO3_DB']->exec_DELETEquery(self::LOCATION_ITEM_TABLE_NAME, $where);

        // $msg = $GLOBALS['TYPO3_DB']->debug_lastBuiltQuery;
        // $this->devLog($msg);

        return $count;
    }


    /**
     * Parse top level items
     *
     * @param SimpleXMLElement $xmlItems Collection of top level XML items <event>
     * @return int Count of imported items
     */
    private function parseEvents($xmlItems)
    {
        $processedCount = 0;

    	foreach($xmlItems as $event) {
    		$this->parseEvent($event);
    		$processedCount++;

    		// Forced save changes to database every COUNT_ITEMS_TO_PERSIST items processed
    		if ($processedCount % self::COUNT_ITEMS_TO_PERSIST == 0) {
    			$this->devLog("Processed {$processedCount} items type of <event>. Save to database.");
    			$this->persistenceManager->persistAll();
    		}
        }

        $this->devLog("Processed {$processedCount} items type of <event>. Save to database.");
        $this->persistenceManager->persistAll();

        return $processedCount;
    }


    /**
     * Count updated items
     *
     * @return int Count of updated items type 'ClassificationItem'
     */
    private function countUpdatedItems()
    {
        // $GLOBALS['TYPO3_DB']->debugOutput = true;

        $status = self::PROCESSING_STATUS_UPDATED;
        $where = "pid={$this->pid}";
        $where .= " AND processing_status='{$status}'";
        $result = $GLOBALS['TYPO3_DB']->exec_SELECTquery('COUNT(*) as cnt', self::EVENT_ITEM_TABLE_NAME, $where);
        $count = $GLOBALS['TYPO3_DB']->sql_fetch_assoc($result)['cnt'];

        // $msg = $GLOBALS['TYPO3_DB']->debug_lastBuiltQuery;
        // $this->devLog($msg);

        return $count;
    }

    /**
     * Count created items
     *
     * @return int Count of created items type 'ClassificationItem'
     */
    private function countCreatedItems()
    {
        // $GLOBALS['TYPO3_DB']->debugOutput = true;

        $status = self::PROCESSING_STATUS_CREATED;
        $where = "pid={$this->pid}";
        $where .= " AND processing_status='{$status}'";
        $result = $GLOBALS['TYPO3_DB']->exec_SELECTquery('COUNT(*) as cnt', self::EVENT_ITEM_TABLE_NAME, $where);
        $count = $GLOBALS['TYPO3_DB']->sql_fetch_assoc($result)['cnt'];

        // $msg = $GLOBALS['TYPO3_DB']->debug_lastBuiltQuery;
        // $this->devLog($msg);

        return $count;
    }

    /**
     * Set processing_status in progress for processed database records
     *
     */
    private function setStatusInProgressForProcessedDatabaseRecords()
    {
        $GLOBALS['TYPO3_DB']->exec_UPDATEquery(self::EVENT_ITEM_TABLE_NAME, "pid={$this->pid}", array('processing_status' => self::PROCESSING_STATUS_IN_PROGRESS));

        $GLOBALS['TYPO3_DB']->exec_UPDATEquery(self::LOCATION_ITEM_TABLE_NAME, "pid={$this->pid}", array('processing_status' => self::PROCESSING_STATUS_IN_PROGRESS));
    }


    /**
     * Read and parse XML file using simplexml (require simplexml PHP extension)
     *
     * @param string $fileName Name of file to import
     * @return int Count of processed items
     */
    private function loadDataFromXMLFile($fileName)
    {
        $processedCount = 0;

        // Load file through simplexml
        $parsedXML = simplexml_load_file($fileName);

        if (!$parsedXML) {
            $this->devLog("Err: simplexml_load_file {$fileName}");
            $this->setTaskStatus("Err: simplexml_load_file {$fileName}");
            return 0;
        }
        $this->devLog("XML file {$fileName} loaded.");

        $this->setStatusInProgressForProcessedDatabaseRecords();

        // Parse <event> items
        $processedCount = $this->parseEvents($parsedXML->events->event);
        return $processedCount;
    }

    /**
     * Process command (load ICD10 data from XML file)
     *
     * @param string $commandIdentifier
     * @param int $pid Page id
     *
     * note: to execute command run in CLI "typo3/cli_dispatch.phpsh extbase import:process"
     */
    public function processCommand($commandIdentifier = NULL, $pid = 0)
    {
        $startTime = time();
        $this->getConfiguration();

        // If $pid set to default value '0', get it actual value from extension configuration
        if ($pid == 0) {
            $pid = $this->getPid();
            $this->pid = $pid;
        }

        $msg = "Command processing started. commandIdentifier: {$commandIdentifier}. Pid: {$this->pid}.";
        $this->setTaskStatus($msg);
        $this->devLog($msg);

        // Get parameters from extension cofiguration
        $importFilePath = $this->getImportFilePath();
        $backupFolderPath = $this->getBackupFolderPath();
        $maxBackups = $this->getMaxBackups();
        $this->pid = intval($pid);

        // Check configuration parameters
        if (!$importFilePath) {
            $msg = 'Err: Import file ' . $importFilePath . ' not found.';
            $this->setTaskStatus($msg);
            $this->devLog($msg);
            return;
        }

        if (!$backupFolderPath) {
            $msg = 'Err: Backup folder ' . $backupFolderPath . ' not found.';
            $this->setTaskStatus($msg);
            $this->devLog($msg);
        }

        if (!file_exists($importFilePath)) {
            $msg = 'Err: File not found ' . $importFilePath;
            $this->setTaskStatus($msg);
            $this->devLog($msg);
            return;
        }

        // Create eventRepository
        $objectManager = \TYPO3\CMS\Core\Utility\GeneralUtility::makeInstance('TYPO3\CMS\Extbase\Object\ObjectManager');
        $fullRepositoryName = "T3Dev\Programmevents\Domain\Repository\EventRepository";
        $this->eventRepository = $objectManager->get($fullRepositoryName);
        $this->eventRepository->setPid($this->pid);

        // Create locationRepository
        $fullRepositoryName = "T3Dev\Programmevents\Domain\Repository\LocationRepository";
        $this->locationRepository = $objectManager->get($fullRepositoryName);
        $this->locationRepository->setPid($this->pid);

        // Load data from XML file
        $processedCount = $this->loadDataFromXMLFile($importFilePath);

        // If processedCount = 0 data not loaded from XML file
        if (!$processedCount) {
            $msg = 'Err: Could not parse XML file ' . $importFilePath;
            $this->setTaskStatus($msg);
            $this->devLog($msg);
            return;
        }

        $msg = "Info: File {$importFilePath} imported.";
        $this->setTaskStatus($msg);
        $this->devLog($msg);

        // Delete from database items not founded in XML
        $deletedCount = $this->deleteOldRecordsFromDatabase();

        // Count updated and created items
        $updatedCount = $this->countUpdatedItems();
        $createdCount = $this->countCreatedItems();

        // Save imported file in backukp folder
        $fileCopied = $this->copyFileToBackup($importFilePath, $backupFolderPath);
        if ($fileCopied) {
            $msg = "Info: Imported file copy to backup folder " . $backupFolderPath;
        } else {
            $msg = "Warn: Failed copy imported file to backup folder " . $backupFolderPath;
        }
        $this->setTaskStatus($msg);
        $this->devLog($msg);

        // Remove old backuped files (keep $maxBackups files)
        $backupCleaned = $this->deleteOldBackups($backupFolderPath, $maxBackups);
        if ($backupCleaned) {
            $msg = "Info: Old backup files deleted.";
        } else {
            $msg = "Warn: Failed to remove old backup files from " . $backupFolderPath;
        }
        $this->setTaskStatus($msg);
        $this->devLog($msg);

        $endTime = time();
        $executionTimeString = $this->timeDiffInHumanReadable($startTime, $endTime);

        $msg = "Import complete. Execution time: {$executionTimeString}. Processed {$processedCount} items in XML file. Create {$createdCount} items in database. Update {$updatedCount} items in database. Delete {$deletedCount} items in database.";
        $this->setTaskStatus($msg);
        $this->devLog($msg);

    }

    /**
     * Set status value for scheduler task
     *
     * @param string $status Text to set
     * @param string $identifier Id for task
     */
    protected function setTaskStatus($status, $identifier = 'programmevents:external_import')
    {
        parent::setTaskStatus($status, $identifier);
    }

}
