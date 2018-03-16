<?php

$tmp_category_columns = [		
		'images' => [
				'exclude' => true,
				'l10n_mode' => 'mergeIfNotBlank',
				'label' => 'LLL:EXT:programmevents/Resources/Private/Language/locallang_db.xlf:tx_programmevents_domain_model_category.images',
				'config' => \TYPO3\CMS\Core\Utility\ExtensionManagementUtility::getFileFieldTCAConfig(
						'images',
						[
								'appearance' => [
										'createNewRelationLinkTitle' => 'LLL:EXT:frontend/Resources/Private/Language/locallang_ttc.xlf:images.addFileReference',
										'showPossibleLocalizationRecords' => true,
										'showRemovedLocalizationRecords' => true,
										'showAllLocalizationLink' => true,
										'showSynchronizationLink' => true
								],
								'foreign_match_fields' => [
										'fieldname' => 'images',
										'tablenames' => 'sys_category',
										'table_local' => 'sys_file',
								],
						],
						$GLOBALS['TYPO3_CONF_VARS']['GFX']['imagefile_ext']
						)
		],
	
];

\TYPO3\CMS\Core\Utility\ExtensionManagementUtility::addTCAcolumns('sys_category', $tmp_category_columns);

\TYPO3\CMS\Core\Utility\ExtensionManagementUtility::addToAllTCAtypes('sys_category',
		'--div--;LLL:EXT:frontend/Resources/Private/Language/locallang_tca.xlf:pages.tabs.options, images', '', 'before:description');
\TYPO3\CMS\Core\Utility\ExtensionManagementUtility::addToAllTCAtypes('sys_category', 'single_pid', '',
		'after:description');
\TYPO3\CMS\Core\Utility\ExtensionManagementUtility::addToAllTCAtypes('sys_category', 'shortcut', '',
		'after:single_pid');

//\TYPO3\CMS\Core\Utility\ExtensionManagementUtility::addToAllTCAtypes('sys_category', 'IMagesLLL:EXT:lsscatalog/Resources/Private/Language/locallang_db.xlf:tx_lsscatalog_domain_model_categories.link, images', '', 'after:description');
//\TYPO3\CMS\Core\Utility\ExtensionManagementUtility::addToAllTCAtypes('sys_category', 'LLL:EXT:lsscatalog/Resources/Private/Language/locallang_db.xlf:tx_lsscatalog_domain_model_categories.description, sort', '', 'before:description');
//\TYPO3\CMS\Core\Utility\ExtensionManagementUtility::addToAllTCAtypes('sys_category', '--div--;Brands, brand, link', '', 'after:description');

$GLOBALS['TCA']['sys_category']['columns']['items']['config']['MM_oppositeUsage']['tx_programmevents_domain_model_event']
= array(0 => 'categories');