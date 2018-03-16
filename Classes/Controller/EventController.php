<?php
namespace T3Dev\Programmevents\Controller;

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
 * EventController
 */
class EventController extends \TYPO3\CMS\Extbase\Mvc\Controller\ActionController
{
    
    /**
     * persistenceManager
     *
     * @var \TYPO3\CMS\Extbase\Persistence\Generic\PersistenceManager
     * @inject
     */
    protected $persistenceManager;
    
    /**
     * configurationManager
     *
     * @var TYPO3\CMS\Extbase\Configuration\ConfigurationManager
     * @inject
     */
    protected $configurationManager;
        
    /**
     * categoriesRepository
     *
     * @var \T3Dev\Programmevents\Domain\Repository\CategoriesRepository
     * @inject
     */
    protected $categoriesRepository = null;
    
    /**
     * eventRepository
     *
     * @var \T3Dev\Programmevents\Domain\Repository\EventRepository
     * @inject
     */
    protected $eventRepository = null;

    /**
     * action list
     *
     * @return void
     */
    public function listAction()
    {
        $categories = $this->settings['categories'];
        $showAll= $this->settings['showAll'];    
        $args = $this->request->getArguments();
        $argCategory = $args['category'];
        $argLocation = $args['location'];
        
        
        if ($showAll == 1) {
        	$events = $this->eventRepository->findAll();
        } else {
        	$events = $this->eventRepository->findByCategory($categories);
        }
        
        if ($argCategory) {
            $events = $this->eventRepository->findByCategory($argCategory);   
        }
        
        if ($argLocation) {
           $events = $this->eventRepository->findByLocation($argLocation);
        }
        
        if (isset($_POST['tx_programmevents_programmevents'])) {
        	$events = $this->eventRepository->findByDates($startDate, $endDate);
        	$this->view->assign('events', $events);
        	$this->view->assign('startDate', $startDate);
        	$this->view->assign('endDate', $endDate);
        }
        
        $this->view->assign('events', $events);
    }
    
    /**
     * search form, only form
     *
     * @ignorevalidation $startDate
     * @ignorevalidation $endDate
     * @return void
     */
    public function searchFormAction() {
    	$this->view->assign('settings', $this->settings);
    }
    
    /**
     * Search item
     *
     * @param string $startDate
     * @param string $endDate
     * @dontvalidate $startDate
     * @ignorevalidation $endDate
     * @dontvalidate $startDate
     * @ignorevalidation $endDate 
     * @return void
     */
    public function searchAction($startDate, $endDate) {
    	//\TYPO3\CMS\Core\Utility\DebugUtility::debug($_POST);
    	$this->view->assign('settings', $this->settings);
	    	
    	$events = $this->eventRepository->findByDates($startDate, $endDate);
    	$this->view->assign('events', $events);
    	$this->view->assign('startDate', $startDate);
    	$this->view->assign('endDate', $endDate);

    }
    

    /**
     * action show
     *
     * @param \T3Dev\Programmevents\Domain\Model\Event $event
     * @return void
     */
    public function showAction(\T3Dev\Programmevents\Domain\Model\Event $event)
    {
        $this->view->assign('event', $event);
    }

    /**
     * action new
     *
     * @return void
     */
    public function newAction()
    {

    }

    /**
     * action create
     *
     * @param \T3Dev\Programmevents\Domain\Model\Event $newEvent
     * @return void
     */
    public function createAction(\T3Dev\Programmevents\Domain\Model\Event $newEvent)
    {
        $this->addFlashMessage('The object was created. Please be aware that this action is publicly accessible unless you implement an access check. See https://docs.typo3.org/typo3cms/extensions/extension_builder/User/Index.html', '', \TYPO3\CMS\Core\Messaging\AbstractMessage::WARNING);
        $this->eventRepository->add($newEvent);
        $this->redirect('list');
    }

    /**
     * action edit
     *
     * @param \T3Dev\Programmevents\Domain\Model\Event $event
     * @ignorevalidation $event
     * @return void
     */
    public function editAction(\T3Dev\Programmevents\Domain\Model\Event $event)
    {
        $this->view->assign('event', $event);
    }

    /**
     * action update
     *
     * @param \T3Dev\Programmevents\Domain\Model\Event $event
     * @return void
     */
    public function updateAction(\T3Dev\Programmevents\Domain\Model\Event $event)
    {
        $this->addFlashMessage('The object was updated. Please be aware that this action is publicly accessible unless you implement an access check. See https://docs.typo3.org/typo3cms/extensions/extension_builder/User/Index.html', '', \TYPO3\CMS\Core\Messaging\AbstractMessage::WARNING);
        $this->eventRepository->update($event);
        $this->redirect('list');
    }

    /**
     * action delete
     *
     * @param \T3Dev\Programmevents\Domain\Model\Event $event
     * @return void
     */
    public function deleteAction(\T3Dev\Programmevents\Domain\Model\Event $event)
    {
        $this->addFlashMessage('The object was deleted. Please be aware that this action is publicly accessible unless you implement an access check. See https://docs.typo3.org/typo3cms/extensions/extension_builder/User/Index.html', '', \TYPO3\CMS\Core\Messaging\AbstractMessage::WARNING);
        $this->eventRepository->remove($event);
        $this->redirect('list');
    }
}
