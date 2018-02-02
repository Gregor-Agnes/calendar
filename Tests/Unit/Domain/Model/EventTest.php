<?php
namespace Zwo3\Calendar\Tests\Unit\Domain\Model;

/**
 * Test case.
 *
 * @author Gregor Agnes <ga@zwo3.de>
 */
class EventTest extends \TYPO3\CMS\Core\Tests\UnitTestCase
{
    /**
     * @var \Zwo3\Calendar\Domain\Model\Event
     */
    protected $subject = null;

    protected function setUp()
    {
        parent::setUp();
        $this->subject = new \Zwo3\Calendar\Domain\Model\Event();
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
    public function getOrganizerReturnsInitialValueForOrganizer()
    {
        self::assertEquals(
            null,
            $this->subject->getOrganizer()
        );
    }

    /**
     * @test
     */
    public function setOrganizerForOrganizerSetsOrganizer()
    {
        $organizerFixture = new \Zwo3\Calendar\Domain\Model\Organizer();
        $this->subject->setOrganizer($organizerFixture);

        self::assertAttributeEquals(
            $organizerFixture,
            'organizer',
            $this->subject
        );
    }

    /**
     * @test
     */
    public function getExceptionEventGroupReturnsInitialValueForExceptionEventGroup()
    {
        $newObjectStorage = new \TYPO3\CMS\Extbase\Persistence\ObjectStorage();
        self::assertEquals(
            $newObjectStorage,
            $this->subject->getExceptionEventGroup()
        );
    }

    /**
     * @test
     */
    public function setExceptionEventGroupForObjectStorageContainingExceptionEventGroupSetsExceptionEventGroup()
    {
        $exceptionEventGroup = new \Zwo3\Calendar\Domain\Model\ExceptionEventGroup();
        $objectStorageHoldingExactlyOneExceptionEventGroup = new \TYPO3\CMS\Extbase\Persistence\ObjectStorage();
        $objectStorageHoldingExactlyOneExceptionEventGroup->attach($exceptionEventGroup);
        $this->subject->setExceptionEventGroup($objectStorageHoldingExactlyOneExceptionEventGroup);

        self::assertAttributeEquals(
            $objectStorageHoldingExactlyOneExceptionEventGroup,
            'exceptionEventGroup',
            $this->subject
        );
    }

    /**
     * @test
     */
    public function addExceptionEventGroupToObjectStorageHoldingExceptionEventGroup()
    {
        $exceptionEventGroup = new \Zwo3\Calendar\Domain\Model\ExceptionEventGroup();
        $exceptionEventGroupObjectStorageMock = $this->getMockBuilder(\TYPO3\CMS\Extbase\Persistence\ObjectStorage::class)
            ->setMethods(['attach'])
            ->disableOriginalConstructor()
            ->getMock();

        $exceptionEventGroupObjectStorageMock->expects(self::once())->method('attach')->with(self::equalTo($exceptionEventGroup));
        $this->inject($this->subject, 'exceptionEventGroup', $exceptionEventGroupObjectStorageMock);

        $this->subject->addExceptionEventGroup($exceptionEventGroup);
    }

    /**
     * @test
     */
    public function removeExceptionEventGroupFromObjectStorageHoldingExceptionEventGroup()
    {
        $exceptionEventGroup = new \Zwo3\Calendar\Domain\Model\ExceptionEventGroup();
        $exceptionEventGroupObjectStorageMock = $this->getMockBuilder(\TYPO3\CMS\Extbase\Persistence\ObjectStorage::class)
            ->setMethods(['detach'])
            ->disableOriginalConstructor()
            ->getMock();

        $exceptionEventGroupObjectStorageMock->expects(self::once())->method('detach')->with(self::equalTo($exceptionEventGroup));
        $this->inject($this->subject, 'exceptionEventGroup', $exceptionEventGroupObjectStorageMock);

        $this->subject->removeExceptionEventGroup($exceptionEventGroup);
    }
}
