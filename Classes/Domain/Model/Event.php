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
 * Event
 */
class Event extends \TYPO3\CMS\Extbase\DomainObject\AbstractEntity
{
    /**
     * title
     *
     * @var string
     */
    protected $title = '';
    
    /**
     * startDate
     *
     * @var \DateTime
     */
    protected $startDate = null;
    
    /**
     * endDate
     *
     * @var \DateTime
     */
    protected $endDate = null;
    
    /**
     * subtitle
     *
     * @var string
     */
    protected $subtitle = '';

    /**
     * id
     *
     * @var int
     */
    protected $id = 0;

    /**
     * type
     *
     * @var string
     */
    protected $type = '';

    /**
     * datebegin
     *
     * @var string
     */
    protected $datebegin = '';

    /**
     * timebegin
     *
     * @var string
     */
    protected $timebegin = '';

    /**
     * formatteddate
     *
     * @var string
     */
    protected $formatteddate = '';

    /**
     * weekdaybegin
     *
     * @var string
     */
    protected $weekdaybegin = '';

    /**
     * image
     *
     * @var string
     */
    protected $image = '';
    
    /**
     * picture
     *
     * @var \TYPO3\CMS\Extbase\Domain\Model\FileReference
     * @cascade remove
     */
    protected $picture = null;

    /**
     * location
     *
     * @var \T3Dev\Programmevents\Domain\Model\Location
     */
    protected $location = null;
    
    /**
     * processingStatus
     *
     * @var string
     */
    protected $processingStatus = '';
    
    /**
     * categories
     *
     * @var \TYPO3\CMS\Extbase\Persistence\ObjectStorage<\T3Dev\Programmevents\Domain\Model\Categories>
	 * @lazy
     */
    protected $categories = null;
    
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
        $this->categories = new \TYPO3\CMS\Extbase\Persistence\ObjectStorage();
    }
    

    /**
     * Returns the title
     *
     * @return string $title
     */
    public function getTitle()
    {
        return $this->title;
    }

    /**
     * Sets the title
     *
     * @param string $title
     * @return void
     */
    public function setTitle($title)
    {
        $this->title = $title;
    }
    
    /**
     * Returns the startDate
     *
     * @return \DateTime $startDate
     */
    public function getStartDate()
    {
    	return $this->startDate;
    }
    
    /**
     * Sets the startDate
     *
     * @param \DateTime $startDate
     * @return void
     */
    public function setStartDate(\DateTime $startDate)
    {
    	$this->startDate = $startDate;
    }
    
    /**
     * Returns the endDate
     *
     * @return \DateTime $endDate
     */
    public function getEndDate()
    {
    	return $this->endDate;
    }
    
    /**
     * Sets the endDate
     *
     * @param \DateTime $endDate
     * @return void
     */
    public function setEndDate(\DateTime $endDate)
    {
    	$this->endDate = $endDate;
    }
    
    /**
     * Returns the subtitle
     *
     * @return string $subtitle
     */
    public function getSubtitle()
    {
    	return $this->subtitle;
    }
    
    /**
     * Sets the subtitle
     *
     * @param string $subtitle
     * @return void
     */
    public function setSubtitle($subtitle)
    {
    	$this->subtitle = $subtitle;
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
     * Returns the type
     *
     * @return string $type
     */
    public function getType()
    {
        return $this->type;
    }

    /**
     * Sets the type
     *
     * @param string $type
     * @return void
     */
    public function setType($type)
    {
        $this->type = $type;
    }

    /**
     * Returns the datebegin
     *
     * @return string $datebegin
     */
    public function getDatebegin()
    {
        return $this->datebegin;
    }

    /**
     * Sets the datebegin
     *
     * @param string $datebegin
     * @return void
     */
    public function setDatebegin($datebegin)
    {
        $this->datebegin = $datebegin;
    }

    /**
     * Returns the timebegin
     *
     * @return string $timebegin
     */
    public function getTimebegin()
    {
        return $this->timebegin;
    }

    /**
     * Sets the timebegin
     *
     * @param string $timebegin
     * @return void
     */
    public function setTimebegin($timebegin)
    {
        $this->timebegin = $timebegin;
    }

    /**
     * Returns the formatteddate
     *
     * @return string $formatteddate
     */
    public function getFormatteddate()
    {
        return $this->formatteddate;
    }

    /**
     * Sets the formatteddate
     *
     * @param string $formatteddate
     * @return void
     */
    public function setFormatteddate($formatteddate)
    {
        $this->formatteddate = $formatteddate;
    }

    /**
     * Returns the weekdaybegin
     *
     * @return string $weekdaybegin
     */
    public function getWeekdaybegin()
    {
        return $this->weekdaybegin;
    }

    /**
     * Sets the weekdaybegin
     *
     * @param string $weekdaybegin
     * @return void
     */
    public function setWeekdaybegin($weekdaybegin)
    {
        $this->weekdaybegin = $weekdaybegin;
    }

    /**
     * Returns the image
     *
     * @return string $image
     */
    public function getImage()
    {
        return $this->image;
    }

    /**
     * Sets the image
     *
     * @param string $image
     * @return void
     */
    public function setImage($image)
    {
        $this->image = $image;
    }

    /**
     * Returns the location
     *
     * @return \T3Dev\Programmevents\Domain\Model\Location $location
     */
    public function getLocation()
    {
        return $this->location;
    }

    /**
     * Sets the location
     *
     * @param \T3Dev\Programmevents\Domain\Model\Location $location
     * @return void
     */
    public function setLocation(\T3Dev\Programmevents\Domain\Model\Location $location)
    {
        $this->location = $location;
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
     * Adds a Categories
     *
     * @param \T3Dev\Programmevents\Domain\Model\Categories $category
     * @return void
     */
    public function addCategory(\T3Dev\Programmevents\Domain\Model\Categories $category)
    {
        $this->categories->attach($category);
    }
    
    /**
     * Removes a Categories
     *
     * @param \T3Dev\Programmevents\Domain\Model\Categories $categoryToRemove The Categories to be removed
     * @return void
     */
    public function removeCategory(\T3Dev\Programmevents\Domain\Model\Categories $categoryToRemove)
    {
        $this->categories->detach($categoryToRemove);
    }
    
    /**
     * Returns the categories
     *
     * @return \TYPO3\CMS\Extbase\Persistence\ObjectStorage<\T3Dev\Programmevents\Domain\Model\Categories> $categories
     */
    public function getCategories()
    {
        return $this->categories;
    }
    
    /**
     * Sets the categories
     *
     * @param \TYPO3\CMS\Extbase\Persistence\ObjectStorage<\T3Dev\Programmevents\Domain\Model\Categories> $categories
     * @return void
     */
    public function setCategories(\TYPO3\CMS\Extbase\Persistence\ObjectStorage $categories)
    {
        $this->categories = $categories;
    }
    
    /**
     * Returns the picture
     *
     * @return \TYPO3\CMS\Extbase\Domain\Model\FileReference $picture
     */
    public function getPicture()
    {
    	return $this->picture;
    }
    
    /**
     * Sets the picture
     *
     * @param \TYPO3\CMS\Extbase\Domain\Model\FileReference $picture
     * @return void
     */
    public function setPicture(\TYPO3\CMS\Extbase\Domain\Model\FileReference $picture)
    {
    	$this->picture = $picture;
    }
    
}
