<?php

namespace Zwo3\Calendar\Domain\Repository;

/***
 * This file is part of the "calendar" Extension for TYPO3 CMS.
 * For the full copyright and license information, please read the
 * LICENSE.txt file that was distributed with this source code.
 *  (c) 2018 Gregor Agnes <ga@zwo3.de>, zwo3
 ***/

use Carbon\Carbon;
use Doctrine\Common\Persistence\ObjectManager;
use TYPO3\CMS\Core\Database\ConnectionPool;
use TYPO3\CMS\Core\Database\Query\QueryBuilder;
use TYPO3\CMS\Core\Utility\GeneralUtility;
use TYPO3\CMS\Extbase\Persistence\Generic\Typo3QuerySettings;
use TYPO3\CMS\Extbase\Persistence\QueryInterface;
use TYPO3\CMS\Extbase\Property\PropertyMappingConfigurationBuilder;
use TYPO3\CMS\Extbase\Property\PropertyMappingConfigurationInterface;
use TYPO3\CMS\Extbase\Property\TypeConverter\IntegerConverter;
use TYPO3\CMS\Extbase\Property\TypeConverter\PersistentObjectConverter;
use TYPO3\CMS\Extbase\Utility\DebuggerUtility;

/**
 * The repository for Events
 */
class EventRepository extends \TYPO3\CMS\Extbase\Persistence\Repository
{

    /**
     * @var array
     */
    protected $defaultOrderings = [
        'sorting' => \TYPO3\CMS\Extbase\Persistence\QueryInterface::ORDER_ASCENDING
    ];

    public function initializeObject()
    {
        // Einstellungen laden
        /** @var Typo3QuerySettings $querySettings */
        $querySettings = $this->objectManager->get(Typo3QuerySettings::class);

        // Einstellungen bearbeiten
        #$querySettings->setSomething();

        $querySettings->setRespectStoragePage(false);

        // Einstellungen als Default setzen
        # $this->setDefaultQuerySettings($querySettings);
    }


    public function findAll()
    {


       # $query = $this->createQuery();
        #        $queryParser = $this->objectManager->get(\TYPO3\CMS\Extbase\Persistence\Generic\Storage\Typo3DbQueryParser::class);
       #  \TYPO3\CMS\Extbase\Utility\DebuggerUtility::var_dump($queryParser->convertQueryToDoctrineQueryBuilder($query)->getSQL());
       # \TYPO3\CMS\Extbase\Utility\DebuggerUtility::var_dump($queryParser->convertQueryToDoctrineQueryBuilder($query)->getParameters());

       # return $query->execute();

        return parent::findAll(); // TODO: Change the autogenerated stub
    }

    /**
     * @return array|\TYPO3\CMS\Extbase\Persistence\QueryResultInterface
     */
    public function findAll__($withRecurrence = true, $maxResults = 20)
    {

        /** @var QueryBuilder $queryBuilder */
        $queryBuilder = GeneralUtility::makeInstance(ConnectionPool::class)->getQueryBuilderForTable('tx_cal_event');

        $queryBuilder
            ->add('select', 'tx_cal_event.* ,GROUP_CONCAT(ex_eg.uid) AS exceptionEventGroup')
            ->groupBy('tx_cal_event.uid')
            ->from('tx_cal_event')
            ->where(
                ('tx_cal_event.start > ' . Carbon::now()->toDateString())
            );
        if ($withRecurrence) {
            $queryBuilder->rightJoin(
                'tx_cal_event',
                'tx_cal_index',
                'index',
                $queryBuilder->expr()->eq('index.event_uid', $queryBuilder->quoteIdentifier('tx_cal_event.uid'))
            );
        }
        $queryBuilder->join(
            'tx_cal_event',
            'tx_cal_exception_event_mm',
            'ex_mm',
            $queryBuilder->expr()->eq('tx_cal_event.uid', $queryBuilder->quoteIdentifier('ex_mm.uid_local'))
        );
        $queryBuilder->join(
            'ex_mm',
            'tx_cal_exception_event_group',
            'ex_eg',
            $queryBuilder->expr()->eq('ex_mm.uid_foreign', $queryBuilder->quoteIdentifier('ex_eg.uid'))
        );
        if ($maxResults) {
            $queryBuilder->setMaxResults($maxResults);
        }
        $eventsArray = $queryBuilder->execute()->fetchAll();

        #DebuggerUtility::var_dump($eventsArray);
        #$eventsArray = $queryBuilder->getSQL();

        // Array values mappen -> Event
        /** @var \TYPO3\CMS\Extbase\Property\PropertyMappingConfiguration $mappingConfiguration */
        $mappingConfiguration = $this->objectManager
            ->get('TYPO3\CMS\Extbase\Property\PropertyMappingConfigurationBuilder')
            ->build();
        $mappingConfiguration
            ->allowAllPropertiesExcept(...[
                'deleted',
                'hidden',
                'starttime',
                'endtime',
                'start_date',
                'end_date',
                'start_time',
                'end_time',
                'uid_local',
                'uid_foreign',
                'tablenames',
                'crdate',
                'tstamp',
                'cruser_id',
                't3ver_oid',
                't3ver_id',
                't3ver_label',
                't3ver_state',
                't3ver_stage',
                't3ver_count',
                't3ver_tstamp',
                't3ver_wsid',
                't3_origuid',
                'sys_language_uid',
                'l18n_parent',
                'l18n_diffsource',
                't3ver_move_id',
                'l10n_state',
                'exception_event_group'
            ])
            ->skipUnknownProperties()
            ->setMapping('calendar_id', 'calendarId')
            ->setMapping('category_id', 'categoryId')
            ->setMapping('organizer_id', 'organizer')
            ->setMapping('organizer_pid', 'organizerPid')
            ->setMapping('organizer_link', 'organizerLink')
            ->setMapping('location_id', 'locationId')
            ->setMapping('location_pid', 'locationPid')
            ->setMapping('location_link', 'locationLink')
            ->setMapping('rdate_type', 'rdateType')
            ->setMapping('monitor_cnt', 'monitorCnt')
            ->setMapping('exception_cnt', 'monitorCnt')
            ->setMapping('fe_cruser_id', 'feCruserId')
            ->setMapping('fe_crgroup_id', 'feCrgroupId')
            ->setMapping('shared_user_cnt', 'sharedUserCnt')
            ->setMapping('ext_url', 'extUrl')
            ->setMapping('ref_event_id', 'refEventId')
            ->setMapping('send_invitation', 'sendInvitation')
            ->setMapping('no_auto_pb', 'noAutoPb')
            ->setMapping('tx_z3calfields_fees', 'txZ3calfieldsFees')
            ->setMapping('tx_z3calfields_contact', 'txZ3calfieldsContact')
            //->forProperty('exceptionEventGroup')->setTypeConverterOption()
            ;
        $exceptionEventGroupMappingConfiguration = $mappingConfiguration->getConfigurationFor('exceptionEventGroup');

        //DebuggerUtility::var_dump($exceptionEventGroupMappingConfiguration->getTargetPropertyName('exceptionEventGroups'));
        foreach ($eventsArray as $event) {
            //DebuggerUtility::var_dump($event);
            $events[] = $this->objectManager->get('TYPO3\CMS\Extbase\Property\PropertyMapper')
                ->convert(
                    $event,
                    'Zwo3\Calendar\Domain\Model\Event',
                    $mappingConfiguration
                );
        }
        return $events;

       # DebuggerUtility::var_dump($events);

        #return parent::findAll(); // TODO: Change the autogenerated stub
    }

}
