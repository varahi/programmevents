<?php
namespace T3Dev\Programmevents\Command;

use TYPO3\CMS\Core\Utility\DebugUtility;
use TYPO3\CMS\Core\Utility\GeneralUtility;
use TYPO3\CMS\Core\Utility\PathUtility;

/**
 *
 *
 * @license http://www.gnu.org/licenses/gpl.html GNU General Public License, version 3 or later
 *
 */
abstract class AbstractCommandController extends \TYPO3\CMS\Extbase\Mvc\Controller\CommandController
{

    /**
     * @var \TYPO3\CMS\Core\Database\DatabaseConnection
     */
    protected $db = null;

    /**
     * @var array
     */
    protected $configuration = array();

    /**
     * @var \TYPO3\CMS\Extbase\Mvc\Cli\CommandManager
     * @inject
     */
    protected $commandManager;

    /**
     * @var \TYPO3\CMS\Extbase\Configuration\BackendConfigurationManager
     * @inject
     */
    protected $configurationManager;

    /**
     * persistenceManager
     *
     * @var \TYPO3\CMS\Extbase\Persistence\Generic\PersistenceManager
     * @inject
     */
    protected $persistenceManager;

    /**
     * eventRepository
     *
     * @var \T3Dev\Programmevents\Domain\Repository\EventRepository
     * @inject
     */
    protected $eventRepository;

    /**
     * @var \TYPO3\CMS\Core\Resource\ResourceStorage
     */
    protected $storage = null;

    /**
     * Initialize the controller.
     */
    public function __construct()
    {
        $this->db = $GLOBALS['TYPO3_DB'];
        $this->configuration = [];

        $this->clearLogFile();
    }

    /**
     * Build config array (get from $GLOBALS['TYPO3_CONF_VARS']['EXT']['extConf']['programmevents'])
     * if empty then set default values for configuration
     *
     * @return array Configuration
     */
    protected function getConfiguration() {
        if (empty($this->configuration)) {
            $configuration = $GLOBALS['TYPO3_CONF_VARS']['EXT']['extConf']['programmevents'];
            if (is_string($configuration)) {
                $configuration = unserialize($configuration);
            }

            // set default values if no global conf found
            if (empty($configuration)) {
                $configuration = array(
                    'pid' => 0,
                    'archiveFolder' => 'fileadmin/import_events/backup/',
                    'inboxFolder' => 'fileadmin/import_events/',
                    'templateArchiveFilePrefix' => 'Y-m-d_',
                    'inboxFilename' => '155.xml',
                    'enableDevLog' => false,
                    'maxBackups' => 5
                );
            }
            $this->configuration = $configuration;
        }
        return $this->configuration;
    }

    /**
     * Return difference between two unix timestamp (or time strings) in human readable format
     *
     * @param mixed $start a time (string or timestamp)
     * @param mixed $end a time (string or timestamp)
     * @param integer $precision Optional precision ()
     * @return string Time difference in human readable format
     */
    protected function timeDiffInHumanReadable($start, $end, $precision = 4)
    {
        // If not numeric then convert timestamps
        if (!is_int($start)) {
            $start = strtotime($start);
        }

        if (!is_int($end)) {
            $end = strtotime($end);
        }

        // If start > end then swap the 2 values
        if ($start > $end) {
            list($start, $end) = array($end, $start);
        }

        $intervals = array('year', 'month', 'day', 'hour', 'minute', 'second');
        $diffs = array();

        foreach ($intervals as $interval) {
            // Create temp time from start and interval
            $ttime = strtotime('+1 ' . $interval, $start);

            // Set initial values
            $add = 1;
            $looped = 0;

            // Loop until temp time is smaller than end
            while ($end >= $ttime) {
                // Create new temp time from start and interval
                $add++;
                $ttime = strtotime("+" . $add . " " . $interval, $start);
                $looped++;
            }
            $start = strtotime("+" . $looped . " " . $interval, $start);
            $diffs[$interval] = $looped;
        }
        $count = 0;
        $times = array();
        foreach ($diffs as $interval => $value) {
            // Break if we have needed precission
            if ($count >= $precision) {
                break;
            }

            // Add value and interval if value is bigger than 0
            if ($value > 0) {
                if ($value != 1) {
                    $interval .= "s";
                }

                // Add value and interval to times array
                $times[] = $value . " " . $interval;
                $count++;
            }
        }
        // Return string with times
        return implode(", ", $times);
    }

    /**
     * Get element from array by key, if this exists, or default value
     *
     * @param array $arr
     * @param mixed $key
     * @param mixed $default
     * @return mixed
     */
    protected function arrayGet($arr, $key, $default = '')
    {
        if (isset($arr[$key])) {
            return $arr[$key];
        } else {
            return $default;
        }
    }

    /**
     * Write message to developers log (if 'enableDevLog' set to true)
     * and write message to file typo3temp/programm_import_xml.log
     * and write message to stdout if command run in typo3/cli_dispatch.phpsh
     *
     * @param string $msg
     */
    protected function devLog($msg)
    {
        $config = $this->getConfiguration();
        if ($config['enableDevLog']) {
            \TYPO3\CMS\Core\Utility\GeneralUtility::devLog($msg, 'inkluviva_icd10');
        }

        $logFile = fopen(PATH_site . "typo3temp/programm_import_xml.log", "a");
        if ($logFile) {
            $date = date(DATE_RFC822);
            fwrite($logFile, $date . ": ". $msg . "\n");
            fclose($logFile);
        }

        $this->outputLine($msg);
    }

    /**
     * Clear log file typo3temp/programm_import_xml.log
     */
    protected function clearLogFile()
    {
        file_put_contents(PATH_site . "typo3temp/programm_import_xml.log", '');
    }


    /**
     * Full path to impoted file (from extension configuration)
     *
     * @return string Full path to imported file
     */
    protected function getImportFilePath()
    {
        $config = $this->getConfiguration();
        $path = PATH_site . $config['inboxFolder'] . $config['inboxFilename'];
        return $path;
    }

    /**
     * Full path to backup folder (from extension configuration)
     *
     * @return string Full path to backup folder
     */
    protected function getBackupFolderPath()
    {
        $config = $this->getConfiguration();
        $path = PATH_site . $config['archiveFolder'];

        return $path;
    }

    /**
     * Numbers of backups to keep (from extension configuration)
     *
     * @return int Max backups
     */
    protected function getMaxBackups()
    {
        $config = $this->getConfiguration();

        return $config['maxBackups'];
    }

    /**
     * Page id (from extension configuration)
     *
     * @return int pid (Page id)
     */
    protected function getPid()
    {
        $config = $this->getConfiguration();

        return $config['pid'];
    }

    /**
     * Delete old backup files from $backupFolderPath, keeping $maxBackups files
     *
     * @param string $backupFolderPath Path to backup folder
     * @param int $maxBackups Number of backup files to keep
     * @return boolean Result
     */
    protected function deleteOldBackups($backupFolderPath, $maxBackups)
    {
        $files = [];

        // collect files in backup folder
        if ($handle = opendir($backupFolderPath)) {
            while (false !== ($entry = readdir($handle))) {
                if ($entry != '.' && $entry != '..') {
                    $files[] =  $entry;
                }
            }
            closedir($handle);
        }

        // reverse sort by file name
        rsort($files);

        // get files to delete
        $filesToDelete = array_slice($files, (int) $maxBackups);

        // if not empty files array
        if (sizeof($filesToDelete)){
            foreach($filesToDelete as $file) {
                $pathToDelete = $backupFolderPath . $file;

                // delete file
                if (!unlink($pathToDelete)) {
                    return false;
                }
            }
        }

        return true;
    }

    /**
     * Copy file to backup folder
     *
     * @param string $filePath
     * @param string $backupFolderPath
     * @return bool Result
     */
    protected function copyFileToBackup($filePath, $backupFolderPath)
    {
        $pathinfo = pathinfo($filePath);

        $config = $this->getConfiguration();

        $pathCopyTo = $backupFolderPath . date($config['templateArchiveFilePrefix'], time()) . $config['inboxFilename'];

        return copy($filePath, $pathCopyTo);
    }

    /**
     *
     *
     * @param string $status
     * @param string $identifier
     */
    protected function setTaskStatus($status, $identifier)
    {
        /** @var \TYPO3\CMS\Extbase\Scheduler\Task $task */
        $task = null;
        $tasks = $this->getAllRegisteredTasks();

        foreach ($tasks as $taskRow) {
            $task = unserialize($taskRow['serialized_task_object']);

            if (method_exists($task, 'getCommandIdentifier') && $task->getCommandIdentifier() == $identifier) {
                $arguments = $task->getArguments();
                $arguments['status'] = $status;
                $task->setArguments($arguments);

                $fields = array();
                $fields['serialized_task_object'] = serialize($task);

                $this->db->exec_UPDATEquery('tx_scheduler_task', 'uid = ' . $taskRow['uid'], $fields);

                break;
            }
        }
    }

    /**
     * @return array
     */
    protected function getAllRegisteredTasks()
    {
        $tasks = [];

        // Get all registered tasks
        // Just to get the number of entries
        $query = array(
            'SELECT' => 'tx_scheduler_task.*',
            'FROM' => 'tx_scheduler_task',
            'WHERE' => '1=1 AND disable=0',
            'ORDERBY' => 'tx_scheduler_task.uid'
        );
        $res = $this->db->exec_SELECT_queryArray($query);
        $numRows = $this->db->sql_num_rows($res);

        // No tasks defined, display information message
        if ($numRows > 0) {
            // Loop on all tasks
            $temporaryResult = array();
            while ($row = $this->db->sql_fetch_assoc($res)) {
                $tasks[] = $row;
            }
        }

        return $tasks;
    }

}
