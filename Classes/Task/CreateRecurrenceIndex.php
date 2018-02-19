<?php

namespace Zwo3\Calendar\Task;

use Carbon\Carbon;
use Recurr\Recurrence;
use Recurr\Rule;
use Recurr\Transformer\ArrayTransformer;
use TYPO3\CMS\Core\Utility\GeneralUtility;
use TYPO3\CMS\Extbase\Object\ObjectManager;
use TYPO3\CMS\Extbase\Utility\DebuggerUtility;
use Zwo3\Calendar\Domain\Model\Event;
use Zwo3\Calendar\Domain\Repository\EventRepository;
use Zwo3\Calendar\Service\RecurrenceGenerator;

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
     *
     */
    protected $eventRepository = null;

    protected $timezone = 'Europe/Berlin';

    public function __construct()
    {
    }

    public function execute()
    {
        /** @var ObjectManager $objectManager */
        $objectManager = GeneralUtility::makeInstance(ObjectManager::class);
        $this->eventRepository = $objectManager->get(EventRepository::class);

        $events = $this->eventRepository->findAll(false);

        //DebuggerUtility::var_dump($events);


        /** @var \Zwo3\Calendar\Service\RecurrenceGenerator $recurrenceGenerator */
        $recurrenceGenerator = $objectManager->get(RecurrenceGenerator::class);


        foreach($events as $event) {
            /** @var Event $event */



            $recurrences = $recurrenceGenerator->createRecurrencesFromEvent($event);

            DebuggerUtility::var_dump($recurrences);


        }


        return true;
    }

}