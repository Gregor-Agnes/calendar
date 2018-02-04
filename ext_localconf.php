<?php
defined('TYPO3_MODE') || die('Access denied.');

call_user_func(
    function()
    {

        \TYPO3\CMS\Extbase\Utility\ExtensionUtility::configurePlugin(
            'Zwo3.Calendar',
            'Events',
            [
                'Event' => 'list, show, search',
                'Organizer' => 'list, show, search'
            ],
            // non-cacheable actions
            [
                'Event' => 'search',
                'Organizer' => 'search'
            ]
        );

        \TYPO3\CMS\Extbase\Utility\ExtensionUtility::configurePlugin(
            'Zwo3.Calendar',
            'Test',
            [
                'Event' => 'list, show, search',
                'Organizer' => 'list, show, search'
            ],
            // non-cacheable actions
            [
                'Event' => '',
                'Organizer' => ''
            ]
        );

    // wizards
    \TYPO3\CMS\Core\Utility\ExtensionManagementUtility::addPageTSConfig(
        'mod {
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
       }'
    );
    }
);

