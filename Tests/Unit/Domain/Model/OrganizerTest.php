<?php
namespace Zwo3\Calendar\Tests\Unit\Domain\Model;

/**
 * Test case.
 *
 * @author Gregor Agnes <ga@zwo3.de>
 */
class OrganizerTest extends \TYPO3\CMS\Core\Tests\UnitTestCase
{
    /**
     * @var \Zwo3\Calendar\Domain\Model\Organizer
     */
    protected $subject = null;

    protected function setUp()
    {
        parent::setUp();
        $this->subject = new \Zwo3\Calendar\Domain\Model\Organizer();
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
}
