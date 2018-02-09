<?php

namespace Zwo3\Calendar\Task;

use Recurr\Recurrence;
use Recurr\Rule;
use TYPO3\CMS\Core\Utility\GeneralUtility;
use TYPO3\CMS\Extbase\Object\ObjectManager;
use TYPO3\CMS\Extbase\Utility\DebuggerUtility;
use Zwo3\Calendar\Domain\Model\Event;
use Zwo3\Calendar\Domain\Repository\EventRepository;

/**
 * Class CreateRecurrenceIndex
 *
 * @package Zwo3\Calendar\Task
 */
class CreateRecurrenceIndex  extends \TYPO3\CMS\Scheduler\Task\AbstractTask {

    /**
     * eventRepository
     *
     * @var \Zwo3\Calendar\Domain\Repository\EventRepository
     *
     */
    protected $eventRepository = null;

    public function __construct()
    {
    }

    public function execute()
    {
        /** @var ObjectManager $objectManager */
        $objectManager = GeneralUtility::makeInstance(ObjectManager::class);
        $this->eventRepository = $objectManager->get(EventRepository::class);

        $events = $this->eventRepository->findAll(false);


        foreach($events as $event) {
            /** @var Event $event */
            if ($event->getFreq()) {
                $rule = (new Rule)
                    ->setStartDate($event->getStart())

            }

        }


    }

}