<?php
return [
    'ctrl' => [
        'title'	=> 'LLL:EXT:programmevents/Resources/Private/Language/locallang_db.xlf:tx_programmevents_domain_model_location',
        'label' => 'name',
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
		'searchFields' => 'name,address,city,zipcode,xcoordinate,ycoordinate,portal,event',
        'iconfile' => 'EXT:programmevents/Resources/Public/Icons/tx_programmevents_domain_model_location.gif',
        
       /* 'external' => [
            'connector' => 'feed',
            'parameters' => [
                'uri' => 'http://10.0.0.30/fileadmin/import_events/155.xml'
            ],
            'data' => 'xml',
            'nodetype' => 'location',
            'referenceUid' => 'tx_externalimport_externalid',
            'enforcePid' => true,
            'priority' => 210,
            'disabledOperations' => 'delete',
            'description' => 'Import locations from external'
        ]*/
        
    ],
    'interface' => [
		'showRecordFieldList' => 'sys_language_uid, l10n_parent, l10n_diffsource, hidden, name, address, city, zipcode, xcoordinate, ycoordinate, portal, event',
    ],
    'types' => [
		'1' => ['showitem' => 'sys_language_uid, l10n_parent, l10n_diffsource, hidden, name, address, city, zipcode, xcoordinate, ycoordinate, portal, event, --div--;LLL:EXT:frontend/Resources/Private/Language/locallang_ttc.xlf:tabs.access, starttime, endtime'],
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
                'foreign_table' => 'tx_programmevents_domain_model_location',
                'foreign_table_where' => 'AND tx_programmevents_domain_model_location.pid=###CURRENT_PID### AND tx_programmevents_domain_model_location.sys_language_uid IN (-1,0)',
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
        'name' => [
	        'exclude' => true,
	        'label' => 'LLL:EXT:programmevents/Resources/Private/Language/locallang_db.xlf:tx_programmevents_domain_model_location.name',
	        'config' => [
			    'type' => 'input',
			    'size' => 30,
			    'eval' => 'trim'
			],
            /*'external' => [
                0 => [
                    'field' => 'name'
                ]
            ]*/
	    ],
	    'address' => [
	        'exclude' => true,
	        'label' => 'LLL:EXT:programmevents/Resources/Private/Language/locallang_db.xlf:tx_programmevents_domain_model_location.address',
	        'config' => [
			    'type' => 'text',
			    'cols' => 40,
			    'rows' => 15,
			    'eval' => 'trim'
			],
	        /*'external' => [
	            0 => [
	                'field' => 'address'
	            ]
	        ]*/
	    ],
	    'city' => [
	        'exclude' => true,
	        'label' => 'LLL:EXT:programmevents/Resources/Private/Language/locallang_db.xlf:tx_programmevents_domain_model_location.city',
	        'config' => [
			    'type' => 'input',
			    'size' => 30,
			    'eval' => 'trim'
			],
	        /*'external' => [
	            0 => [
	                'field' => 'city'
	            ]
	        ]*/
	    ],
	    'zipcode' => [
	        'exclude' => true,
	        'label' => 'LLL:EXT:programmevents/Resources/Private/Language/locallang_db.xlf:tx_programmevents_domain_model_location.zipcode',
	        'config' => [
			    'type' => 'input',
			    'size' => 30,
			    'eval' => 'trim'
			],
	       /*
	        	        'external' => [
	            0 => [
	                'field' => 'zipcode'
	            ]
	        ]
	        */ 
	    ],
	    'xcoordinate' => [
	        'exclude' => true,
	        'label' => 'LLL:EXT:programmevents/Resources/Private/Language/locallang_db.xlf:tx_programmevents_domain_model_location.xcoordinate',
	        'config' => [
			    'type' => 'input',
			    'size' => 30,
			    'eval' => 'trim'
			],
	    ],
	    'ycoordinate' => [
	        'exclude' => true,
	        'label' => 'LLL:EXT:programmevents/Resources/Private/Language/locallang_db.xlf:tx_programmevents_domain_model_location.ycoordinate',
	        'config' => [
			    'type' => 'input',
			    'size' => 30,
			    'eval' => 'trim'
			],
	    ],
	    'portal' => [
	        'exclude' => true,
	        'label' => 'LLL:EXT:programmevents/Resources/Private/Language/locallang_db.xlf:tx_programmevents_domain_model_location.portal',
	        'config' => [
			    'type' => 'input',
			    'size' => 30,
			    'eval' => 'trim'
			],
	    ],
	    'event' => [
	        'exclude' => true,
	        'label' => 'LLL:EXT:programmevents/Resources/Private/Language/locallang_db.xlf:tx_programmevents_domain_model_location.event',
	        'config' => [
			    'type' => 'select',
			    'renderType' => 'selectMultipleSideBySide',
			    'foreign_table' => 'tx_programmevents_domain_model_event',
			    'MM' => 'tx_programmevents_location_event_mm',
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
			                'table' => 'tx_programmevents_domain_model_event',
			                'pid' => '###CURRENT_PID###',
			                'setValue' => 'prepend'
			            ],
			        ],
			    ],
			],
	    ],
    ],
];
