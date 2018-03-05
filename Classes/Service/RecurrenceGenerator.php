<?php

namespace Zwo3\Calendar\Service;

use Carbon\Carbon;
use DateTime;
use Doctrine\Common\Util\Debug;
use Recurr\Recurrence;
use Recurr\Rule;
use Recurr\Transformer\ArrayTransformer;
use TYPO3\CMS\Core\Utility\GeneralUtility;
use TYPO3\CMS\Extbase\Object\ObjectManager;
use TYPO3\CMS\Extbase\Utility\DebuggerUtility;
use Zwo3\Calendar\Domain\Model\Event;
use Zwo3\Calendar\Domain\Model\ExceptionEvent;
use Zwo3\Calendar\Domain\Repository\ExceptionEventRepository;

/**
 * Class CreateRecurrenceFromEvent
 *
 * @package Zwo3\Calendar\Service
 */
class RecurrenceGenerator
{

    /** @var string */
    protected $timezone = 'Europe/Berlin';

    protected $freqMap = [];

    /** @var ArrayTransformer */
    protected $transformer = null;

    public $exceptionCache;

    protected $exceptionEventRepository = null;

    public function __construct()
    {
        $this->freqMap = [
            'day' => 'DAILY',
            'week' => 'WEEKLY',
            'month' => 'MONTHLY',
            'year' => 'YEARLY'
        ];

        $this->objectManager = GeneralUtility::makeInstance(ObjectManager::class);

        $this->transformer = new ArrayTransformer();

        $this->exceptionEventRepository = $this->objectManager->get(ExceptionEventRepository::class);

        $this->exceptionCache = $this->getExceptionEventCache();
    }

    /**
     * @param Event|ExceptionEvent $event
     * @throws \Recurr\Exception\InvalidArgument
     * @throws \Recurr\Exception\InvalidWeekday
     * @return array
     */
    public function createRecurrencesFromEvent($event)
    {
        // Todo: Es gibt auch Exception-Events mit Recurrences, diese habe ich noch nicht berücksichtigt...
        if ($event->getFreq()) {
            /** @var Rule $rule */
            $rule = $this->getRecurrences($event);
            // nur für events
                if ($event->getExceptionEventGroup()) {
                    DebuggerUtility::var_dump($event->getExceptionEventGroup(), 'E-Event-Group');
                }
                if ($event->getExceptionEvent()) {
                    foreach ($event->getExceptionEvent()->toArray() as $exceptionEvent) {
                        /** @var ExceptionEvent $exceptionEvent */
                        if (!$exceptionEvent) {
                            continue;
                        }
                        if (Carbon::parse($exceptionEvent->getStartDate())->getTimestamp() > Carbon::parse($rule->getUntil())->getTimestamp()) {
                            continue;
                        }
                        DebuggerUtility::var_dump($exceptionEvent, "E-Event");

                        if ($exceptionEvent->getStopDate()) {
                            // it is a range
                            $theDay = Carbon::parse($exceptionEvent->getStartDate());
                            while ($theDay->getTimestamp() <= Carbon::parse($exceptionEvent->getStopDate())->getTimestamp()) {
                                $exclusionArray[] = $theDay->toDateString();
                                $theDay->addDay(1);
                            }
                        } else {
                            // it is a single date
                            $exclusionArray[] = $exceptionEvent->getStartDate();
                        }
                    }

                if (count((array)$exclusionArray) > 0) {
                    $rule->setExDates($exclusionArray);
                }
            }

            return $this->transformer->transform($rule)->toArray();
        } else {
            return [];
        }
    }

    /**
     * @return array
     * @throws \Recurr\Exception\InvalidWeekday
     */
    protected function getExceptionEventCache()
    {
        $allExceptionEvents = $this->exceptionEventRepository->findAll()->toArray();

        $exceptionCache = [];

        foreach ($allExceptionEvents as $exceptionEvent) {
            /** @var ExceptionEvent $exceptionEvent */
            if ($exceptionEvent->getFreq() !== 'none') {
                $rule = $this->getRecurrences($exceptionEvent);
                #DebuggerUtility::var_dump(end($this->transformer->transform($rule)->toArray())->getStart());
                foreach ($this->transformer->transform($rule)->toArray() as $date) {
                    if (end($this->transformer->transform($rule)->toArray())->getStart() < new DateTime()) {
                        // wenn in der Vergangenheit, irrelevant
                        // TODO Autodelete??
                        continue;
                    } else {
                        $exceptionCache[$exceptionEvent->getUid()][] = $date->getStart();
                    }
                }
            } else {
                if (new DateTime($exceptionEvent->getStart()) < new DateTime()) {
                    // wenn in der Vergangenheit, irrelevant
                    // TODO Autodelete??
                    continue;
                } else {
                    $exceptionCache[$exceptionEvent->getUid()][] = new DateTime($exceptionEvent->getStart());
                }
            }
        }
        return $exceptionCache;
    }

    /**
     * @param Event|ExceptionEvent $event
     * @return Rule
     */
    protected function getRecurrences($event)
    {
        /** @var Rule $rule */
        #DebuggerUtility::var_dump($event->getStart());
        #DebuggerUtility::var_dump(Carbon::parse($event->getStart())->toDateString());
        $rule = (GeneralUtility::makeInstance(Rule::class))->setStartDate(new DateTime($event->getStart()))//->setEndDate(Carbon::parse($event->getStop()))
            ->setTimezone($this->timezone)->setFreq($this->freqMap[$event->getFreq()]);
        if ($event->getCnt()) {
            $rule->setCount($event->getCnt());
        }
        if ($event->getUntil()) {
            $until = Carbon::parse($event->getUntil());
            $rule->setUntil($until);
        }
        if ($event->getIntrval()) {
            $rule->setInterval($event->getIntrval());
        }
        #if ($rule->getFreq() >  Rule::$freqs['MONTHLY']) {
        #    $rule->setByDay(explode(',', (strtoupper($event->getByday()))));
        # }
        if ($event->getBymonthday()) {
            $rule->setByMonthDay(explode(',', (strtoupper($event->getBymonthday()))));
        }
        if ($event->getBymonth()) {
            $rule->setByMonth(explode(',', (strtoupper($event->getBymonth()))));
        };

        return $rule;
    }
}