<?php
namespace T3Dev\Programmevents\Tests\Unit\Domain\Model;

/**
 * Test case.
 *
 * @author Dmitry Vasilev <dmitry@t3dev.ru>
 */
class EventTest extends \TYPO3\CMS\Core\Tests\UnitTestCase
{
    /**
     * @var \T3Dev\Programmevents\Domain\Model\Event
     */
    protected $subject = null;

    protected function setUp()
    {
        parent::setUp();
        $this->subject = new \T3Dev\Programmevents\Domain\Model\Event();
    }

    protected function tearDown()
    {
        parent::tearDown();
    }

    /**
     * @test
     */
    public function getTitleReturnsInitialValueForString()
    {
        self::assertSame(
            '',
            $this->subject->getTitle()
        );

    }

    /**
     * @test
     */
    public function setTitleForStringSetsTitle()
    {
        $this->subject->setTitle('Conceived at T3CON10');

        self::assertAttributeEquals(
            'Conceived at T3CON10',
            'title',
            $this->subject
        );

    }

    /**
     * @test
     */
    public function getIdReturnsInitialValueForInt()
    {
    }

    /**
     * @test
     */
    public function setIdForIntSetsId()
    {
    }

    /**
     * @test
     */
    public function getTypeReturnsInitialValueForString()
    {
        self::assertSame(
            '',
            $this->subject->getType()
        );

    }

    /**
     * @test
     */
    public function setTypeForStringSetsType()
    {
        $this->subject->setType('Conceived at T3CON10');

        self::assertAttributeEquals(
            'Conceived at T3CON10',
            'type',
            $this->subject
        );

    }

    /**
     * @test
     */
    public function getDatebeginReturnsInitialValueForString()
    {
        self::assertSame(
            '',
            $this->subject->getDatebegin()
        );

    }

    /**
     * @test
     */
    public function setDatebeginForStringSetsDatebegin()
    {
        $this->subject->setDatebegin('Conceived at T3CON10');

        self::assertAttributeEquals(
            'Conceived at T3CON10',
            'datebegin',
            $this->subject
        );

    }

    /**
     * @test
     */
    public function getTimebeginReturnsInitialValueForString()
    {
        self::assertSame(
            '',
            $this->subject->getTimebegin()
        );

    }

    /**
     * @test
     */
    public function setTimebeginForStringSetsTimebegin()
    {
        $this->subject->setTimebegin('Conceived at T3CON10');

        self::assertAttributeEquals(
            'Conceived at T3CON10',
            'timebegin',
            $this->subject
        );

    }

    /**
     * @test
     */
    public function getFormatteddateReturnsInitialValueForString()
    {
        self::assertSame(
            '',
            $this->subject->getFormatteddate()
        );

    }

    /**
     * @test
     */
    public function setFormatteddateForStringSetsFormatteddate()
    {
        $this->subject->setFormatteddate('Conceived at T3CON10');

        self::assertAttributeEquals(
            'Conceived at T3CON10',
            'formatteddate',
            $this->subject
        );

    }

    /**
     * @test
     */
    public function getWeekdaybeginReturnsInitialValueForString()
    {
        self::assertSame(
            '',
            $this->subject->getWeekdaybegin()
        );

    }

    /**
     * @test
     */
    public function setWeekdaybeginForStringSetsWeekdaybegin()
    {
        $this->subject->setWeekdaybegin('Conceived at T3CON10');

        self::assertAttributeEquals(
            'Conceived at T3CON10',
            'weekdaybegin',
            $this->subject
        );

    }

    /**
     * @test
     */
    public function getCategoriesReturnsInitialValueForString()
    {
        self::assertSame(
            '',
            $this->subject->getCategories()
        );

    }

    /**
     * @test
     */
    public function setCategoriesForStringSetsCategories()
    {
        $this->subject->setCategories('Conceived at T3CON10');

        self::assertAttributeEquals(
            'Conceived at T3CON10',
            'categories',
            $this->subject
        );

    }

    /**
     * @test
     */
    public function getImageReturnsInitialValueForString()
    {
        self::assertSame(
            '',
            $this->subject->getImage()
        );

    }

    /**
     * @test
     */
    public function setImageForStringSetsImage()
    {
        $this->subject->setImage('Conceived at T3CON10');

        self::assertAttributeEquals(
            'Conceived at T3CON10',
            'image',
            $this->subject
        );

    }

    /**
     * @test
     */
    public function getLocationReturnsInitialValueForLocation()
    {
        self::assertEquals(
            null,
            $this->subject->getLocation()
        );

    }

    /**
     * @test
     */
    public function setLocationForLocationSetsLocation()
    {
        $locationFixture = new \T3Dev\Programmevents\Domain\Model\Location();
        $this->subject->setLocation($locationFixture);

        self::assertAttributeEquals(
            $locationFixture,
            'location',
            $this->subject
        );

    }
}
