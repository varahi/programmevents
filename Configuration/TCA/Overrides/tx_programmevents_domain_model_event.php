<?php
// Add a new column for containing the external id
$tempColumns = [
        'tx_externalimport_externalid' => [
                'exclude' => 0,
                'label' => 'Events import',
                'config' => [
                        'type' => 'input',
                        'size' => '20'
                ]
        ],
];
\TYPO3\CMS\Core\Utility\ExtensionManagementUtility::addTCAcolumns(
        'tx_programmevents_domain_model_event',
        $tempColumns
);
\TYPO3\CMS\Core\Utility\ExtensionManagementUtility::addToAllTCAtypes(
        'tx_programmevents_domain_model_event',
        'tx_externalimport_externalid'
);

// Add the external information to the ctrl section
$GLOBALS['TCA']['tx_programmevents_domain_model_event']['ctrl']['external'] = [
        0 => [
                'connector' => 'feed',
                'parameters' => [
                    'uri' => 'fileadmin/import_events/events.xml'
                    //'filename' => 'fileadmin/import_events/events.xml'
                ],
                'data' => 'xml',
                'nodetype' => 'event',
                'referenceUid' => 'tx_externalimport_externalid',
                'enforcePid' => true,
                'priority' => 200,
                'disabledOperations' => 'delete',
                'description' => 'Import events from external'
        ],
];

// Add the external information for each column
/*
$GLOBALS['TCA']['tx_programmevents_domain_model_event']['columns']['id']['external'] = [
        0 => [
                'field' => 'id'
        ]
];
$GLOBALS['TCA']['tx_programmevents_domain_model_event']['columns']['type']['external'] = [
    0 => [
        'field' => 'type'
    ]
];
$GLOBALS['TCA']['tx_programmevents_domain_model_event']['columns']['datebegin']['external'] = [
    0 => [
        'field' => 'datebegin'
    ]
];
$GLOBALS['TCA']['tx_programmevents_domain_model_event']['columns']['timebegin']['external'] = [
    0 => [
        'field' => 'timebegin'
    ]
];
$GLOBALS['TCA']['tx_programmevents_domain_model_event']['columns']['formatteddate']['external'] = [
    0 => [
        'field' => 'formatteddate'
    ]
];
$GLOBALS['TCA']['tx_programmevents_domain_model_event']['columns']['categories']['external'] = [
    0 => [
        'field' => 'categories'
    ]
];
$GLOBALS['TCA']['tx_programmevents_domain_model_event']['columns']['image_file']['external'] = [
    0 => [
        'field' => 'image[file]'
    ]
];
*/


/*
$GLOBALS['TCA']['tx_news_domain_model_link']['columns']['parent'] = [
    'config' => [
        'type' => 'passthrough',
    ],
    'external' => [
        0 => [
            'field' => 'link',
            'transformations' => [
                10 => [
                    'mapping' => [
                        'table' => 'tx_news_domain_model_news',
                        'referenceField' => 'tx_externalimporttut_externalid'
                    ]
                ]
            ]
        ]
    ]
];
*/

/*
$GLOBALS['TCA']['tx_news_domain_model_news']['columns']['datetime']['external'] = [
        0 => [
                'field' => 'pubDate',
                'transformations' => [
                        10 => [
                                'userFunc' => [
                                        'class' => \Cobweb\ExternalImport\Transformation\DateTimeTransformation::class,
                                        'method' => 'parseDate'
                                ]
                        ]
                ]
        ]
];
*/

/*
$GLOBALS['TCA']['tx_programmevents_domain_model_event']['columns']['teaser']['external'] = [
        0 => [
                'field' => 'description',
                'transformations' => [
                        10 => [
                                'trim' => true
                        ]
                ]
        ]
];
$GLOBALS['TCA']['tx_news_domain_model_news']['columns']['bodytext']['external'] = [
        0 => [
                'field' => 'encoded',
                'transformations' => [
                        10 => [
                                'rteEnabled' => true
                        ]
                ]
        ]
];
$GLOBALS['TCA']['tx_news_domain_model_news']['columns']['type']['external'] = [
        0 => [
                'transformations' => [
                        10 => [
                                'value' => 0
                        ]
                ]
        ]
];
$GLOBALS['TCA']['tx_news_domain_model_news']['columns']['hidden']['external'] = [
        0 => [
                'transformations' => [
                        10 => [
                                'value' => 0
                        ]
                ]
        ]
];
*/