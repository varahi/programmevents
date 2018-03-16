<?php
namespace T3Dev\Programmevents\Domain\Model;

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
 * Location
 */
class Location extends \TYPO3\CMS\Extbase\DomainObject\AbstractEntity
{
    /**
     * name
     *
     * @var string
     */
    protected $name = '';
    
    /**
     * id
     *
     * @var int
     */
    protected $id = 0;

    /**
     * address
     *
     * @var string
     */
    protected $address = '';

    /**
     * city
     *
     * @var string
     */
    protected $city = '';

    /**
     * zipcode
     *
     * @var string
     */
    protected $zipcode = '';

    /**
     * xcoordinate
     *
     * @var string
     */
    protected $xcoordinate = '';

    /**
     * ycoordinate
     *
     * @var string
     */
    protected $ycoordinate = '';

    /**
     * portal
     *
     * @var string
     */
    protected $portal = '';
    
    /**
     * processingStatus
     *
     * @var string
     */
    protected $processingStatus = '';

    /**
     * event
     *
     * @var \TYPO3\CMS\Extbase\Persistence\ObjectStorage<\T3Dev\Programmevents\Domain\Model\Event>
     */
    protected $event = null;

    /**
     * __construct
     */
    public function __construct()
    {
        //Do not remove the next line: It would break the functionality
        $this->initStorageObjects();
    }

    /**
     * Initializes all ObjectStorage properties
     * Do not modify this method!
     * It will be rewritten on each save in the extension builder
     * You may modify the constructor of this class instead
     *
     * @return void
     */
    protected function initStorageObjects()
    {
        $this->event = new \TYPO3\CMS\Extbase\Persistence\ObjectStorage();
    }
    
    /**
     * Returns the id
     *
     * @return int $id
     */
    public function getId()
    {
    	return $this->id;
    }
    
    /**
     * Sets the id
     *
     * @param int $id
     * @return void
     */
    public function setId($id)
    {
    	$this->id = $id;
    }

    /**
     * Returns the name
     *
     * @return string $name
     */
    public function getName()
    {
        return $this->name;
    }

    /**
     * Sets the name
     *
     * @param string $name
     * @return void
     */
    public function setName($name)
    {
        $this->name = $name;
    }

    /**
     * Returns the address
     *
     * @return string $address
     */
    public function getAddress()
    {
        return $this->address;
    }

    /**
     * Sets the address
     *
     * @param string $address
     * @return void
     */
    public function setAddress($address)
    {
        $this->address = $address;
    }

    /**
     * Returns the city
     *
     * @return string $city
     */
    public function getCity()
    {
        return $this->city;
    }

    /**
     * Sets the city
     *
     * @param string $city
     * @return void
     */
    public function setCity($city)
    {
        $this->city = $city;
    }

    /**
     * Returns the zipcode
     *
     * @return string $zipcode
     */
    public function getZipcode()
    {
        return $this->zipcode;
    }

    /**
     * Sets the zipcode
     *
     * @param string $zipcode
     * @return void
     */
    public function setZipcode($zipcode)
    {
        $this->zipcode = $zipcode;
    }

    /**
     * Returns the xcoordinate
     *
     * @return string $xcoordinate
     */
    public function getXcoordinate()
    {
        return $this->xcoordinate;
    }

    /**
     * Sets the xcoordinate
     *
     * @param string $xcoordinate
     * @return void
     */
    public function setXcoordinate($xcoordinate)
    {
        $this->xcoordinate = $xcoordinate;
    }

    /**
     * Returns the ycoordinate
     *
     * @return string $ycoordinate
     */
    public function getYcoordinate()
    {
        return $this->ycoordinate;
    }

    /**
     * Sets the ycoordinate
     *
     * @param string $ycoordinate
     * @return void
     */
    public function setYcoordinate($ycoordinate)
    {
        $this->ycoordinate = $ycoordinate;
    }

    /**
     * Returns the portal
     *
     * @return string $portal
     */
    public function getPortal()
    {
        return $this->portal;
    }

    /**
     * Sets the portal
     *
     * @param string $portal
     * @return void
     */
    public function setPortal($portal)
    {
        $this->portal = $portal;
    }
    
    
    /**
     * Returns the processingStatus
     *
     * @return string $processingStatus
     */
    public function getProcessingStatus()
    {
    	return $this->processingStatus;
    }
    
    /**
     * Sets the processingStatus
     *
     * @param string $processingStatus
     * @return void
     */
    public function setProcessingStatus($processingStatus)
    {
    	$this->processingStatus = $processingStatus;
    }
    

    /**
     * Adds a Event
     *
     * @param \T3Dev\Programmevents\Domain\Model\Event $event
     * @return void
     */
    public function addEvent(\T3Dev\Programmevents\Domain\Model\Event $event)
    {
        $this->event->attach($event);
    }

    /**
     * Removes a Event
     *
     * @param \T3Dev\Programmevents\Domain\Model\Event $eventToRemove The Event to be removed
     * @return void
     */
    public function removeEvent(\T3Dev\Programmevents\Domain\Model\Event $eventToRemove)
    {
        $this->event->detach($eventToRemove);
    }

    /**
     * Returns the event
     *
     * @return \TYPO3\CMS\Extbase\Persistence\ObjectStorage<\T3Dev\Programmevents\Domain\Model\Event> $event
     */
    public function getEvent()
    {
        return $this->event;
    }

    /**
     * Sets the event
     *
     * @param \TYPO3\CMS\Extbase\Persistence\ObjectStorage<\T3Dev\Programmevents\Domain\Model\Event> $event
     * @return void
     */
    public function setEvent(\TYPO3\CMS\Extbase\Persistence\ObjectStorage $event)
    {
        $this->event = $event;
    }
}
