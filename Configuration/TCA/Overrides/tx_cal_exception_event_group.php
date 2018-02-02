<?php
defined('TYPO3_MODE') || die();

if (!isset($GLOBALS['TCA']['tx_cal_exception_event_group']['ctrl']['type'])) {
    // no type field defined, so we define it here. This will only happen the first time the extension is installed!!
    $GLOBALS['TCA']['tx_cal_exception_event_group']['ctrl']['type'] = 'tx_extbase_type';
    $tempColumnstx_calendar_tx_cal_exception_event_group = [];
    $tempColumnstx_calendar_tx_cal_exception_event_group[$GLOBALS['TCA']['tx_cal_exception_event_group']['ctrl']['type']] = [
        'exclude' => true,
        'label'   => 'LLL:EXT:calendar/Resources/Private/Language/locallang_db.xlf:tx_calendar.tx_extbase_type',
        'config' => [
            'type' => 'select',
            'renderType' => 'selectSingle',
            'items' => [
                ['',''],
                ['ExceptionEventGroup','Tx_Calendar_ExceptionEventGroup']
            ],
            'default' => 'Tx_Calendar_ExceptionEventGroup',
            'size' => 1,
            'maxitems' => 1,
        ]
    ];
    \TYPO3\CMS\Core\Utility\ExtensionManagementUtility::addTCAcolumns('tx_cal_exception_event_group', $tempColumnstx_calendar_tx_cal_exception_event_group);
}

\TYPO3\CMS\Core\Utility\ExtensionManagementUtility::addToAllTCAtypes(
    'tx_cal_exception_event_group',
    $GLOBALS['TCA']['tx_cal_exception_event_group']['ctrl']['type'],
    '',
    'after:' . $GLOBALS['TCA']['tx_cal_exception_event_group']['ctrl']['label']
);

$tmp_calendar_columns = [

    'exception_event' => [
        'exclude' => true,
        'label' => 'LLL:EXT:calendar/Resources/Private/Language/locallang_db.xlf:tx_calendar_domain_model_exceptioneventgroup.exception_event',
        'config' => [
            'type' => 'select',
            'renderType' => 'selectMultipleSideBySide',
            'foreign_table' => 'tx_cal_exception_event',
            'MM' => 'tx_calendar_exceptioneventgroup_exceptonevent_mm',
            'size' => 10,
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
                    'title' => 'Edit', // todo define label: LLL:EXT:.../Resources/Private/Language/locallang_tca.xlf:wizard.edit
                    'icon' => 'EXT:backend/Resources/Public/Images/FormFieldWizard/wizard_edit.gif',
                    'popup_onlyOpenIfSelected' => 1,
                    'JSopenParams' => 'height=350,width=580,status=0,menubar=0,scrollbars=1',
                ],
                'add' => [
                    'module' => [
                        'name' => 'wizard_add',
                    ],
                    'type' => 'script',
                    'title' => 'Create new', // todo define label: LLL:EXT:.../Resources/Private/Language/locallang_tca.xlf:wizard.add
                    'icon' => 'EXT:backend/Resources/Public/Images/FormFieldWizard/wizard_add.gif',
                    'params' => [
                        'table' => 'tx_cal_exception_event',
                        'pid' => '###CURRENT_PID###',
                        'setValue' => 'prepend'
                    ],
                ],
            ],
        ],
        
    ],

];

\TYPO3\CMS\Core\Utility\ExtensionManagementUtility::addTCAcolumns('tx_cal_exception_event_group',$tmp_calendar_columns);

/* inherit and extend the show items from the parent class */

if (isset($GLOBALS['TCA']['tx_cal_exception_event_group']['types']['0']['showitem'])) {
    $GLOBALS['TCA']['tx_cal_exception_event_group']['types']['Tx_Calendar_ExceptionEventGroup']['showitem'] = $GLOBALS['TCA']['tx_cal_exception_event_group']['types']['0']['showitem'];
} elseif(is_array($GLOBALS['TCA']['tx_cal_exception_event_group']['types'])) {
    // use first entry in types array
    $tx_cal_exception_event_group_type_definition = reset($GLOBALS['TCA']['tx_cal_exception_event_group']['types']);
    $GLOBALS['TCA']['tx_cal_exception_event_group']['types']['Tx_Calendar_ExceptionEventGroup']['showitem'] = $tx_cal_exception_event_group_type_definition['showitem'];
} else {
    $GLOBALS['TCA']['tx_cal_exception_event_group']['types']['Tx_Calendar_ExceptionEventGroup']['showitem'] = '';
}
$GLOBALS['TCA']['tx_cal_exception_event_group']['types']['Tx_Calendar_ExceptionEventGroup']['showitem'] .= ',--div--;LLL:EXT:calendar/Resources/Private/Language/locallang_db.xlf:tx_calendar_domain_model_exceptioneventgroup,';
$GLOBALS['TCA']['tx_cal_exception_event_group']['types']['Tx_Calendar_ExceptionEventGroup']['showitem'] .= 'exception_event';

$GLOBALS['TCA']['tx_cal_exception_event_group']['columns'][$GLOBALS['TCA']['tx_cal_exception_event_group']['ctrl']['type']]['config']['items'][] = ['LLL:EXT:calendar/Resources/Private/Language/locallang_db.xlf:tx_cal_exception_event_group.tx_extbase_type.Tx_Calendar_ExceptionEventGroup','Tx_Calendar_ExceptionEventGroup'];

\TYPO3\CMS\Core\Utility\ExtensionManagementUtility::addLLrefForTCAdescr(
    '',
    'EXT:/Resources/Private/Language/locallang_csh_.xlf'
);
