<?php

namespace Zwo3\Calendar;

use Doctrine\DBAL\Query\QueryBuilder;
use TYPO3\CMS\Core\Database\ConnectionPool;
use TYPO3\CMS\Core\Utility\GeneralUtility;

class ext_update
{

    function main()
    {

        $result = $this->updateTxCalEvent();
        $result .= $this->updateTxCalIndex();
        $result .= $this->updateTxCalException();

        return $result;

    }

    function access()
    {
        return true;
    }

    protected function updateTxCalEvent() {
// Start und Stop als DateTime
        $queryBuilder = GeneralUtility::makeInstance(ConnectionPool::class)->getQueryBuilderForTable('tx_cal_event');

        /** @var QueryBuilder $queryBuilder */
        $rows =  $queryBuilder
            ->update('tx_cal_event')
            ->add(
                'set',
                /** @lang SQL */
                'start = DATE_ADD(CONCAT(SUBSTRING(`start_date`,1,4), \'-\', SUBSTRING(`start_date`,5,2), \'-\', SUBSTRING(`start_date`,7,2)), INTERVAL `start_time` SECOND), stop = DATE_ADD(CONCAT(SUBSTRING(`end_date`,1,4), \'-\', SUBSTRING(`end_date`,5,2), \'-\', SUBSTRING(`end_date`,7,2)), INTERVAL `end_time` SECOND)'
            )
            ->execute();
        return '<p>' . $rows . ' rows in tx_cal_event have been converted.</p>';

    }

    /**
     * @return string
     */
    protected function updateTxCalIndex() {
// Start und Stop als DateTime
        $queryBuilder = GeneralUtility::makeInstance(ConnectionPool::class)->getQueryBuilderForTable('tx_cal_index');

        /** @var QueryBuilder $queryBuilder */
        $rows =  $queryBuilder
            ->update('tx_cal_index')
            ->add(
                'set',
                /** @lang SQL */
                'start = CONCAT(SUBSTRING(`start_datetime`,1,4), \'-\', SUBSTRING(`start_datetime`,5,2), \'-\', SUBSTRING(`start_datetime`,7,2), \' \', SUBSTRING(`start_datetime`,9,2), \':\', SUBSTRING(`start_datetime`,11,2), \':\', SUBSTRING(`start_datetime`,13,2)),
stop = CONCAT(SUBSTRING(`end_datetime`,1,4), \'-\', SUBSTRING(`end_datetime`,5,2), \'-\', SUBSTRING(`end_datetime`,7,2), \' \', SUBSTRING(`end_datetime`,9,2), \':\', SUBSTRING(`end_datetime`,11,2), \':\', SUBSTRING(`end_datetime`,13,2))'

            )
            ->execute();
       // return $rows;
        return '<p>' . $rows . ' rows in tx_cal_index have been converted.</p>';

    }

    protected function updateTxCalException()
    {
        $queryBuilder = GeneralUtility::makeInstance(ConnectionPool::class)->getQueryBuilderForTable('tx_cal_exception_event');

        /** @var QueryBuilder $queryBuilder */
        $rows = $queryBuilder
            ->update('tx_cal_exception_event')
            ->add(
                'set',
                /** @lang SQL */
                'stop_date = CONCAT(SUBSTRING(`until`,1,4), \'-\', SUBSTRING(`until`,5,2), \'-\', SUBSTRING(`until`,7,2)),
                start = start_date,
stop = CONCAT(SUBSTRING(`until`,1,4), \'-\', SUBSTRING(`until`,5,2), \'-\', SUBSTRING(`until`,7,2))'

            )
            ->execute()
            ;
        return '<p>' . $rows . ' rows in tx_cal_exception_event have been converted.</p>';


    }
}