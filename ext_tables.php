<?php
defined('TYPO3_MODE') || die('Access denied.');


// Flexform
    $pluginSignature = str_replace('_','',$_EXTKEY) . '_' . programmevents;
    $TCA['tt_content']['types']['list']['subtypes_addlist'][$pluginSignature] = 'pi_flexform';
    \TYPO3\CMS\Core\Utility\ExtensionManagementUtility::addPiFlexFormValue($pluginSignature, 'FILE:EXT:' . $_EXTKEY . '/Configuration/FlexForms/flexform_' .programmevents. '.xml');
// Flexform

call_user_func(
    function($extKey)
    {

        \TYPO3\CMS\Extbase\Utility\ExtensionUtility::registerPlugin(
            'T3Dev.Programmevents',
            'Programmevents',
            'Programm Events'
        );

        \TYPO3\CMS\Core\Utility\ExtensionManagementUtility::addStaticFile($extKey, 'Configuration/TypoScript', 'Programm Events');

        \TYPO3\CMS\Core\Utility\ExtensionManagementUtility::addLLrefForTCAdescr('tx_programmevents_domain_model_event', 'EXT:programmevents/Resources/Private/Language/locallang_csh_tx_programmevents_domain_model_event.xlf');
        \TYPO3\CMS\Core\Utility\ExtensionManagementUtility::allowTableOnStandardPages('tx_programmevents_domain_model_event');

        \TYPO3\CMS\Core\Utility\ExtensionManagementUtility::addLLrefForTCAdescr('tx_programmevents_domain_model_location', 'EXT:programmevents/Resources/Private/Language/locallang_csh_tx_programmevents_domain_model_location.xlf');
        \TYPO3\CMS\Core\Utility\ExtensionManagementUtility::allowTableOnStandardPages('tx_programmevents_domain_model_location');

        /*======================= Backend Crons / Hooks ==============================*/
        
        if (TYPO3_MODE === 'BE') {
            // Set Import
            $GLOBALS['TYPO3_CONF_VARS']['SC_OPTIONS']['extbase']['commandControllers'][] = 'T3Dev\Programmevents\Command\ImportCommandController';          
        }
        
    },
    $_EXTKEY
);
