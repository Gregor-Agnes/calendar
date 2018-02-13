<?php
namespace Zwo3\Calendar\Tests\Unit\Domain\Model;

/**
 * Test case.
 *
 * @author Gregor Agnes <ga@zwo3.de>
 */
class ExceptionEventTest extends \TYPO3\CMS\Core\Tests\UnitTestCase
{
    /**
     * @var \Zwo3\Calendar\Domain\Model\ExceptionEvent
     */
    protected $subject = null;

    protected function setUp()
    {
        parent::setUp();
        $this->subject = new \Zwo3\Calendar\Domain\Model\ExceptionEvent();
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
    public function getStartDateReturnsInitialValueForDateTime()
    {
        self::assertEquals(
            null,
            $this->subject->getStartDate()
        );
    }

    /**
     * @test
     */
    public function setStartDateForDateTimeSetsStartDate()
    {
        $dateTimeFixture = new \DateTime();
        $this->subject->setStartDate($dateTimeFixture);

        self::assertAttributeEquals(
            $dateTimeFixture,
            'startDate',
            $this->subject
        );
    }

    /**
     * @test
     */
    public function getStopDateReturnsInitialValueForDateTime()
    {
        self::assertEquals(
            null,
            $this->subject->getStopDate()
        );
    }

    /**
     * @test
     */
    public function setStopDateForDateTimeSetsStopDate()
    {
        $dateTimeFixture = new \DateTime();
        $this->subject->setStopDate($dateTimeFixture);

        self::assertAttributeEquals(
            $dateTimeFixture,
            'stopDate',
            $this->subject
        );
    }
}
