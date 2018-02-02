<?php
defined('TYPO3_MODE') || die();

if (!isset($GLOBALS['TCA']['tx_cal_organizer']['ctrl']['type'])) {
    // no type field defined, so we define it here. This will only happen the first time the extension is installed!!
    $GLOBALS['TCA']['tx_cal_organizer']['ctrl']['type'] = 'tx_extbase_type';
    $tempColumnstx_calendar_tx_cal_organizer = [];
    $tempColumnstx_calendar_tx_cal_organizer[$GLOBALS['TCA']['tx_cal_organizer']['ctrl']['type']] = [
        'exclude' => true,
        'label'   => 'LLL:EXT:calendar/Resources/Private/Language/locallang_db.xlf:tx_calendar.tx_extbase_type',
        'config' => [
            'type' => 'select',
            'renderType' => 'selectSingle',
            'items' => [
                ['',''],
                ['Organizer','Tx_Calendar_Organizer']
            ],
            'default' => 'Tx_Calendar_Organizer',
            'size' => 1,
            'maxitems' => 1,
        ]
    ];
    \TYPO3\CMS\Core\Utility\ExtensionManagementUtility::addTCAcolumns('tx_cal_organizer', $tempColumnstx_calendar_tx_cal_organizer);
}

\TYPO3\CMS\Core\Utility\ExtensionManagementUtility::addToAllTCAtypes(
    'tx_cal_organizer',
    $GLOBALS['TCA']['tx_cal_organizer']['ctrl']['type'],
    '',
    'after:' . $GLOBALS['TCA']['tx_cal_organizer']['ctrl']['label']
);

$tmp_calendar_columns = [

    'title' => [
        'exclude' => true,
        'label' => 'LLL:EXT:calendar/Resources/Private/Language/locallang_db.xlf:tx_calendar_domain_model_organizer.title',
        'config' => [
            'type' => 'input',
            'size' => 30,
            'eval' => 'trim,required'
        ],
    ],

];

\TYPO3\CMS\Core\Utility\ExtensionManagementUtility::addTCAcolumns('tx_cal_organizer',$tmp_calendar_columns);

/* inherit and extend the show items from the parent class */

if (isset($GLOBALS['TCA']['tx_cal_organizer']['types']['0']['showitem'])) {
    $GLOBALS['TCA']['tx_cal_organizer']['types']['Tx_Calendar_Organizer']['showitem'] = $GLOBALS['TCA']['tx_cal_organizer']['types']['0']['showitem'];
} elseif(is_array($GLOBALS['TCA']['tx_cal_organizer']['types'])) {
    // use first entry in types array
    $tx_cal_organizer_type_definition = reset($GLOBALS['TCA']['tx_cal_organizer']['types']);
    $GLOBALS['TCA']['tx_cal_organizer']['types']['Tx_Calendar_Organizer']['showitem'] = $tx_cal_organizer_type_definition['showitem'];
} else {
    $GLOBALS['TCA']['tx_cal_organizer']['types']['Tx_Calendar_Organizer']['showitem'] = '';
}
$GLOBALS['TCA']['tx_cal_organizer']['types']['Tx_Calendar_Organizer']['showitem'] .= ',--div--;LLL:EXT:calendar/Resources/Private/Language/locallang_db.xlf:tx_calendar_domain_model_organizer,';
$GLOBALS['TCA']['tx_cal_organizer']['types']['Tx_Calendar_Organizer']['showitem'] .= 'title';

$GLOBALS['TCA']['tx_cal_organizer']['columns'][$GLOBALS['TCA']['tx_cal_organizer']['ctrl']['type']]['config']['items'][] = ['LLL:EXT:calendar/Resources/Private/Language/locallang_db.xlf:tx_cal_organizer.tx_extbase_type.Tx_Calendar_Organizer','Tx_Calendar_Organizer'];

\TYPO3\CMS\Core\Utility\ExtensionManagementUtility::addLLrefForTCAdescr(
    '',
    'EXT:/Resources/Private/Language/locallang_csh_.xlf'
);
