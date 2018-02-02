<?php
defined('TYPO3_MODE') || die('Access denied.');

call_user_func(
    function()
    {

        \TYPO3\CMS\Extbase\Utility\ExtensionUtility::registerPlugin(
            'Zwo3.Calendar',
            'Events',
            'Events'
        );

        $pluginSignature = str_replace('_', '', 'calendar') . '_events';
        $GLOBALS['TCA']['tt_content']['types']['list']['subtypes_addlist'][$pluginSignature] = 'pi_flexform';
        \TYPO3\CMS\Core\Utility\ExtensionManagementUtility::addPiFlexFormValue($pluginSignature, 'FILE:EXT:calendar/Configuration/FlexForms/flexform_events.xml');

        \TYPO3\CMS\Extbase\Utility\ExtensionUtility::registerPlugin(
            'Zwo3.Calendar',
            'Test',
            'Test'
        );

        \TYPO3\CMS\Core\Utility\ExtensionManagementUtility::addStaticFile('calendar', 'Configuration/TypoScript', 'calendar');

        \TYPO3\CMS\Core\Utility\ExtensionManagementUtility::makeCategorizable(
            'calendar',
            'tx_cal_event'
        );

        \TYPO3\CMS\Core\Utility\ExtensionManagementUtility::makeCategorizable(
            'calendar',
            'tx_cal_organizer'
        );

        \TYPO3\CMS\Core\Utility\ExtensionManagementUtility::makeCategorizable(
            'calendar',
            'tx_cal_exception_event'
        );

    }
);
