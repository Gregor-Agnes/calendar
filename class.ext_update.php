<?php

namespace Zwo3\Calendar;

use Doctrine\DBAL\Query\QueryBuilder;
use TYPO3\CMS\Core\Database\ConnectionPool;
use TYPO3\CMS\Core\Utility\GeneralUtility;

class ext_update
{

    function main()
    {
        // Start und Stop als DateTime

        $queryBuilder = GeneralUtility::makeInstance(ConnectionPool::class)->getQueryBuilderForTable('tx_cal_event');

        /** @var QueryBuilder $queryBuilder */
        $rows =  $queryBuilder
            ->update('tx_cal_event')
            ->add(
                'set',
                'start = DATE_ADD(CONCAT(SUBSTRING(`start_date`,1,4), \'-\', SUBSTRING(`start_date`,5,2), \'-\', SUBSTRING(`start_date`,7,2)), INTERVAL `start_time` SECOND), stop = DATE_ADD(CONCAT(SUBSTRING(`end_date`,1,4), \'-\', SUBSTRING(`end_date`,5,2), \'-\', SUBSTRING(`end_date`,7,2)), INTERVAL `end_time` SECOND)'
            )
            ->execute();
        return $rows . ' have been converted';

    }

    function access()
    {
        return true;
    }
}