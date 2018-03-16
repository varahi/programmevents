<?php
namespace T3Dev\Programmevents\Domain\Repository;

/***
 *
 * This file is part of the "Programm Events" Extension for TYPO3 CMS.
 *
 * For the full copyright and license information, please read the
 * LICENSE.txt file that was distributed with this source code.
 *
 *  (c) 2018 Dmitry Vasilev <dmitry@t3dev.ru>, T3Dev
 *
 ***/

/**
 * The repository for Locations
 */
class LocationRepository extends \TYPO3\CMS\Extbase\Persistence\Repository
{
    /**
     * @var array
     */
    protected $defaultOrderings = array(
        'uid' => \TYPO3\CMS\Extbase\Persistence\QueryInterface::ORDER_ASCENDING
    );

    public function setPid($pid)
    {
        $querySettings = $this->objectManager->get(\TYPO3\CMS\Extbase\Persistence\Generic\Typo3QuerySettings::class);
        $querySettings->setStoragePageIds(array($pid));
        $this->setDefaultQuerySettings($querySettings);
    }
}
