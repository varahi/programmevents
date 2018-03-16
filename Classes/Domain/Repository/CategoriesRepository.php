<?php
namespace T3Dev\Programmevents\Domain\Repository;

/**
 * The repository for Categories
 */
class CategoriesRepository extends \TYPO3\CMS\Extbase\Persistence\Repository
{
    /**
     * @var array
     */
    protected $defaultOrderings = array(
        'uid' => \TYPO3\CMS\Extbase\Persistence\QueryInterface::ORDER_ASCENDING
    );
    
    /**
     * @var array
     */
    public function findSelected($selected) {
    	$query = $this->createQuery();
    	return $query->matching(
    		$query->logicalAnd(
    			$query->in('categories.uid',\TYPO3\CMS\Core\Utility\GeneralUtility::trimExplode(',',$selected))
    		)
    	)
    	->setOrderings(array(
    			'title' => \TYPO3\CMS\Extbase\Persistence\QueryInterface::ORDER_ASCENDING,
    			//'sorting' => \TYPO3\CMS\Extbase\Persistence\QueryInterface::ORDER_DESCENDING
    	))
    	->execute();
    }
    
}