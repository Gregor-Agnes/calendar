<?php
namespace Zwo3\Calendar\Domain\Model;

/***
 *
 * This file is part of the "calendar" Extension for TYPO3 CMS.
 *
 * For the full copyright and license information, please read the
 * LICENSE.txt file that was distributed with this source code.
 *
 *  (c) 2018 Gregor Agnes <ga@zwo3.de>, zwo3
 *
 ***/

use Carbon\Carbon;

/**
 * Event
 */
class Event extends \TYPO3\CMS\Extbase\DomainObject\AbstractEntity
{

    /**
     * uid
     *
     * @var int
     * @validate NotEmpty
     */
    protected $uid;

    /**
     * cruser_id
     *
     * @var int
     * @validate NotEmpty
     */
    protected $cruser_id;

    /**
     * crdate
     *
     * @var string
     * @validate NotEmpty
     */
    protected $crdate;

    /**
     * tstamp
     *
     * @var string
     * @validate NotEmpty
     */
    protected $tstamp;

    /**
     * title
     *
     * @var string
     * @validate NotEmpty
     */
    protected $title = '';

    /**
     * description
     *
     * @var string
     * @validate NotEmpty
     */
    protected $description = '';

    /**
     * start_date
     *
     * @var int
     * @validate NotEmpty
     */
    protected $startDate = '';

    /**
     * start_date
     *
     * @var int
     * @validate NotEmpty
     */
    protected $startTime = '';

    /**
     * organizer
     *
     * @var \Zwo3\Calendar\Domain\Model\Organizer
     * @lazy
     */
    protected $organizer = null;

    /**
     * startValue
     *
     * @var string
     * @validate NotEmpty
     */
    protected $start;

/** @var string */
    protected $stop;

    /**
     * exceptionEventGroup
     *
     * @var \TYPO3\CMS\Extbase\Persistence\ObjectStorage<\Zwo3\Calendar\Domain\Model\ExceptionEventGroup>
     * @lazy
     */
    protected $exceptionEventGroup = null;

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
        $this->exceptionEventGroup = new \TYPO3\CMS\Extbase\Persistence\ObjectStorage();
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
     * Returns the organizer
     *
     * @return \Zwo3\Calendar\Domain\Model\Organizer $organizer
     */
    public function getOrganizer()
    {
        return $this->organizer;
    }

    /**
     * Sets the organizer
     *
     * @param \Zwo3\Calendar\Domain\Model\Organizer $organizer
     * @return void
     */
    public function setOrganizer(\Zwo3\Calendar\Domain\Model\Organizer $organizer)
    {
        $this->organizer = $organizer;
    }

    /**
     * Adds a ExceptionEventGroup
     *
     * @param \Zwo3\Calendar\Domain\Model\ExceptionEventGroup $exceptionEventGroup
     * @return void
     */
    public function addExceptionEventGroup(\Zwo3\Calendar\Domain\Model\ExceptionEventGroup $exceptionEventGroup)
    {
        $this->exceptionEventGroup->attach($exceptionEventGroup);
    }

    /**
     * Removes a ExceptionEventGroup
     *
     * @param \Zwo3\Calendar\Domain\Model\ExceptionEventGroup $exceptionEventGroupToRemove The ExceptionEventGroup to be removed
     * @return void
     */
    public function removeExceptionEventGroup(\Zwo3\Calendar\Domain\Model\ExceptionEventGroup $exceptionEventGroupToRemove)
    {
        $this->exceptionEventGroup->detach($exceptionEventGroupToRemove);
    }

    /**
     * Returns the exceptionEventGroup
     *
     * @return \TYPO3\CMS\Extbase\Persistence\ObjectStorage<\Zwo3\Calendar\Domain\Model\ExceptionEventGroup> $exceptionEventGroup
     */
    public function getExceptionEventGroup()
    {
        return $this->exceptionEventGroup;
    }

    /**
     * Sets the exceptionEventGroup
     *
     * @param \TYPO3\CMS\Extbase\Persistence\ObjectStorage<\Zwo3\Calendar\Domain\Model\ExceptionEventGroup> $exceptionEventGroup
     * @return void
     */
    public function setExceptionEventGroup(\TYPO3\CMS\Extbase\Persistence\ObjectStorage $exceptionEventGroup)
    {
        $this->exceptionEventGroup = $exceptionEventGroup;
    }

    /**
     * @return mixed
     */
    public function getStop()
    {
        return $this->stop;
    }

    /**
     * @param mixed $stop
     */
    public function setStop($stop): void
    {
        $this->stop = $stop;
    }

    /**
     * @return string
     */
    public function getStart(): string
    {
        return Carbon::createFromFormat('Ymd', $this->getStartDate())->addSeconds($this->getStartTime());
    }

    /**
     * @param string $start
     */
    public function setStart(string $start): void
    {
        $this->start = $start;
    }

    /**
     * @return string
     */
    public function getDescription(): string
    {
        return $this->description;
    }

    /**
     * @param string $description
     */
    public function setDescription(string $description): void
    {
        $this->description = $description;
    }

    /**
     * @return int
     */
    public function getUid(): int
    {
        return $this->uid;
    }

    /**
     * @param int $uid
     */
    public function setUid(int $uid): void
    {
        $this->uid = $uid;
    }

    /**
     * @return int
     */
    public function getStartDate(): int
    {
        return $this->startDate;
    }

    /**
     * @param int $start_date
     */
    public function setStartDate(int $startDate): void
    {
        $this->startDate = $startDate;
    }

    /**
     * @return int
     */
    public function getStartTime(): int
    {
        return $this->startTime;
    }

    /**
     * @param int $start_time
     */
    public function setStartTime(int $startTime): void
    {
        $this->startTime = $startTime;
    }
}
