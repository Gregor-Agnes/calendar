<?php

defined('TYPO3_MODE') || die('Access denied.');

call_user_func(function () {

    \TYPO3\CMS\Extbase\Utility\ExtensionUtility::configurePlugin('Zwo3.Calendar', 'Events', [
            'Event' => 'list, show, search',
            'Organizer' => 'list, show, search'
        ], // non-cacheable actions
        [
            'Event' => 'search',
            'Organizer' => 'search'
        ]);

    \TYPO3\CMS\Extbase\Utility\ExtensionUtility::configurePlugin('Zwo3.Calendar', 'Test', [
            'Event' => 'list, show, search',
            'Organizer' => 'list, show, search'
        ], // non-cacheable actions
        [
            'Event' => '',
            'Organizer' => ''
        ]);

    // wizards
    \TYPO3\CMS\Core\Utility\ExtensionManagementUtility::addPageTSConfig('mod {
            wizards.newContentElement.wizardItems.plugins {
                elements {
                    events {
                        icon = ' . \TYPO3\CMS\Core\Utility\ExtensionManagementUtility::extRelPath('calendar') . 'Resources/Public/Icons/user_plugin_events.svg
                        title = LLL:EXT:calendar/Resources/Private/Language/locallang_db.xlf:tx_calendar_domain_model_events
                        description = LLL:EXT:calendar/Resources/Private/Language/locallang_db.xlf:tx_calendar_domain_model_events.description
                        tt_content_defValues {
                            CType = list
                            list_type = calendar_events
                        }
                    }
                    test {
                        icon = ' . \TYPO3\CMS\Core\Utility\ExtensionManagementUtility::extRelPath('calendar') . 'Resources/Public/Icons/user_plugin_test.svg
                        title = LLL:EXT:calendar/Resources/Private/Language/locallang_db.xlf:tx_calendar_domain_model_test
                        description = LLL:EXT:calendar/Resources/Private/Language/locallang_db.xlf:tx_calendar_domain_model_test.description
                        tt_content_defValues {
                            CType = list
                            list_type = calendar_test
                        }
                    }
                }
                show = *
            }
       }');
});

// Hooks for saving / updating events
$GLOBALS ['TYPO3_CONF_VARS']['SC_OPTIONS']['t3lib/class.t3lib_tcemain.php']['processDatamapClass']['cal'] = 'Zwo3\\Calendar\\Hook\\TCEmainHook';
$GLOBALS ['TYPO3_CONF_VARS']['SC_OPTIONS']['t3lib/class.t3lib_tcemain.php']['processCmdmapClass']['cal'] = 'Zwo3\\Calendar\\Hook\\TCEmainHook';

//Scheduler Task for the Recurrence Index

// Add Recurrence Index task
$GLOBALS['TYPO3_CONF_VARS']['SC_OPTIONS']['scheduler']['tasks'][\Zwo3\Calendar\Task\CreateRecurrenceIndex::class] = [
    'extension' => $_EXTKEY,
    'title' => 'Create Recurrence Index for new Calendar',
    'description' => 'Creates the Recurrence Index',
    'additionalFields' => '',
];
