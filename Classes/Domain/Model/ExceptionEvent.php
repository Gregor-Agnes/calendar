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
     * @var \DateTime
     * @validate NotEmpty
     */
    protected $startDate = null;

    /**
     * stopDate
     *
     * @var string
     * @validate NotEmpty
     */
    protected $stopDate = null;

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
     * Returns the startDate
     *
     * @return \DateTime $startDate
     */
    public function getStartDate()
    {
        return $this->startDate;
    }

    /**
     * Sets the startDate
     *
     * @param \DateTime $startDate
     * @return void
     */
    public function setStartDate(\DateTime $startDate)
    {
        $this->startDate = $startDate;
    }

    /**
     * Returns the stopDate
     *
     * @return \DateTime $stopDate
     */
    public function getStopDate()
    {
        return $this->stopDate;
    }

    /**
     * Sets the stopDate
     *
     * @param \DateTime $stopDate
     * @return void
     */
    public function setStopDate(\DateTime $stopDate)
    {
        $this->stopDate = $stopDate;
    }
}
