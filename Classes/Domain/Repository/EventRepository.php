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
 * The repository for Events
 */
class EventRepository extends \TYPO3\CMS\Extbase\Persistence\Repository
{
    /**
     * @var array
     */
    protected $defaultOrderings = array(
        'uid' => \TYPO3\CMS\Extbase\Persistence\QueryInterface::ORDER_DESCENDING
    );
    
    /*
     * @param string $code
     *
     * return JUBU\InkluvivaIcd10\Domain\Model\Classification
     */
    public function findOneByCode($code)
    {
        $code = strval($code);
        
        $query = $this->createQuery();
        $query->matching($query->equals('id', $code));
        return $query->execute()->getFirst();
    }
    
    /**
     * @param $query
     * @return string
     */
    public function debugQuery($query)
    {
        $queryParser = $this->objectManager->get(\TYPO3\CMS\Extbase\Persistence\Generic\Storage\Typo3DbQueryParser::class);
        ob_start();
        var_dump($queryParser->convertQueryToDoctrineQueryBuilder($query)->getSQL());
        var_dump($queryParser->convertQueryToDoctrineQueryBuilder($query)->getParameters());
        $result = ob_get_clean();
        
        return $result;
    }
    
    public function debugFindOneByCode($code)
    {
        $code = strval($code);
        
        $query = $this->createQuery();
        $query->matching($query->equals('id', $code));
        return $this->debugQuery($query);
    }
    
    public function setPid($pid)
    {
        $querySettings = $this->objectManager->get(\TYPO3\CMS\Extbase\Persistence\Generic\Typo3QuerySettings::class);
        $querySettings->setStoragePageIds(array($pid));
        $this->setDefaultQuerySettings($querySettings);
    }
    
    
    /**
     * @var array
     */
    public function findByCategory($categories) {
        $query = $this->createQuery();
        return $query->matching(
            $query->logicalAnd(
                $query->in('categories.uid',\TYPO3\CMS\Core\Utility\GeneralUtility::trimExplode(',',$categories))
                )
            )
            ->setOrderings(array(
                'title' => \TYPO3\CMS\Extbase\Persistence\QueryInterface::ORDER_ASCENDING
            ))
            ->execute();
    }   
    
    public function findByLocation($location) {
        $query = $this->createQuery();
        return $query->matching(
            $query->logicalAnd(
                $query->in('location.uid',explode(',',$location))
                )
            )
            ->setOrderings(array(
                'title' => \TYPO3\CMS\Extbase\Persistence\QueryInterface::ORDER_ASCENDING
            ))
            ->execute();
    }   
    
    public function findByDates($startDate, $endDate) {
    	$query = $this->createQuery();
    	
    	if ($startDate) {
    		$startDate = date_create($startDate);
    		$startDate = date_format($startDate, 'U');
    	}
    	if ($endDate) {
    		$endDate = date_create($endDate);
    		$endDate = date_format($endDate, 'U');
    	}
    	
    	$query->matching(
   			$query->logicalAnd(
				$query->greaterThanOrEqual('start_date', $startDate),
    			$query->lessThanOrEqual('end_date', $endDate)
    		)
    	);
    	if ($startDate == '') {
    		$query->matching(
    			$query->logicalAnd(
    				$query->lessThanOrEqual('end_date', $endDate)
    			)
    		);
    	}
    	if ($endDate == '') {
    		$query->matching(
    			$query->logicalAnd(
    				$query->greaterThanOrEqual('start_date', $startDate)
    			)
    		);
    	}   	
    	return $query->execute();
    }


}
