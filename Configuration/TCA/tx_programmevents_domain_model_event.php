<?php
return [
    'ctrl' => [
        'title'	=> 'LLL:EXT:programmevents/Resources/Private/Language/locallang_db.xlf:tx_programmevents_domain_model_event',
        'label' => 'title',
        'tstamp' => 'tstamp',
        'crdate' => 'crdate',
        'cruser_id' => 'cruser_id',
        'sortby' => 'sorting',
		'versioningWS' => true,
        'languageField' => 'sys_language_uid',
        'transOrigPointerField' => 'l10n_parent',
        'transOrigDiffSourceField' => 'l10n_diffsource',
		'delete' => 'deleted',
		'enablecolumns' => [
            'disabled' => 'hidden',
            'starttime' => 'starttime',
            'endtime' => 'endtime',
        ],
		'searchFields' => 'title,subtitle,id,type,datebegin,timebegin,formatteddate,weekdaybegin,categories,image,location',
        'iconfile' => 'EXT:programmevents/Resources/Public/Icons/tx_programmevents_domain_model_event.gif',
        
       /* 'external' => [
            'connector' => 'feed',
            'parameters' => [
                'uri' => 'http://10.0.0.30/fileadmin/import_events/155.xml'
            ],
            'data' => 'xml',
            'nodetype' => 'event',
            'referenceUid' => 'tx_externalimport_externalid',
            'enforcePid' => true,
            'priority' => 200,
            'disabledOperations' => 'delete',
            'description' => 'Import events from external'
        ]*/
        
        
    ],
    'interface' => [
		'showRecordFieldList' => 'sys_language_uid, l10n_parent, l10n_diffsource, hidden, title, subtitle, id, start_date, end_date, datebegin, timebegin, formatteddate, weekdaybegin, categories, image, picture, location',
    ],
    'types' => [
		'1' => ['showitem' => 'sys_language_uid, l10n_parent, l10n_diffsource, hidden, title, subtitle, image, picture, id, datebegin, timebegin, formatteddate, weekdaybegin, 
		--div--;LLL:EXT:programmevents/Resources/Private/Language/locallang_db.xlf:tx_programmevents_domain_model_event.relations, categories, location, 
		--div--;LLL:EXT:programmevents/Resources/Private/Language/locallang_db.xlf:tx_programmevents_domain_model_event.visibility_dates, start_date, end_date,  --div--;LLL:EXT:frontend/Resources/Private/Language/locallang_ttc.xlf:tabs.access, starttime, endtime'],
    ],
    'columns' => [
		'sys_language_uid' => [
			'exclude' => true,
			'label' => 'LLL:EXT:lang/locallang_general.xlf:LGL.language',
			'config' => [
				'type' => 'select',
				'renderType' => 'selectSingle',
				'special' => 'languages',
				'items' => [
					[
						'LLL:EXT:lang/locallang_general.xlf:LGL.allLanguages',
						-1,
						'flags-multiple'
					]
				],
				'default' => 0,
			],
        ],
        'l10n_parent' => [
            'displayCond' => 'FIELD:sys_language_uid:>:0',
            'exclude' => true,
            'label' => 'LLL:EXT:lang/locallang_general.xlf:LGL.l18n_parent',
            'config' => [
                'type' => 'select',
                'renderType' => 'selectSingle',
                'items' => [
                    ['', 0],
                ],
                'foreign_table' => 'tx_programmevents_domain_model_event',
                'foreign_table_where' => 'AND tx_programmevents_domain_model_event.pid=###CURRENT_PID### AND tx_programmevents_domain_model_event.sys_language_uid IN (-1,0)',
            ],
        ],
        'l10n_diffsource' => [
            'config' => [
                'type' => 'passthrough',
            ],
        ],
		't3ver_label' => [
            'label' => 'LLL:EXT:lang/locallang_general.xlf:LGL.versionLabel',
            'config' => [
                'type' => 'input',
                'size' => 30,
                'max' => 255,
            ],
        ],
		'hidden' => [
            'exclude' => true,
            'label' => 'LLL:EXT:lang/locallang_general.xlf:LGL.hidden',
            'config' => [
                'type' => 'check',
                'items' => [
                    '1' => [
                        '0' => 'LLL:EXT:lang/locallang_core.xlf:labels.enabled'
                    ]
                ],
            ],
        ],
		'starttime' => [
            'exclude' => true,
            'l10n_mode' => 'mergeIfNotBlank',
            'label' => 'LLL:EXT:lang/locallang_general.xlf:LGL.starttime',
            'config' => [
                'type' => 'input',
                'size' => 13,
                'eval' => 'datetime',
                'default' => 0,
            ]
        ],
        'endtime' => [
            'exclude' => true,
            'l10n_mode' => 'mergeIfNotBlank',
            'label' => 'LLL:EXT:lang/locallang_general.xlf:LGL.endtime',
            'config' => [
                'type' => 'input',
                'size' => 13,
                'eval' => 'datetime',
                'default' => 0,
                'range' => [
                    'upper' => mktime(0, 0, 0, 1, 1, 2038)
                ]
            ],
        ],
        'title' => [
	        'exclude' => true,
	        'label' => 'LLL:EXT:programmevents/Resources/Private/Language/locallang_db.xlf:tx_programmevents_domain_model_event.title',
	        'config' => [
			    'type' => 'input',
			    'size' => 30,
			    'eval' => 'trim'
			],
            'external' => [
                0 => [
                    'field' => 'title'
                ]
            ]
	    ],
    	'subtitle' => [
    		'exclude' => true,
    		'label' => 'LLL:EXT:programmevents/Resources/Private/Language/locallang_db.xlf:tx_programmevents_domain_model_event.subtitle',
    		'config' => [
    			'type' => 'input',
    			'size' => 30,
    			'eval' => 'trim'
    		],
    	],
    		'start_date' => [
    				'exclude' => true,
    				'label' => 'LLL:EXT:programmevents/Resources/Private/Language/locallang_db.xlf:tx_programmevents_domain_model_event.start_date',
    				'config' => [
    						'type' => 'input',
    						'size' => 10,
    						'eval' => 'datetime',
    						'default' => time()
    				],
    		],
    		'end_date' => [
    				'exclude' => true,
    				'label' => 'LLL:EXT:programmevents/Resources/Private/Language/locallang_db.xlf:tx_programmevents_domain_model_event.end_date',
    				'config' => [
    						'type' => 'input',
    						'size' => 10,
    						'eval' => 'datetime',
    						'default' => time()
    				],
    		],
    		
    		
	    'id' => [
	        'exclude' => true,
	        'label' => 'LLL:EXT:programmevents/Resources/Private/Language/locallang_db.xlf:tx_programmevents_domain_model_event.id',
	        'config' => [
			    'type' => 'input',
			    'size' => 4,
			    'eval' => 'int'
			],
	        'external' => [
	            0 => [
	                'field' => 'id'
	            ]
	        ]
	    ],
	    'type' => [
	        'exclude' => true,
	        'label' => 'LLL:EXT:programmevents/Resources/Private/Language/locallang_db.xlf:tx_programmevents_domain_model_event.type',
	        'config' => [
			    'type' => 'input',
			    'size' => 30,
			    'eval' => 'trim'
			],
	        'external' => [
	            0 => [
	                'field' => 'type'
	            ]
	        ]
	    ],
        'datebegin' => [
	        'exclude' => true,
	        'label' => 'LLL:EXT:programmevents/Resources/Private/Language/locallang_db.xlf:tx_programmevents_domain_model_event.datebegin',
	        'config' => [
			    'type' => 'input',
			    'size' => 30,
			    'eval' => 'trim'
			],
            'external' => [
                0 => [
                    'field' => 'datebegin'
                ]
            ]
        ],
        'timebegin' => [
	        'exclude' => true,
	        'label' => 'LLL:EXT:programmevents/Resources/Private/Language/locallang_db.xlf:tx_programmevents_domain_model_event.timebegin',
	        'config' => [
			    'type' => 'input',
			    'size' => 30,
			    'eval' => 'trim'
			],
            'external' => [
                0 => [
                    'field' => 'timebegin'
                ]
            ]
        ],
        'formatteddate' => [
	        'exclude' => true,
	        'label' => 'LLL:EXT:programmevents/Resources/Private/Language/locallang_db.xlf:tx_programmevents_domain_model_event.formatteddate',
	        'config' => [
			    'type' => 'input',
			    'size' => 30,
			    'eval' => 'trim'
			],
            'external' => [
                0 => [
                    'field' => 'formatteddate'
                ]
            ]
	    ],
	    'weekdaybegin' => [
	        'exclude' => true,
	        'label' => 'LLL:EXT:programmevents/Resources/Private/Language/locallang_db.xlf:tx_programmevents_domain_model_event.weekdaybegin',
	        'config' => [
			    'type' => 'input',
			    'size' => 30,
			    'eval' => 'trim'
			],
	    ],
	    'categories' => [
	        'exclude' => true,
	        'label' => 'LLL:EXT:programmevents/Resources/Private/Language/locallang_db.xlf:tx_programmevents_domain_model_event.categories',
	        'config' => [
			    'type' => 'input',
			    'size' => 30,
			    'eval' => 'trim'
			],
	        'external' => [
	            0 => [
	                'field' => 'categories'
	            ]
	        ]
	    ],
	    'image' => [
	        'exclude' => true,
	        'label' => 'LLL:EXT:programmevents/Resources/Private/Language/locallang_db.xlf:tx_programmevents_domain_model_event.image',
	        'config' => [
			    'type' => 'input',
			    'size' => 30,
			    'eval' => 'trim'
			],
	    ],
    		'picture' => [
    				'exclude' => true,
    				'label' => 'LLL:EXT:programmevents/Resources/Private/Language/locallang_db.xlf:tx_programmevents_domain_model_event.picture',
    				'config' => \TYPO3\CMS\Core\Utility\ExtensionManagementUtility::getFileFieldTCAConfig(
    						'picture',
    						[
    								'appearance' => [
    										'createNewRelationLinkTitle' => 'LLL:EXT:frontend/Resources/Private/Language/locallang_ttc.xlf:images.addFileReference'
    								],
    								'foreign_types' => [
    										'0' => [
    												'showitem' => '
			                --palette--;LLL:EXT:lang/locallang_tca.xlf:sys_file_reference.imageoverlayPalette;imageoverlayPalette,
			                --palette--;;filePalette'
    										],
    										\TYPO3\CMS\Core\Resource\File::FILETYPE_TEXT => [
    												'showitem' => '
			                --palette--;LLL:EXT:lang/locallang_tca.xlf:sys_file_reference.imageoverlayPalette;imageoverlayPalette,
			                --palette--;;filePalette'
    										],
    										\TYPO3\CMS\Core\Resource\File::FILETYPE_IMAGE => [
    												'showitem' => '
			                --palette--;LLL:EXT:lang/locallang_tca.xlf:sys_file_reference.imageoverlayPalette;imageoverlayPalette,
			                --palette--;;filePalette'
    										],
    										\TYPO3\CMS\Core\Resource\File::FILETYPE_AUDIO => [
    												'showitem' => '
			                --palette--;LLL:EXT:lang/locallang_tca.xlf:sys_file_reference.imageoverlayPalette;imageoverlayPalette,
			                --palette--;;filePalette'
    										],
    										\TYPO3\CMS\Core\Resource\File::FILETYPE_VIDEO => [
    												'showitem' => '
			                --palette--;LLL:EXT:lang/locallang_tca.xlf:sys_file_reference.imageoverlayPalette;imageoverlayPalette,
			                --palette--;;filePalette'
    										],
    										\TYPO3\CMS\Core\Resource\File::FILETYPE_APPLICATION => [
    												'showitem' => '
			                --palette--;LLL:EXT:lang/locallang_tca.xlf:sys_file_reference.imageoverlayPalette;imageoverlayPalette,
			                --palette--;;filePalette'
    										]
    								],
    								'maxitems' => 1
    						],
    						$GLOBALS['TYPO3_CONF_VARS']['GFX']['imagefile_ext']
    						),
    		],
    		
    		
	    'location' => [
	        'exclude' => true,
	        'label' => 'LLL:EXT:programmevents/Resources/Private/Language/locallang_db.xlf:tx_programmevents_domain_model_event.location',
	        'config' => [
			    'type' => 'select',
			    'renderType' => 'selectSingle',
			    'foreign_table' => 'tx_programmevents_domain_model_location',
			    'minitems' => 0,
			    'maxitems' => 1,
			],
	    ],
        
        'categories' => [
            'exclude' => 1,
            'l10n_mode' => 'mergeIfNotBlank',
            'label' => 'LLL:EXT:programmevents/Resources/Private/Language/locallang_db.xlf:tx_programmevents_domain_model_event.categories',
            'config' => [
                'type' => 'select',
                'renderType' => 'selectTree',
                'treeConfig' => [
                    'parentField' => 'parent',
                    'appearance' => [
                        'showHeader' => true,
                        'allowRecursiveMode' => true,
                        'expandAll' => true,
                        'maxLevels' => 99,
                    ],
                ],
                'MM' => 'sys_category_record_mm',
                'MM_match_fields' => [
                    'fieldname' => 'categories',
                    'tablenames' => 'tx_programmevents_domain_model_event',
                ],
                'MM_opposite_field' => 'items',
                'foreign_table' => 'sys_category',
                'foreign_table_where' => ' AND (sys_category.sys_language_uid = 0 OR sys_category.l10n_parent = 0) ORDER BY sys_category.sorting',
                'size' => 10,
                'autoSizeMax' => 40,
                'minitems' => 0,
                'maxitems' => 99,
            ]
        ],
        
        
    ],
];
