<?php
namespace Zwo3\Calendar\Tests\Unit\Domain\Model;

/**
 * Test case.
 *
 * @author Gregor Agnes <ga@zwo3.de>
 */
class ExceptionEventGroupTest extends \TYPO3\CMS\Core\Tests\UnitTestCase
{
    /**
     * @var \Zwo3\Calendar\Domain\Model\ExceptionEventGroup
     */
    protected $subject = null;

    protected function setUp()
    {
        parent::setUp();
        $this->subject = new \Zwo3\Calendar\Domain\Model\ExceptionEventGroup();
    }

    protected function tearDown()
    {
        parent::tearDown();
    }

    /**
     * @test
     */
    public function getExceptionEventReturnsInitialValueForExceptonEvent()
    {
        $newObjectStorage = new \TYPO3\CMS\Extbase\Persistence\ObjectStorage();
        self::assertEquals(
            $newObjectStorage,
            $this->subject->getExceptionEvent()
        );
    }

    /**
     * @test
     */
    public function setExceptionEventForObjectStorageContainingExceptonEventSetsExceptionEvent()
    {
        $exceptionEvent = new \Zwo3\Calendar\Domain\Model\ExceptonEvent();
        $objectStorageHoldingExactlyOneExceptionEvent = new \TYPO3\CMS\Extbase\Persistence\ObjectStorage();
        $objectStorageHoldingExactlyOneExceptionEvent->attach($exceptionEvent);
        $this->subject->setExceptionEvent($objectStorageHoldingExactlyOneExceptionEvent);

        self::assertAttributeEquals(
            $objectStorageHoldingExactlyOneExceptionEvent,
            'exceptionEvent',
            $this->subject
        );
    }

    /**
     * @test
     */
    public function addExceptionEventToObjectStorageHoldingExceptionEvent()
    {
        $exceptionEvent = new \Zwo3\Calendar\Domain\Model\ExceptonEvent();
        $exceptionEventObjectStorageMock = $this->getMockBuilder(\TYPO3\CMS\Extbase\Persistence\ObjectStorage::class)
            ->setMethods(['attach'])
            ->disableOriginalConstructor()
            ->getMock();

        $exceptionEventObjectStorageMock->expects(self::once())->method('attach')->with(self::equalTo($exceptionEvent));
        $this->inject($this->subject, 'exceptionEvent', $exceptionEventObjectStorageMock);

        $this->subject->addExceptionEvent($exceptionEvent);
    }

    /**
     * @test
     */
    public function removeExceptionEventFromObjectStorageHoldingExceptionEvent()
    {
        $exceptionEvent = new \Zwo3\Calendar\Domain\Model\ExceptonEvent();
        $exceptionEventObjectStorageMock = $this->getMockBuilder(\TYPO3\CMS\Extbase\Persistence\ObjectStorage::class)
            ->setMethods(['detach'])
            ->disableOriginalConstructor()
            ->getMock();

        $exceptionEventObjectStorageMock->expects(self::once())->method('detach')->with(self::equalTo($exceptionEvent));
        $this->inject($this->subject, 'exceptionEvent', $exceptionEventObjectStorageMock);

        $this->subject->removeExceptionEvent($exceptionEvent);
    }
}
