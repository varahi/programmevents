<?php
// Add a new column for containing the external id
$tempColumns = [
        'tx_externalimport_externalid' => [
                'exclude' => 0,
                'label' => 'Locations import',
                'config' => [
                        'type' => 'input',
                        'size' => '20'
                ]
        ],
];
\TYPO3\CMS\Core\Utility\ExtensionManagementUtility::addTCAcolumns(
    'tx_programmevents_domain_model_location',
    $tempColumns
);
\TYPO3\CMS\Core\Utility\ExtensionManagementUtility::addToAllTCAtypes(
        'tx_programmevents_domain_model_location',
        'tx_externalimport_externalid'
);

// Add the external information to the ctrl section
$GLOBALS['TCA']['tx_programmevents_domain_model_location']['ctrl']['external'] = [
        0 => [
                'connector' => 'feed',
                'parameters' => [
                    //'uri' => 'http://10.0.0.30/fileadmin/import_events/155.xml'
                    'filename' => 'fileadmin/import_events/events.xml'
                ],
                'data' => 'xml',
                'nodetype' => 'location',
                //'referenceUid' => 'tx_externalimport_externalid',
                'referenceUid' => 'event',
                'enforcePid' => true,
                'priority' => 210,
                'disabledOperations' => 'delete',
                'description' => 'Import location from external'
        ],
];

// Add the external information for each column
$GLOBALS['TCA']['tx_programmevents_domain_model_location']['columns']['name']['external'] = [
    0 => [
        'field' => 'name'
    ]
];
$GLOBALS['TCA']['tx_programmevents_domain_model_location']['columns']['address']['external'] = [
    0 => [
        'field' => 'address'
    ]
];

/*
$GLOBALS['TCA']['tx_programmevents_domain_model_location']['ctrl']['external'] = [
    1 => [
        'field' => 'id',
        'transformations' => [
            10 => [
                'mapping' => [
                    'table' => 'tx_programmevents_domain_model_event',
                    'referenceField' => 'location'
                ]
            ]
        ]
    ]
];
*/