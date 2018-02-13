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
 * ExceptionEventGroup
 */
class ExceptionEventGroup extends \TYPO3\CMS\Extbase\DomainObject\AbstractEntity
{
    /**
     * exceptionEvent
     *
     * @var \TYPO3\CMS\Extbase\Persistence\ObjectStorage<\Zwo3\Calendar\Domain\Model\ExceptionEvent>
     */
    protected $exceptionEvent = null;

    /**
     * @var string
     */
    protected $title;

    /**
     * @return string
     */
    public function getTitle(): string
    {
        return $this->title;
    }

    /**
     * @param string $title
     */
    public function setTitle(string $title): void
    {
        $this->title = $title;
    }

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
        $this->exceptionEvent = new \TYPO3\CMS\Extbase\Persistence\ObjectStorage();
    }

    /**
     * Adds a ExceptionEvent
     *
     * @param \Zwo3\Calendar\Domain\Model\ExceptionEvent $exceptionEvent
     * @return void
     */
    public function addExceptionEvent(\Zwo3\Calendar\Domain\Model\ExceptionEvent $exceptionEvent)
    {
        $this->exceptionEvent->attach($exceptionEvent);
    }

    /**
     * Removes a ExceptionEvent
     *
     * @param \Zwo3\Calendar\Domain\Model\ExceptionEvent $exceptionEventToRemove The ExceptionEvent to be removed
     * @return void
     */
    public function removeExceptionEvent(\Zwo3\Calendar\Domain\Model\ExceptionEvent $exceptionEventToRemove)
    {
        $this->exceptionEvent->detach($exceptionEventToRemove);
    }

    /**
     * Returns the exceptionEvent
     *
     * @return \TYPO3\CMS\Extbase\Persistence\ObjectStorage<\Zwo3\Calendar\Domain\Model\ExceptionEvent> $exceptionEvent
     */
    public function getExceptionEvent()
    {
        return $this->exceptionEvent;
    }

    /**
     * Sets the exceptionEvent
     *
     * @param \TYPO3\CMS\Extbase\Persistence\ObjectStorage<\Zwo3\Calendar\Domain\Model\ExceptionEvent> $exceptionEvent
     * @return void
     */
    public function setExceptionEvent(\TYPO3\CMS\Extbase\Persistence\ObjectStorage $exceptionEvent)
    {
        $this->exceptionEvent = $exceptionEvent;
    }
}
