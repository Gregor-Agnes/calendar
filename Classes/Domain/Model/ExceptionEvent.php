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

/**
 * ExceptionEvent
 */
class ExceptionEvent extends \TYPO3\CMS\Extbase\DomainObject\AbstractEntity
{
    /**
     * title
     *
     * @var string
     * @validate NotEmpty
     */
    protected $title = '';


    /**
     * startDate
     *
     * @validate NotEmpty
     * @var string
     */
    protected $startDate;

    /**
     * stopDate
     *
     * @var string
     */
    protected $stopDate;

    /** @var string */
    protected $freq = '';
    /** @var int */
    protected $until;
    /** @var int */
    protected $cnt;

    /** @var string */
    protected $byday;
    /** @var string */
    protected $bymonthday;
    /** @var string */
    protected $bymonth;

    /** @var int */
    protected $intrval;

    /** @var string */
    protected $rdate;

    /** @var string */
    protected $rdateType;

    /** @var string */
    protected $start;

    /** @var string */
    protected $stop;



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
     * @return string
     */
    public function getStopDate(): string
    {
        return $this->stopDate;
    }

    /**
     * @param string $stopDate
     */
    public function setStopDate(string $stopDate): void
    {
        $this->stopDate = $stopDate;
    }

    /**
     * @return string
     */
    public function getStartDate(): string
    {
        return $this->startDate;
    }

    /**
     * @param string $startDate
     */
    public function setStartDate(string $startDate): void
    {
        $this->startDate = $startDate;
    }

    /**
     * @return string
     */
    public function getFreq()
    {
        return $this->freq;
    }

    /**
     * @param string $freq
     */
    public function setFreq($freq)
    {
        $this->freq = $freq;
    }

    /**
     * @return int
     */
    public function getUntil()
    {
        return $this->until;
    }

    /**
     * @param int $until
     */
    public function setUntil($until)
    {
        $this->until = $until;
    }

    /**
     * @return int
     */
    public function getCnt()
    {
        return $this->cnt;
    }

    /**
     * @param int $cnt
     */
    public function setCnt($cnt)
    {
        $this->cnt = $cnt;
    }

    /**
     * @return string
     */
    public function getByday()
    {
        return $this->byday;
    }

    /**
     * @param string $byday
     */
    public function setByday($byday)
    {
        $this->byday = $byday;
    }

    /**
     * @return string
     */
    public function getBymonthday()
    {
        return $this->bymonthday;
    }

    /**
     * @param string $bymonthday
     */
    public function setBymonthday($bymonthday)
    {
        $this->bymonthday = $bymonthday;
    }

    /**
     * @return string
     */
    public function getBymonth()
    {
        return $this->bymonth;
    }

    /**
     * @param string $bymonth
     */
    public function setBymonth($bymonth)
    {
        $this->bymonth = $bymonth;
    }

    /**
     * @return int
     */
    public function getIntrval()
    {
        return $this->intrval;
    }

    /**
     * @param int $intrval
     */
    public function setIntrval($intrval)
    {
        $this->intrval = $intrval;
    }

    /**
     * @return string
     */
    public function getRdate()
    {
        return $this->rdate;
    }

    /**
     * @param string $rdate
     */
    public function setRdate($rdate)
    {
        $this->rdate = $rdate;
    }

    /**
     * @return string
     */
    public function getRdateType()
    {
        return $this->rdateType;
    }

    /**
     * @param string $rdateType
     */
    public function setRdateType($rdateType)
    {
        $this->rdateType = $rdateType;
    }

    /**
     * @return string
     */
    public function getStart()
    {
        return $this->start;
    }

    /**
     * @param string $start
     */
    public function setStart($start)
    {
        $this->start = $start;
    }

    /**
     * @return string
     */
    public function getStop()
    {
        return $this->stop;
    }

    /**
     * @param string $stop
     */
    public function setStop($stop)
    {
        $this->stop = $stop;
    }

}
