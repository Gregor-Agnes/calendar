<?php
namespace Zwo3\Calendar\Service;


use Carbon\Carbon;
use Recurr\Recurrence;
use Recurr\Rule;
use Recurr\Transformer\ArrayTransformer;
use TYPO3\CMS\Core\Utility\GeneralUtility;
use TYPO3\CMS\Extbase\Utility\DebuggerUtility;
use Zwo3\Calendar\Domain\Model\Event;
use Zwo3\Calendar\Domain\Model\ExceptionEvent;

/**
 * Class CreateRecurrenceFromEvent
 *
 * @package Zwo3\Calendar\Service
 */
class RecurrenceGenerator {

    /** @var string  */
    protected $timezone = 'Europe/Berlin';

    protected $freqMap = [];

    /** @var ArrayTransformer */
    protected $transformer = null;

    protected $exceptionCache;

    public function __construct()
    {
        $this->freqMap = [
            'day' => 'DAILY',
            'week' => 'WEEKLY',
            'month' => 'MONTHLY',
            'year' => 'YEARLY'
        ];

        $this->transformer = new ArrayTransformer();
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
            $rule = (GeneralUtility::makeInstance(Rule::class))
                ->setStartDate(Carbon::parse($event->getStart()))
                ->setEndDate(Carbon::parse($event->getStop()))
                ->setTimezone($this->timezone)
                ->setFreq($this->freqMap[$event->getFreq()]);
            if ($event->getCnt()) {
                $rule->setCount($event->getCnt());
            }
            if ($event->getUntil()) {
                $rule->setUntil(Carbon::parse($event->getUntil()));
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

            // nur für events
            if ($event instanceof Event) {
                foreach($event->getExceptionEvent()->toArray() as $exceptionEvent) {
                    /** @var ExceptionEvent $exceptionEvent */
                    if (Carbon::parse($exceptionEvent->getStartDate())->getTimestamp() > Carbon::parse($rule->getUntil())->getTimestamp()) {
                        #continue;
                    }
                    // Recurrences of exception
                    if ($exceptionEvent->getFreq()) {
                        if (!key_exists($exceptionEvent->getUid())) {
                            $exceptionRecurrences = $this->createRecurrencesFromEvent($exceptionEvent);
                            $this->exceptionCache[$exceptionEvent->getUid()] = $exceptionRecurrences;
                        }
                    }
                    //DebuggerUtility::var_dump($exceptionEvent);
                    if ($exceptionEvent->getStopDate()) {
                        // it is a range
                        $theDay = Carbon::parse($exceptionEvent->getStartDate());
                        while($theDay->getTimestamp() <= Carbon::parse($exceptionEvent->getStopDate())->getTimestamp()) {
                            $exclusionArray[] = $theDay->toDateString();
                            $theDay->addDay(1);
                        }
                    } else {
                        // it is a single date
                        $exclusionArray[] = $exceptionEvent->getStartDate();
                    }
                }

                if (count($exclusionArray) > 0) {
                    $rule->setExDates($exclusionArray);
                }
            }



            return $this->transformer->transform($rule)->toArray();
        } else {
            return [];
        }

    }

}