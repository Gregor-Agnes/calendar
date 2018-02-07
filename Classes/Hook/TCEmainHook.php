<?php

namespace Zwo3\Calendar\Hook;

use Carbon\Carbon;
use TYPO3\CMS\Core\Database\ConnectionPool;
use TYPO3\CMS\Core\Database\Query\QueryBuilder;
use TYPO3\CMS\Core\Utility\GeneralUtility;
use TYPO3\CMS\Extbase\Utility\DebuggerUtility;

/**
 * Class TCEmainHook
 *
 * @package Zwo3\Calendar\Hook
 */
class TCEmainHook
{

    public function processCmdmap_preProcess(
        $command,
        $table,
        $id,
        $value,
        \TYPO3\CMS\Core\DataHandling\DataHandler &$pObj
    ) {
    }

    public function processCmdmap_postProcess(
        $command,
        $table,
        $id,
        $value,
        \TYPO3\CMS\Core\DataHandling\DataHandler &$pObj
    ) {
    }

    public function processDatamap_preProcessFieldArray(
        array &$fieldArray,
        $table,
        $id,
        \TYPO3\CMS\Core\DataHandling\DataHandler &$pObj
    ) {
        // 1970-01-01T18:00:00+00:00
        $startDate = Carbon::parse($fieldArray['start_date']);
        $startTime = Carbon::parse($fieldArray['start_time']);

        $startDateTime = $startDate->addSeconds($startTime->secondsSinceMidnight())->toDateTimeString();

        $endDate = Carbon::parse($fieldArray['end_date']);
        $endTime = Carbon::parse($fieldArray['end_time']);

        $endDateTime = $endDate->addSeconds($endTime->secondsSinceMidnight())->toDateTimeString();

        $queryBuilder = GeneralUtility::makeInstance(ConnectionPool::class)->getQueryBuilderForTable('tx_cal_event');

        /** @var QueryBuilder $queryBuilder */
        $update =  $queryBuilder
            ->update('tx_cal_event')
            ->set('start', $startDateTime)
            ->set('stop', $endDateTime)
            ->where (
             $queryBuilder->expr()->eq('uid', $queryBuilder->createNamedParameter($id))
            )->execute();

    }

    public function processCmdmap_deleteAction(
        $table,
        $id,
        $recordToDelete,
        $recordWasDeleted = null,
        \TYPO3\CMS\Core\DataHandling\DataHandler &$pObj
    ) {
    }

    public function processDatamap_afterAllOperations(\TYPO3\CMS\Core\DataHandling\DataHandler &$pObj)
    {
    }

    public function processDatamap_postProcessFieldArray(
        $status,
        $table,
        $id,
        array &$fieldArray,
        \TYPO3\CMS\Core\DataHandling\DataHandler &$pObj
    ) {
    }

    public function processDatamap_afterDatabaseOperations(
        $status,
        $table,
        $id,
        array $fieldArray,
        \TYPO3\CMS\Core\DataHandling\DataHandler &$pObj
    ) {
    }
}