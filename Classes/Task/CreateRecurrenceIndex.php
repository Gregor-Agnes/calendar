<?php

namespace Zwo3\Calendar\Task;

use Carbon\Carbon;
use Recurr\Recurrence;
use Recurr\Rule;
use Recurr\Transformer\ArrayTransformer;
use TYPO3\CMS\Core\Database\Connection;
use TYPO3\CMS\Core\Database\ConnectionPool;
use TYPO3\CMS\Core\Database\Query\QueryBuilder;
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
class CreateRecurrenceIndex extends \TYPO3\CMS\Scheduler\Task\AbstractTask {

    /**
     * eventRepository
     *
     * @var \Zwo3\Calendar\Domain\Repository\EventRepository
     *
     *
     */
    protected $eventRepository = null;

    protected $timezone = 'Europe/Berlin';

    /**
     * @return bool
     * @throws \Recurr\Exception\InvalidArgument
     * @throws \Recurr\Exception\InvalidWeekday
     */
    public function execute()
    {
        /** @var ObjectManager $objectManager */
        $objectManager = GeneralUtility::makeInstance(ObjectManager::class);
        $this->eventRepository = $objectManager->get(EventRepository::class);

        $events = $this->eventRepository->findAll();

        //DebuggerUtility::var_dump($events);


        /** @var \Zwo3\Calendar\Service\RecurrenceGenerator $recurrenceGenerator */
        $recurrenceGenerator = $objectManager->get(RecurrenceGenerator::class);

        // Clear the index
        GeneralUtility::makeInstance(ConnectionPool::class)->getConnectionForTable('tx_cal_index')->truncate('tx_cal_index');

        foreach($events as $event) {
            /** @var Event $event */

            $recurrences = $recurrenceGenerator->createRecurrencesFromEvent($event);
            $dataArray = [];
            foreach ($recurrences as $recurrence) {
                //DebuggerUtility::var_dump($recurrence);
                /** @var Recurrence $recurrence */
                $dataArray[] = [
                  'start' => $recurrence->getStart()->format('Y-m-d H:i:s'),
                    'stop' => $recurrence->getEnd()->format('Y-m-d H:i:s'),
                    'tablename' => 'tx_cal_event',
                    'event_uid' => $event->getUid()
                ];
            }


            /** @var Connection $queryBuilder */
            $queryBuilder = GeneralUtility::makeInstance(ConnectionPool::class);

            $queryBuilder
                ->getConnectionForTable('tx_cal_index')
                ->bulkInsert(
                'tx_cal_index',
                $dataArray,
                ['start', 'stop', 'tablename', 'event_uid'],
                [Connection::PARAM_STR, Connection::PARAM_STR, Connection::PARAM_STR, Connection::PARAM_INT]
                );




        }


        return true;
    }

}