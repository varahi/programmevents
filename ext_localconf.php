<?php
defined('TYPO3_MODE') || die('Access denied.');

call_user_func(
    function($extKey)
	{

        \TYPO3\CMS\Extbase\Utility\ExtensionUtility::configurePlugin(
            'T3Dev.Programmevents',
            'Programmevents',
            [
                'Event' => 'list, show, new, create, edit, update, delete',
                'Categories' => 'list, show',
                'Location' => 'list, show'
            ],
            // non-cacheable actions
            [
                'Event' => 'create, update, delete',
                'Categories' => '',
                'Location' => ''
            ]
        );

	// wizards
	\TYPO3\CMS\Core\Utility\ExtensionManagementUtility::addPageTSConfig(
		'mod {
			wizards.newContentElement.wizardItems.plugins {
				elements {
					programmevents {
						icon = ' . \TYPO3\CMS\Core\Utility\ExtensionManagementUtility::extRelPath($extKey) . 'Resources/Public/Icons/user_plugin_programmevents.svg
						title = LLL:EXT:programmevents/Resources/Private/Language/locallang_db.xlf:tx_programmevents_domain_model_programmevents
						description = LLL:EXT:programmevents/Resources/Private/Language/locallang_db.xlf:tx_programmevents_domain_model_programmevents.description
						tt_content_defValues {
							CType = list
							list_type = programmevents_programmevents
						}
					}
				}
				show = *
			}
	   }'
	);
    },
    $_EXTKEY
);
