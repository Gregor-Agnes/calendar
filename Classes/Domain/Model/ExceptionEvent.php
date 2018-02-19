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

}
