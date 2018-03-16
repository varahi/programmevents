<?php
namespace T3Dev\Programmevents\Tests\Unit\Domain\Model;

/**
 * Test case.
 *
 * @author Dmitry Vasilev <dmitry@t3dev.ru>
 */
class LocationTest extends \TYPO3\CMS\Core\Tests\UnitTestCase
{
    /**
     * @var \T3Dev\Programmevents\Domain\Model\Location
     */
    protected $subject = null;

    protected function setUp()
    {
        parent::setUp();
        $this->subject = new \T3Dev\Programmevents\Domain\Model\Location();
    }

    protected function tearDown()
    {
        parent::tearDown();
    }

    /**
     * @test
     */
    public function getNameReturnsInitialValueForString()
    {
        self::assertSame(
            '',
            $this->subject->getName()
        );

    }

    /**
     * @test
     */
    public function setNameForStringSetsName()
    {
        $this->subject->setName('Conceived at T3CON10');

        self::assertAttributeEquals(
            'Conceived at T3CON10',
            'name',
            $this->subject
        );

    }

    /**
     * @test
     */
    public function getAddressReturnsInitialValueForString()
    {
        self::assertSame(
            '',
            $this->subject->getAddress()
        );

    }

    /**
     * @test
     */
    public function setAddressForStringSetsAddress()
    {
        $this->subject->setAddress('Conceived at T3CON10');

        self::assertAttributeEquals(
            'Conceived at T3CON10',
            'address',
            $this->subject
        );

    }

    /**
     * @test
     */
    public function getCityReturnsInitialValueForString()
    {
        self::assertSame(
            '',
            $this->subject->getCity()
        );

    }

    /**
     * @test
     */
    public function setCityForStringSetsCity()
    {
        $this->subject->setCity('Conceived at T3CON10');

        self::assertAttributeEquals(
            'Conceived at T3CON10',
            'city',
            $this->subject
        );

    }

    /**
     * @test
     */
    public function getZipcodeReturnsInitialValueForString()
    {
        self::assertSame(
            '',
            $this->subject->getZipcode()
        );

    }

    /**
     * @test
     */
    public function setZipcodeForStringSetsZipcode()
    {
        $this->subject->setZipcode('Conceived at T3CON10');

        self::assertAttributeEquals(
            'Conceived at T3CON10',
            'zipcode',
            $this->subject
        );

    }

    /**
     * @test
     */
    public function getXcoordinateReturnsInitialValueForString()
    {
        self::assertSame(
            '',
            $this->subject->getXcoordinate()
        );

    }

    /**
     * @test
     */
    public function setXcoordinateForStringSetsXcoordinate()
    {
        $this->subject->setXcoordinate('Conceived at T3CON10');

        self::assertAttributeEquals(
            'Conceived at T3CON10',
            'xcoordinate',
            $this->subject
        );

    }

    /**
     * @test
     */
    public function getYcoordinateReturnsInitialValueForString()
    {
        self::assertSame(
            '',
            $this->subject->getYcoordinate()
        );

    }

    /**
     * @test
     */
    public function setYcoordinateForStringSetsYcoordinate()
    {
        $this->subject->setYcoordinate('Conceived at T3CON10');

        self::assertAttributeEquals(
            'Conceived at T3CON10',
            'ycoordinate',
            $this->subject
        );

    }

    /**
     * @test
     */
    public function getPortalReturnsInitialValueForString()
    {
        self::assertSame(
            '',
            $this->subject->getPortal()
        );

    }

    /**
     * @test
     */
    public function setPortalForStringSetsPortal()
    {
        $this->subject->setPortal('Conceived at T3CON10');

        self::assertAttributeEquals(
            'Conceived at T3CON10',
            'portal',
            $this->subject
        );

    }

    /**
     * @test
     */
    public function getEventReturnsInitialValueForEvent()
    {
        $newObjectStorage = new \TYPO3\CMS\Extbase\Persistence\ObjectStorage();
        self::assertEquals(
            $newObjectStorage,
            $this->subject->getEvent()
        );

    }

    /**
     * @test
     */
    public function setEventForObjectStorageContainingEventSetsEvent()
    {
        $event = new \T3Dev\Programmevents\Domain\Model\Event();
        $objectStorageHoldingExactlyOneEvent = new \TYPO3\CMS\Extbase\Persistence\ObjectStorage();
        $objectStorageHoldingExactlyOneEvent->attach($event);
        $this->subject->setEvent($objectStorageHoldingExactlyOneEvent);

        self::assertAttributeEquals(
            $objectStorageHoldingExactlyOneEvent,
            'event',
            $this->subject
        );

    }

    /**
     * @test
     */
    public function addEventToObjectStorageHoldingEvent()
    {
        $event = new \T3Dev\Programmevents\Domain\Model\Event();
        $eventObjectStorageMock = $this->getMockBuilder(\TYPO3\CMS\Extbase\Persistence\ObjectStorage::class)
            ->setMethods(['attach'])
            ->disableOriginalConstructor()
            ->getMock();

        $eventObjectStorageMock->expects(self::once())->method('attach')->with(self::equalTo($event));
        $this->inject($this->subject, 'event', $eventObjectStorageMock);

        $this->subject->addEvent($event);
    }

    /**
     * @test
     */
    public function removeEventFromObjectStorageHoldingEvent()
    {
        $event = new \T3Dev\Programmevents\Domain\Model\Event();
        $eventObjectStorageMock = $this->getMockBuilder(\TYPO3\CMS\Extbase\Persistence\ObjectStorage::class)
            ->setMethods(['detach'])
            ->disableOriginalConstructor()
            ->getMock();

        $eventObjectStorageMock->expects(self::once())->method('detach')->with(self::equalTo($event));
        $this->inject($this->subject, 'event', $eventObjectStorageMock);

        $this->subject->removeEvent($event);

    }
}
