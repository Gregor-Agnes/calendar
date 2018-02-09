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

    /** @var string */
    var $freq = '';
    /** @var int */
    var $until;
    /** @var int */
    var $cnt;

    /** @var string */
    var $byday;
    /** @var string */
    var $bymonthday;
    /** @var string */
    var $bymonth;

    /** @var int */
    var $intrval;

    /** @var string */
    var $rdate;

    /** @var string */
    var $rdate_type;

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
     * @return string
     */
    public function getFreq(): string
    {
        return $this->freq;
    }

    /**
     * @param string $freq
     */
    public function setFreq(string $freq): void
    {
        $this->freq = $freq;
    }

    /**
     * @return int
     */
    public function getUntil(): int
    {
        return $this->until;
    }

    /**
     * @param int $until
     */
    public function setUntil(int $until): void
    {
        $this->until = $until;
    }

    /**
     * @return int
     */
    public function getCnt(): int
    {
        return $this->cnt;
    }

    /**
     * @param int $cnt
     */
    public function setCnt(int $cnt): void
    {
        $this->cnt = $cnt;
    }

    /**
     * @return string
     */
    public function getByday(): string
    {
        return $this->byday;
    }

    /**
     * @param string $byday
     */
    public function setByday(string $byday): void
    {
        $this->byday = $byday;
    }

    /**
     * @return string
     */
    public function getBymonthday(): string
    {
        return $this->bymonthday;
    }

    /**
     * @param string $bymonthday
     */
    public function setBymonthday(string $bymonthday): void
    {
        $this->bymonthday = $bymonthday;
    }

    /**
     * @return string
     */
    public function getBymonth(): string
    {
        return $this->bymonth;
    }

    /**
     * @param string $bymonth
     */
    public function setBymonth(string $bymonth): void
    {
        $this->bymonth = $bymonth;
    }

    /**
     * @return int
     */
    public function getIntrval(): int
    {
        return $this->intrval;
    }

    /**
     * @param int $intrval
     */
    public function setIntrval(int $intrval): void
    {
        $this->intrval = $intrval;
    }

    /**
     * @return string
     */
    public function getRdate(): string
    {
        return $this->rdate;
    }

    /**
     * @param string $rdate
     */
    public function setRdate(string $rdate): void
    {
        $this->rdate = $rdate;
    }

    /**
     * @return string
     */
    public function getRdateType(): string
    {
        return $this->rdate_type;
    }

    /**
     * @param string $rdate_type
     */
    public function setRdateType(string $rdate_type): void
    {
        $this->rdate_type = $rdate_type;
    }
}
