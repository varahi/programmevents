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
 * LocationController
 */
class LocationController extends \TYPO3\CMS\Extbase\Mvc\Controller\ActionController
{
    /**
     * locationRepository
     *
     * @var \T3Dev\Programmevents\Domain\Repository\LocationRepository
     * @inject
     */
    protected $locationRepository = null;

    /**
     * action list
     *
     * @return void
     */
    public function listAction()
    {
        $locations = $this->locationRepository->findAll();
        $this->view->assign('locations', $locations);
    }

    /**
     * action show
     *
     * @param \T3Dev\Programmevents\Domain\Model\Location $location
     * @return void
     */
    public function showAction(\T3Dev\Programmevents\Domain\Model\Location $location)
    {
        $this->view->assign('location', $location);
    }
}
