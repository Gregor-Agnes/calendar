<?php
defined('TYPO3_MODE') || die();

if (!isset($GLOBALS['TCA']['tx_cal_exception_event']['ctrl']['type'])) {
    // no type field defined, so we define it here. This will only happen the first time the extension is installed!!
    $GLOBALS['TCA']['tx_cal_exception_event']['ctrl']['type'] = 'tx_extbase_type';
    $tempColumnstx_calendar_tx_cal_exception_event = [];
    $tempColumnstx_calendar_tx_cal_exception_event[$GLOBALS['TCA']['tx_cal_exception_event']['ctrl']['type']] = [
        'exclude' => true,
        'label'   => 'LLL:EXT:calendar/Resources/Private/Language/locallang_db.xlf:tx_calendar.tx_extbase_type',
        'config' => [
            'type' => 'select',
            'renderType' => 'selectSingle',
            'items' => [
                ['',''],
                ['ExceptonEvent','Tx_Calendar_ExceptonEvent']
            ],
            'default' => 'Tx_Calendar_ExceptonEvent',
            'size' => 1,
            'maxitems' => 1,
        ]
    ];
    \TYPO3\CMS\Core\Utility\ExtensionManagementUtility::addTCAcolumns('tx_cal_exception_event', $tempColumnstx_calendar_tx_cal_exception_event);
}

\TYPO3\CMS\Core\Utility\ExtensionManagementUtility::addToAllTCAtypes(
    'tx_cal_exception_event',
    $GLOBALS['TCA']['tx_cal_exception_event']['ctrl']['type'],
    '',
    'after:' . $GLOBALS['TCA']['tx_cal_exception_event']['ctrl']['label']
);

$tmp_calendar_columns = [

    'title' => [
        'exclude' => true,
        'label' => 'LLL:EXT:calendar/Resources/Private/Language/locallang_db.xlf:tx_calendar_domain_model_exceptonevent.title',
        'config' => [
            'type' => 'input',
            'size' => 30,
            'eval' => 'trim,required'
        ],
    ],
    'start_date' => [
        'exclude' => true,
        'label' => 'LLL:EXT:calendar/Resources/Private/Language/locallang_db.xlf:tx_calendar_domain_model_exceptonevent.start_date',
        'config' => [
            'dbType' => 'date',
            'type' => 'input',
            'size' => 7,
            'eval' => 'date,required',
            'default' => '0000-00-00'
        ],
    ],
    'stop_date' => [
        'exclude' => true,
        'label' => 'LLL:EXT:calendar/Resources/Private/Language/locallang_db.xlf:tx_calendar_domain_model_exceptonevent.stop_date',
        'config' => [
            'dbType' => 'date',
            'type' => 'input',
            'size' => 7,
            'eval' => 'date,required',
            'default' => '0000-00-00'
        ],
    ],

];

\TYPO3\CMS\Core\Utility\ExtensionManagementUtility::addTCAcolumns('tx_cal_exception_event',$tmp_calendar_columns);

/* inherit and extend the show items from the parent class */

if (isset($GLOBALS['TCA']['tx_cal_exception_event']['types']['0']['showitem'])) {
    $GLOBALS['TCA']['tx_cal_exception_event']['types']['Tx_Calendar_ExceptonEvent']['showitem'] = $GLOBALS['TCA']['tx_cal_exception_event']['types']['0']['showitem'];
} elseif(is_array($GLOBALS['TCA']['tx_cal_exception_event']['types'])) {
    // use first entry in types array
    $tx_cal_exception_event_type_definition = reset($GLOBALS['TCA']['tx_cal_exception_event']['types']);
    $GLOBALS['TCA']['tx_cal_exception_event']['types']['Tx_Calendar_ExceptonEvent']['showitem'] = $tx_cal_exception_event_type_definition['showitem'];
} else {
    $GLOBALS['TCA']['tx_cal_exception_event']['types']['Tx_Calendar_ExceptonEvent']['showitem'] = '';
}
$GLOBALS['TCA']['tx_cal_exception_event']['types']['Tx_Calendar_ExceptonEvent']['showitem'] .= ',--div--;LLL:EXT:calendar/Resources/Private/Language/locallang_db.xlf:tx_calendar_domain_model_exceptonevent,';
$GLOBALS['TCA']['tx_cal_exception_event']['types']['Tx_Calendar_ExceptonEvent']['showitem'] .= 'title, start_date, stop_date';

$GLOBALS['TCA']['tx_cal_exception_event']['columns'][$GLOBALS['TCA']['tx_cal_exception_event']['ctrl']['type']]['config']['items'][] = ['LLL:EXT:calendar/Resources/Private/Language/locallang_db.xlf:tx_cal_exception_event.tx_extbase_type.Tx_Calendar_ExceptonEvent','Tx_Calendar_ExceptonEvent'];

\TYPO3\CMS\Core\Utility\ExtensionManagementUtility::addLLrefForTCAdescr(
    '',
    'EXT:/Resources/Private/Language/locallang_csh_.xlf'
);
