<?php
defined('TYPO3_MODE') || die();

if (!isset($GLOBALS['TCA']['tx_cal_event']['ctrl']['type'])) {
    // no type field defined, so we define it here. This will only happen the first time the extension is installed!!
    $GLOBALS['TCA']['tx_cal_event']['ctrl']['type'] = 'tx_extbase_type';
    $tempColumnstx_calendar_tx_cal_event = [];
    $tempColumnstx_calendar_tx_cal_event[$GLOBALS['TCA']['tx_cal_event']['ctrl']['type']] = [
        'exclude' => true,
        'label' => 'LLL:EXT:calendar/Resources/Private/Language/locallang_db.xlf:tx_calendar.tx_extbase_type',
        'config' => [
            'type' => 'select',
            'renderType' => 'selectSingle',
            'items' => [
                ['', ''],
                ['Event', 'Tx_Calendar_Event']
            ],
            'default' => 'Tx_Calendar_Event',
            'size' => 1,
            'maxitems' => 1,
        ]
    ];
    \TYPO3\CMS\Core\Utility\ExtensionManagementUtility::addTCAcolumns('tx_cal_event',
        $tempColumnstx_calendar_tx_cal_event);
}

\TYPO3\CMS\Core\Utility\ExtensionManagementUtility::addToAllTCAtypes(
    'tx_cal_event',
    $GLOBALS['TCA']['tx_cal_event']['ctrl']['type'],
    '',
    'after:' . $GLOBALS['TCA']['tx_cal_event']['ctrl']['label']
);

$tmp_calendar_columns = [

    'title' => [
        'exclude' => true,
        'label' => 'LLL:EXT:calendar/Resources/Private/Language/locallang_db.xlf:tx_calendar_domain_model_event.title',
        'config' => [
            'type' => 'input',
            'size' => 30,
            'eval' => 'trim,required'
        ],
    ],
    'organizer' => [
        'exclude' => true,
        'label' => 'LLL:EXT:calendar/Resources/Private/Language/locallang_db.xlf:tx_calendar_domain_model_event.organizer',
        'config' => [
            'type' => 'select',
            'renderType' => 'selectSingle',
            'foreign_table' => 'tx_cal_organizer',
            'minitems' => 0,
            'maxitems' => 1,
        ],
    ],
    'exception_event_group' => [
        'exclude' => true,
        'label' => 'LLL:EXT:calendar/Resources/Private/Language/locallang_db.xlf:tx_calendar_domain_model_event.exception_event_group',
        'config' => [
            'type' => 'select',
            'renderType' => 'selectMultipleSideBySide',
            'foreign_table' => 'tx_cal_exception_event_group',
            'MM' => 'tx_cal_exception_event_mm',
            'MM_match_fields' => [
                'tablenames' => 'tx_cal_exception_event_group'
            ],
            'autoSizeMax' => 30,
            'maxitems' => 9999,
            'multiple' => 0,
            'wizards' => [
                '_PADDING' => 1,
                '_VERTICAL' => 1,
                'edit' => [
                    'module' => [
                        'name' => 'wizard_edit',
                    ],
                    'type' => 'popup',
                    'title' => 'Edit',
                    // todo define label: LLL:EXT:.../Resources/Private/Language/locallang_tca.xlf:wizard.edit
                    'icon' => 'EXT:backend/Resources/Public/Images/FormFieldWizard/wizard_edit.gif',
                    'popup_onlyOpenIfSelected' => 1,
                    'JSopenParams' => 'height=350,width=580,status=0,menubar=0,scrollbars=1',
                ],
                'add' => [
                    'module' => [
                        'name' => 'wizard_add',
                    ],
                    'type' => 'script',
                    'title' => 'Create new',
                    // todo define label: LLL:EXT:.../Resources/Private/Language/locallang_tca.xlf:wizard.add
                    'icon' => 'EXT:backend/Resources/Public/Images/FormFieldWizard/wizard_add.gif',
                    'params' => [
                        'table' => 'tx_cal_exception_event_group',
                        'pid' => '###CURRENT_PID###',
                        'setValue' => 'prepend'
                    ],
                ],
            ],
        ],

    ],

];

\TYPO3\CMS\Core\Utility\ExtensionManagementUtility::addTCAcolumns('tx_cal_event', $tmp_calendar_columns);

/* inherit and extend the show items from the parent class */

if (isset($GLOBALS['TCA']['tx_cal_event']['types']['1']['showitem'])) {
    $GLOBALS['TCA']['tx_cal_event']['types']['Tx_Calendar_Event']['showitem'] = $GLOBALS['TCA']['tx_cal_event']['types']['1']['showitem'];
} elseif (is_array($GLOBALS['TCA']['tx_cal_event']['types'])) {
    // use first entry in types array
    $tx_cal_event_type_definition = reset($GLOBALS['TCA']['tx_cal_event']['types']);
    $GLOBALS['TCA']['tx_cal_event']['types']['Tx_Calendar_Event']['showitem'] = $tx_cal_event_type_definition['showitem'];
} else {
    $GLOBALS['TCA']['tx_cal_event']['types']['Tx_Calendar_Event']['showitem'] = '';
}
$GLOBALS['TCA']['tx_cal_event']['types']['Tx_Calendar_Event']['showitem'] .= ',--div--;LLL:EXT:calendar/Resources/Private/Language/locallang_db.xlf:tx_calendar_domain_model_event,';
$GLOBALS['TCA']['tx_cal_event']['types']['Tx_Calendar_Event']['showitem'] .= 'title, organizer, exception_event_group';

$GLOBALS['TCA']['tx_cal_event']['columns'][$GLOBALS['TCA']['tx_cal_event']['ctrl']['type']]['config']['items'][] = [
    'LLL:EXT:calendar/Resources/Private/Language/locallang_db.xlf:tx_cal_event.tx_extbase_type.Tx_Calendar_Event',
    'Tx_Calendar_Event'
];

\TYPO3\CMS\Core\Utility\ExtensionManagementUtility::addLLrefForTCAdescr(
    '',
    'EXT:/Resources/Private/Language/locallang_csh_.xlf'
);
