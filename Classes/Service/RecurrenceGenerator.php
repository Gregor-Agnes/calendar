<?php

namespace Zwo3\Calendar\Service;

use Carbon\Carbon;
use DateTime;
use Doctrine\Common\Util\Debug;
use Recurr\Recurrence;
use Recurr\Rule;
use Recurr\Transformer\ArrayTransformer;
use TYPO3\CMS\Core\Database\ConnectionPool;
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

    /**
     * @var ExceptionEventRepository
     */
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
     * @param array $exlusions
     * @return array
     * @throws \Recurr\Exception\InvalidWeekday
     */
    public function createRecurrencesFromEvent($event)
    {

        $exclusions = [];
        $queryBuilder = GeneralUtility::makeInstance(ConnectionPool::class)->getQueryBuilderForTable('tx_cal_exception_event');
        $exceptionEventIds = $queryBuilder
            ->select('uid_foreign')
            ->from('tx_cal_exception_event_mm', 'ee_mm')
            ->where(
                $queryBuilder->expr()->eq('uid_local', $event->getUid()),
                $queryBuilder->expr()->eq('tablenames', '"tx_cal_exception_event"')
            )
            ->execute()
            ->fetchAll();

        #DebuggerUtility::var_dump($this->exceptionCache);


        foreach($exceptionEventIds as $exceptionEventId) {
            //DebuggerUtility::var_dump($this->exceptionEventRepository->findByUid($exceptionEventId));
            #if ($this->exceptionEventRepository->findByUid($exceptionEventId)) {
            #    $eventObject->getExceptionEvent()->attach( $this->exceptionEventRepository->findByUid($exceptionEventId));
            #}
            #DebuggerUtility::var_dump($this->recurrenceGenerator->exceptionCache[$exceptionEventId['uid_foreign']]);
            array_push($exclusions, ...$this->exceptionCache[$exceptionEventId['uid_foreign']]);
            # DebuggerUtility::var_dump($exclusions);
        }

        // ExceptionEventGroups werden hier schon nach ExceptionEvents aufgelöst und attached
        $queryBuilder = GeneralUtility::makeInstance(ConnectionPool::class)->getQueryBuilderForTable('tx_cal_exception_event_group_mm');
        $queryBuilder
            ->select('eeg_mm.uid_foreign')
            ->from('tx_cal_exception_event_group_mm', 'eeg_mm')
            ->leftJoin(
                'eeg_mm',
                'tx_cal_exception_event_mm',
                'ee_mm',
                'eeg_mm.uid_local = ee_mm.uid_foreign AND ee_mm.tablenames = "tx_cal_exception_event_group"'
            )
            ->where(
                $queryBuilder->expr()->eq('ee_mm.uid_local', $event->getUid())
            )
        ;
        $exceptionEventIds = $queryBuilder->execute()
            ->fetchAll();

        foreach($exceptionEventIds as $exceptionEventId) {
            #if ($this->exceptionEventRepository->findByUid($exceptionEventId)) {
            #    $eventObject->getExceptionEvent()->attach( $this->exceptionEventRepository->findByUid($exceptionEventId));
            #}
            #DebuggerUtility::var_dump($this->recurrenceGenerator->exceptionCache[$exceptionEventId['uid_foreign']]);
            array_push($exclusions, ...$this->exceptionCache[$exceptionEventId['uid_foreign']]);
        }

        #DebuggerUtility::var_dump($exclusions, $event->getUid());


        // Todo: Es gibt auch Exception-Events mit Recurrences, diese habe ich noch nicht berücksichtigt...
        if ($event->getFreq()) {
            /** @var Rule $rule */
            $rule = $this->getRecurrences($event);
            $rule->setExDates($exclusions);


            return $this->transformer->transform($rule)->toArray();
        } else {
            return [];
        }
    }


    /**
     * @param Event|ExceptionEvent $event
     * @return Rule
     * @throws \Recurr\Exception\InvalidArgument
     */
    protected function getRecurrences($event)
    {
        /** @var Rule $rule */
        #DebuggerUtility::var_dump($event->getStart());
        #DebuggerUtility::var_dump(Carbon::parse($event->getStart())->toDateString());
        $rule = (GeneralUtility::makeInstance(Rule::class))->setStartDate(new DateTime($event->getStart()))//->setEndDate(Carbon::parse($event->getStop()))
        ->setTimezone($this->timezone)->setFreq($this->freqMap[$event->getFreq()]);

        if ($event->getStop() && $event instanceof Event) {
            #DebuggerUtility::var_dump($event->getStop(), $event->getUid());
            $rule->setEndDate(new DateTime($event->getStop()));
        }
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
        if ($rule->getFreq() <  Rule::$freqs['WEEKLY']) {
            // TODO Im BE kann byDay auf für weekly gesetzt werden, für Recurr geht das aber erst am monthly!
            $rule->setByDay(explode(',', (strtoupper($event->getByday()))));
         }
        if ($event->getBymonthday()) {
            $rule->setByMonthDay(explode(',', (strtoupper($event->getBymonthday()))));
        }
        if ($event->getBymonth()) {
            $rule->setByMonth(explode(',', (strtoupper($event->getBymonth()))));
        };

        return $rule;
    }

    /**
     * @return array
     * @throws \Recurr\Exception\InvalidArgument
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
                        $exceptionCache[$exceptionEvent->getUid()][] = $date->getStart()->format('Ymd');
                    }
                }
            } else {
                if (new DateTime($exceptionEvent->getStart()) < new DateTime()) {
                    // wenn in der Vergangenheit, irrelevant
                    // TODO Autodelete??
                    continue;
                } else {
                    $date = new DateTime($exceptionEvent->getStart());
                    $exceptionCache[$exceptionEvent->getUid()][] = $date->format('Ymd');
                }
            }
        }

        return $exceptionCache;
    }

}