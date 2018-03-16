<?php
namespace T3Dev\Programmevents\Domain\Model;


/**
 * Categories
 */
class Categories extends \TYPO3\CMS\Extbase\DomainObject\AbstractEntity
{
    /**
     * title
     *
     * @var string
     */
    protected $title = '';

    /**
     * parentcategory
     *
     * @var string
     */
    protected $parentcategory = '';

    /**
     * images
     *
     * @var \TYPO3\CMS\Extbase\Domain\Model\FileReference
     */
    protected $images = null;

    /**
     * link
     *
     * @var string
     */
    protected $link = '';

    /**
     * description
     *
     * @var string
     */
    protected $description = '';

    /**
     * item
     *
     * @var \TYPO3\CMS\Extbase\Persistence\ObjectStorage<\T3Dev\Programmevents\Domain\Model\Event>
     * @lazy
     */
    protected $item = null;

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
        $this->item = new \TYPO3\CMS\Extbase\Persistence\ObjectStorage();
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
     * Returns the parentcategory
     *
     * @return string $parentcategory
     */
    public function getParentcategory()
    {
        return $this->parentcategory;
    }

    /**
     * Sets the parentcategory
     *
     * @param string $parentcategory
     * @return void
     */
    public function setParentcategory($parentcategory)
    {
        $this->parentcategory = $parentcategory;
    }

    /**
     * Returns the images
     *
     * @return \TYPO3\CMS\Extbase\Domain\Model\FileReference $images
     */
    public function getImages()
    {
    	return $this->images;
    }
    
    /**
     * Sets the images
     *
     * @param \TYPO3\CMS\Extbase\Domain\Model\FileReference $images
     * @return void
     */
    public function setImages(\TYPO3\CMS\Extbase\Domain\Model\FileReference $images)
    {
    	$this->images = $images;
    }

    /**
     * Returns the link
     *
     * @return string $link
     */
    public function getLink()
    {
        return $this->link;
    }

    /**
     * Sets the link
     *
     * @param string $link
     * @return void
     */
    public function setLink($link)
    {
        $this->link = $link;
    }

    /**
     * Returns the description
     *
     * @return string $description
     */
    public function getDescription()
    {
        return $this->description;
    }

    /**
     * Sets the description
     *
     * @param string $description
     * @return void
     */
    public function setDescription($description)
    {
        $this->description = $description;
    }

    /**
     * Adds a Item
     *
     * @param \T3Dev\Programmevents\Domain\Model\Event $item
     * @return void
     */
    public function addItem(\T3Dev\Programmevents\Domain\Model\Item $item)
    {
        $this->item->attach($item);
    }

    /**
     * Removes a Item
     *
     * @param \T3Dev\Programmevents\Domain\Model\Event $itemToRemove The Item to be removed
     * @return void
     */
    public function removeItem(\T3Dev\Programmevents\Domain\Model\Event $itemToRemove)
    {
        $this->item->detach($itemToRemove);
    }

    /**
     * Returns the item
     *
     * @return \TYPO3\CMS\Extbase\Persistence\ObjectStorage<\T3Dev\Programmevents\Domain\Model\Event> $item
     */
    public function getItem()
    {
        return $this->item;
    }

    /**
     * Sets the item
     *
     * @param \TYPO3\CMS\Extbase\Persistence\ObjectStorage<\T3Dev\Programmevents\Domain\Model\Event> $item
     * @return void
     */
    public function setItem(\TYPO3\CMS\Extbase\Persistence\ObjectStorage $item)
    {
        $this->item = $item;
    }
}
