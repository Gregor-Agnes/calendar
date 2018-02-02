<?php
namespace Zwo3\Calendar\Tests\Unit\Controller;

/**
 * Test case.
 *
 * @author Gregor Agnes <ga@zwo3.de>
 */
class OrganizerControllerTest extends \TYPO3\CMS\Core\Tests\UnitTestCase
{
    /**
     * @var \Zwo3\Calendar\Controller\OrganizerController
     */
    protected $subject = null;

    protected function setUp()
    {
        parent::setUp();
        $this->subject = $this->getMockBuilder(\Zwo3\Calendar\Controller\OrganizerController::class)
            ->setMethods(['redirect', 'forward', 'addFlashMessage'])
            ->disableOriginalConstructor()
            ->getMock();
    }

    protected function tearDown()
    {
        parent::tearDown();
    }

    /**
     * @test
     */
    public function listActionFetchesAllOrganizersFromRepositoryAndAssignsThemToView()
    {

        $allOrganizers = $this->getMockBuilder(\TYPO3\CMS\Extbase\Persistence\ObjectStorage::class)
            ->disableOriginalConstructor()
            ->getMock();

        $organizerRepository = $this->getMockBuilder(\::class)
            ->setMethods(['findAll'])
            ->disableOriginalConstructor()
            ->getMock();
        $organizerRepository->expects(self::once())->method('findAll')->will(self::returnValue($allOrganizers));
        $this->inject($this->subject, 'organizerRepository', $organizerRepository);

        $view = $this->getMockBuilder(\TYPO3\CMS\Extbase\Mvc\View\ViewInterface::class)->getMock();
        $view->expects(self::once())->method('assign')->with('organizers', $allOrganizers);
        $this->inject($this->subject, 'view', $view);

        $this->subject->listAction();
    }

    /**
     * @test
     */
    public function showActionAssignsTheGivenOrganizerToView()
    {
        $organizer = new \Zwo3\Calendar\Domain\Model\Organizer();

        $view = $this->getMockBuilder(\TYPO3\CMS\Extbase\Mvc\View\ViewInterface::class)->getMock();
        $this->inject($this->subject, 'view', $view);
        $view->expects(self::once())->method('assign')->with('organizer', $organizer);

        $this->subject->showAction($organizer);
    }
}
