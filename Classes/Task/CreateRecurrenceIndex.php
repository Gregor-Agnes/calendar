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

        $freqMap = [
            'day' => 'DAILY',
            'week' => 'WEEKLY',
            'month' => 'MONTHLY',
            'year' => 'YEARLY'
        ];


        foreach($events as $event) {
            /** @var Event $event */
            if ($event->getFreq()) {
                $rule = (new Rule)
                    ->setStartDate(Carbon::parse($event->getStart()))
                    ->setTimezone($this->timezone)
                    ->setFreq($freqMap[$event->getFreq()])
                    ->setCount($event->getCnt());
                if ($event->getUntil()) {
                    $rule->setUntil(Carbon::parse($event->getUntil()));
                }
                    $rule->setInterval($event->getIntrval());
                    if ($rule -> getFreq() <=  Rule::$freqs['MONTHLY']) {
                       $rule->setByDay(explode(',', (strtoupper($event->getByday()))));
                    }
                    $rule->setByMonthDay(explode(',', (strtoupper($event->getBymonthday()))))
                    ->setByMonth(explode(',', (strtoupper($event->getBymonth()))))
                    ;

                $transfomer = new ArrayTransformer();
                //DebuggerUtility::var_dump($event->getExceptionEventGroup());
                //DebuggerUtility::var_dump($transfomer->transform($rule)->toArray());
            }


        }


        return true;
    }

}