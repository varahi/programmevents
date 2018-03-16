<?php
namespace T3Dev\Programmevents\Controller;


/**
 * CategoriesController
 */
class CategoriesController extends \TYPO3\CMS\Extbase\Mvc\Controller\ActionController
{
    /**
     * categoriesRepository
     *
     * @var \T3Dev\Programmevents\Domain\Repository\CategoriesRepository
     * @inject
     */
    protected $categoriesRepository = null;
    
    /**
     * configurationManager
     *
     * @var TYPO3\CMS\Extbase\Configuration\ConfigurationManager
     * @inject
     */
    protected $configurationManager;

    /**
     * action list
     *
     * @return void
     */
    public function listAction()
    {
    	$selected = $this->settings['selected'];
    	$showAll= $this->settings['showAll'];
    	
    	$args = $this->request->getArguments();
    	$argCategory = $args['category'];
    	$argLocation = $args['location'];
    	$this->view->assign('argCategory', $argCategory);
    	
    	if ($showAll == 1) {
    		$categories = $this->categoriesRepository->findAll();
    		$this->view->assign('categories', $categories);
    	} else {
    		$categories = $this->categoriesRepository->findAll();
    		//$categories = $this->categoriesRepository->findSelected($selected);
    		$this->view->assign('categories', $categories);
    	}
    	
    }

    /**
     * action show
     *
     * @param \T3Dev\Programmevents\Domain\Model\Categories $categories
     * @return void
     */
    public function showAction(\T3Dev\Programmevents\Domain\Model\Categories $categories)
    {
        $this->view->assign('categories', $categories);
    }
}
