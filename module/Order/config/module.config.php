<?php
return [
    'router' => [
        'routes' => [
            'start-order' => [
                'type' => 'Zend\Mvc\Router\Http\Segment',
                'options' => [
                    'route' => '/order/process/start-order[/:connectionType]',
                    'defaults' => [
                        'controller' => 'Order\Controller\Process',
                        'action' => 'start',
                        'connectionType' => ''
                    ]
                ]
            ],
            'create-order' => [
                'type' => 'Zend\Mvc\Router\Http\Segment',
                'options' => [
                    'route' => '/order/process/create/:connectionType/:endpointSourceType/:endpointTargetType',
                    'defaults' => [
                        'controller' => 'Order\Controller\Process',
                        'action' => 'create',
                        'connectionType' => '',
                        'endpointSourceType' => '',
                        'endpointTargetType' => ''
                    ]
                ]
            ],
            'edit-order' => [
                'type' => 'Zend\Mvc\Router\Http\Segment',
                'options' => [
                    'route' => '/order/process/edit/:id',
                    'defaults' => [
                        'controller' => 'Order\Controller\Process',
                        'action' => 'edit',
                        'id' => ''
                    ]
                ]
            ],
            'cancel-order' => [
                'type' => 'Zend\Mvc\Router\Http\Segment',
                'options' => [
                    'route' => '/order/process/cancel/:id',
                    'defaults' => [
                        'controller' => 'Order\Controller\Process',
                        'action' => 'cancel',
                        'id' => ''
                    ]
                ]
            ],
            'accept-order' => [
                'type' => 'Zend\Mvc\Router\Http\Segment',
                'options' => [
                    'route' => '/order/process/accept/:id',
                    'defaults' => [
                        'controller' => 'Order\Controller\Process',
                        'action' => 'accept',
                        'id' => ''
                    ]
                ]
            ],
            'decline-order' => [
                'type' => 'Zend\Mvc\Router\Http\Segment',
                'options' => [
                    'route' => '/order/process/decline/:id',
                    'defaults' => [
                        'controller' => 'Order\Controller\Process',
                        'action' => 'decline',
                        'id' => ''
                    ]
                ]
            ],
            'start-checking-order' => [
                'type' => 'Zend\Mvc\Router\Http\Segment',
                'options' => [
                    'route' => '/order/process/start-checking/:id',
                    'defaults' => [
                        'controller' => 'Order\Controller\Process',
                        'action' => 'startChecking',
                        'id' => ''
                    ]
                ]
            ],
            'complete-order' => [
                'type' => 'Zend\Mvc\Router\Http\Segment',
                'options' => [
                    'route' => '/order/process/complete/:id',
                    'defaults' => [
                        'controller' => 'Order\Controller\Process',
                        'action' => 'complete',
                        'id' => ''
                    ]
                ]
            ],
            'show-order' => [
                'type' => 'Zend\Mvc\Router\Http\Segment',
                'options' => [
                    'route' => '/show-order/:id',
                    'defaults' => [
                        'controller' => 'Order\Controller\Process',
                        'action' => 'showOrder',
                        'id' => ''
                    ]
                ]
            ],
            'export-order' => [
                'type' => 'Zend\Mvc\Router\Http\Segment',
                'options' => [
                    'route' => '/export-order/:id',
                    'defaults' => [
                        'controller' => 'Order\Controller\Process',
                        'action' => 'exportOrder',
                        'id' => ''
                    ]
                ]
            ],
            'sync-in-progress' => [
                'type' => 'Zend\Mvc\Router\Http\Segment',
                'options' => [
                    'route' => '/order/process/sync-in-progress',
                    'defaults' => [
                        'controller' => 'Order\Controller\Process',
                        'action' => 'syncInProgress',
                    ]
                ]
            ],
            'operation-denied-for-status' => [
                'type' => 'Zend\Mvc\Router\Http\Segment',
                'options' => [
                    'route' => '/order/process/operation-denied-for-status[/:operation][/:status]',
                    'defaults' => [
                        'controller' => 'Order\Controller\Process',
                        'action' => 'operationDeniedForStatus',
                    ]
                ]
            ],
            'list-my-orders' => [
                'type' => 'Zend\Mvc\Router\Http\Segment',
                'options' => [
                    'route' => '/list-my-orders[/page/:page]',
                    'defaults' => [
                        'controller' => 'Order\Controller\Process',
                        'action' => 'listMyOrders',
                        'page' => 1
                    ]
                ]
            ],
            'list-orders' => [
                'type' => 'Zend\Mvc\Router\Http\Segment',
                'options' => [
                    'route' => '/list-orders[/page/:page]',
                    'defaults' => [
                        'controller' => 'Order\Controller\Process',
                        'action' => 'listOrders',
                        'page' => 1
                    ]
                ]
            ],
            'provide-applications' => [
                'type' => 'Zend\Mvc\Router\Http\Literal',
                'options' => [
                    'route' => '/order/ajax/provide-applications',
                    'defaults' => [
                        'controller' => 'Order\Controller\Ajax',
                        'action' => 'provideApplications'
                    ]
                ]
            ],
            'provide-service-invoice-positions-basic' => [
                'type' => 'Zend\Mvc\Router\Http\Literal',
                'options' => [
                    'route' => '/order/ajax/provide-service-invoice-positions-basic',
                    'defaults' => [
                        'controller' => 'Order\Controller\Ajax',
                        'action' => 'provideServiceInvoicePositionsBasic'
                    ]
                ]
            ],
            'provide-service-invoice-positions-personal' => [
                'type' => 'Zend\Mvc\Router\Http\Literal',
                'options' => [
                    'route' => '/order/ajax/provide-service-invoice-positions-personal',
                    'defaults' => [
                        'controller' => 'Order\Controller\Ajax',
                        'action' => 'provideServiceInvoicePositionsPersonal'
                    ]
                ]
            ],
            'provide-environments' => [
                'type' => 'Zend\Mvc\Router\Http\Literal',
                'options' => [
                    'route' => '/order/ajax/provide-environments',
                    'defaults' => [
                        'controller' => 'Order\Controller\Ajax',
                        'action' => 'provideEnvironments'
                    ]
                ]
            ],
            'provide-servers' => [
                'type' => 'Zend\Mvc\Router\Http\Literal',
                'options' => [
                    'route' => '/order/ajax/provide-servers',
                    'defaults' => [
                        'controller' => 'Order\Controller\Ajax',
                        'action' => 'provideServers'
                    ]
                ]
            ],
            'provide-service-invoice-positions' => [
                'type' => 'Zend\Mvc\Router\Http\Literal',
                'options' => [
                    'route' => '/order/ajax/provide-service-invoice-positions',
                    'defaults' => [
                        'controller' => 'Order\Controller\Ajax',
                        'action' => 'provideServiceInvoicePositions'
                    ]
                ]
            ],
            'provide-clusters' => [
                'type' => 'Zend\Mvc\Router\Http\Literal',
                'options' => [
                    'route' => '/order/ajax/provide-clusters',
                    'defaults' => [
                        'controller' => 'Order\Controller\Ajax',
                        'action' => 'provideclusters'
                    ]
                ]
            ]
        ]
    ],
    'controllers' => [
        'invokables' => [],
        'factories' => [
            'Order\Controller\Process' => 'Order\Controller\Factory\ProcessControllerFactory',
            'Order\Controller\Ajax' => 'Order\Controller\Factory\AjaxControllerFactory'
        ]
    ],
    'controller_plugins' => [
        'factories' => [
            'IdentityParam' => 'Order\Mvc\Controller\Plugin\Factory\IdentityParamFactory',
            'IsInSync' => 'Order\Mvc\Controller\Plugin\Factory\IsInSyncFactory',
            'OrderStatusChecker' => 'Order\Mvc\Controller\Plugin\Factory\OrderStatusCheckerFactory',
        ]
    ],
    'service_manager' => [
        'factories' => [
            // services
            // mappers
            'Order\Mapper\EndpointMapper' => 'Order\Mapper\Factory\EndpointMapperFactory',
            'Order\Mapper\ClusterMapper' => 'Order\Mapper\Factory\ClusterMapperFactory',
            'Order\Mapper\EndpointClusterConfigMapper' => 'Order\Mapper\Factory\EndpointClusterConfigMapperFactory',
            'Order\Mapper\EndpointServerConfigMapper' => 'Order\Mapper\Factory\EndpointServerConfigMapperFactory',
            'Order\Mapper\FileParameterSetMapper' => 'Order\Mapper\Factory\FileParameterSetMapperFactory',
            'Order\Mapper\IncludeParameterSetMapper' => 'Order\Mapper\Factory\IncludeParameterSetMapperFactory',
            'Order\Mapper\ProtocolSetMapper' => 'Order\Mapper\Factory\ProtocolSetMapperFactory',
            'Order\Mapper\AccessConfigSetMapper' => 'Order\Mapper\Factory\AccessConfigSetMapperFactory',
            'Order\Mapper\FileTransferRequestMapper' => 'Order\Mapper\Factory\FileTransferRequestMapperFactory',
            'Order\Mapper\LogicalConnectionMapper' => 'Order\Mapper\Factory\LogicalConnectionMapperFactory',
            'Order\Mapper\PhysicalConnectionMapper' => 'Order\Mapper\Factory\PhysicalConnectionMapperFactory',
            'Order\Mapper\ServiceInvoiceMapper' => 'Order\Mapper\Factory\ServiceInvoiceMapperFactory',
            'Order\Mapper\ServiceInvoicePositionMapper' => 'Order\Mapper\Factory\ServiceInvoicePositionMapperFactory',
            // data preparators
            // adapters
            'Zend\Db\Adapter\Adapter' => 'Zend\Db\Adapter\AdapterServiceFactory',
            // utitlities
            'Order\Utility\ProperServiceNameDetector' => 'Order\Utility\Factory\ProperServiceNameDetectorFactory',
            'Order\Utility\RequestAnalyzer' => 'Order\Utility\Factory\RequestAnalyzerFactory',
            // DataObjects
            'DbSystel\DataObject\FileTransferRequest' => 'Order\DataObject\Factory\FileTransferRequestFactory'
        ],
        'invokables' => [
            // database request modifiers
            'Order\Mapper\RequestModifier\FileTransferRequestRequestModifier' => 'Order\Mapper\RequestModifier\FileTransferRequestRequestModifier',
            // utilities
            'DbSystel\Utility\StringUtility' => 'DbSystel\Utility\StringUtility',
            'DbSystel\Utility\ArrayProcessor' => 'DbSystel\Utility\ArrayProcessor',
            'DbSystel\Utility\TableDataProcessor' => 'DbSystel\Utility\TableDataProcessor',
            'DbSystel\DataExport\DataExporter' => 'DbSystel\DataExport\DataExporter'
        ],
        'abstract_factories' => [
            // mappers
            'Order\Mapper\Factory\AbstractMapperFactory',
            // services
            'Order\Service\Factory\AbstractServiceFactory'
        ]
    ],
    'form_elements' => [
        'factories' => [
            // forms
            'Order\Form\OrderForm' => 'Order\Form\Factory\OrderFormFactory',
            // fieldsets
            'Order\Form\Fieldset\Cluster' => 'Order\Form\Fieldset\Factory\ClusterFieldsetFactory',
            'Order\Form\Fieldset\ClusterCreate' => 'Order\Form\Fieldset\Factory\ClusterCreateFieldsetFactory',
            'Order\Form\Fieldset\FileTransferRequestCd' => 'Order\Form\Fieldset\Factory\FileTransferRequestFieldsetFactory',
            'Order\Form\Fieldset\FileTransferRequestFtgw' => 'Order\Form\Fieldset\Factory\FileTransferRequestFieldsetFactory',
            'Order\Form\Fieldset\LogicalConnectionCd' => 'Order\Form\Fieldset\Factory\LogicalConnectionFieldsetFactory',
            'Order\Form\Fieldset\LogicalConnectionFtgw' => 'Order\Form\Fieldset\Factory\LogicalConnectionFieldsetFactory',
            'Order\Form\Fieldset\ServerCommon' => 'Order\Form\Fieldset\Factory\ServerCommonFieldsetFactory',
            'Order\Form\Fieldset\ServerListItem' => 'Order\Form\Fieldset\Factory\ServerListItemFieldsetFactory',
            'Order\Form\Fieldset\User' => 'Order\Form\Fieldset\Factory\UserFieldsetFactory'
        ],
        'abstract_factories' => [
            // fieldsets
            'Order\Form\Fieldset\Factory\AbstractCommonFieldsetFactory',
            'Order\Form\Fieldset\Factory\AbstractEndpointFieldsetFactory',
            'Order\Form\Fieldset\Factory\AbstractPhysicalConnectionFieldsetFactory',
            'Order\Form\Fieldset\Factory\AbstractServiceInvoicePositionFieldsetFactory'
        ],
        'shared' => [
            'Order\Form\Fieldset\AccessConfig' => false,
            'Order\Form\Fieldset\AccessConfigSet' => false,
            'Order\Form\Fieldset\Application' => false,
            'Order\Form\Fieldset\Cluster' => false,
            'Order\Form\Fieldset\Customer' => false,
            'Order\Form\Fieldset\EndpointCdAs400Source' => false,
            'Order\Form\Fieldset\EndpointCdAs400Target' => false,
            'Order\Form\Fieldset\EndpointCdLinuxUnixSource' => false,
            'Order\Form\Fieldset\EndpointCdLinuxUnixTarget' => false,
            'Order\Form\Fieldset\EndpointCdTandemSource' => false,
            'Order\Form\Fieldset\EndpointCdTandemTarget' => false,
            'Order\Form\Fieldset\EndpointCdWindowsSource' => false,
            'Order\Form\Fieldset\EndpointCdWindowsTarget' => false,
            'Order\Form\Fieldset\EndpointCdWindowsShareSource' => false,
            'Order\Form\Fieldset\EndpointCdWindowsShareTarget' => false,
            'Order\Form\Fieldset\EndpointCdZosSource' => false,
            'Order\Form\Fieldset\EndpointCdZosTarget' => false,
            'Order\Form\Fieldset\EndpointCdWindowsSource' => false,
            'Order\Form\Fieldset\EndpointCdWindowsTarget' => false,
            'Order\Form\Fieldset\EndpointClusterConfig' => false,
            'Order\Form\Fieldset\EndpointFtgwProtocolServerSource' => false,
            'Order\Form\Fieldset\EndpointFtgwProtocolServerTarget' => false,
            'Order\Form\Fieldset\EndpointFtgwSelfServiceSource' => false,
            'Order\Form\Fieldset\EndpointFtgwSelfServiceTarget' => false,
            'Order\Form\Fieldset\EndpointFtgwWindowsSource' => false,
            'Order\Form\Fieldset\EndpointFtgwWindowsTarget' => false,
            'Order\Form\Fieldset\EndpointFtgwWindowsShareSource' => false,
            'Order\Form\Fieldset\EndpointFtgwWindowsShareTarget' => false,
            'Order\Form\Fieldset\EndpointFtgwLinuxUnixSource' => false,
            'Order\Form\Fieldset\EndpointFtgwLinuxUnixTarget' => false,
            'Order\Form\Fieldset\EndpointFtgwCdZosSource' => false,
            'Order\Form\Fieldset\EndpointFtgwCdZosTarget' => false,
            'Order\Form\Fieldset\EndpointFtgwCdTandemSource' => false,
            'Order\Form\Fieldset\EndpointFtgwCdTandemTarget' => false,
            'Order\Form\Fieldset\EndpointFtgwCdAs400Source' => false,
            'Order\Form\Fieldset\EndpointFtgwCdAs400Target' => false,
            'Order\Form\Fieldset\EndpointServerConfig' => false,
            'Order\Form\Fieldset\Environment' => false,
            'Order\Form\Fieldset\ExternalServer' => false,
            'Order\Form\Fieldset\FileTransferRequestCd' => false,
            'Order\Form\Fieldset\FileTransferRequestFtgw' => false,
            'Order\Form\Fieldset\IncludeParameter' => false,
            'Order\Form\Fieldset\IncludeParameterSet' => false,
            'Order\Form\Fieldset\ProtocolSet' => false,
            'Order\Form\Fieldset\LogicalConnectionCd' => false,
            'Order\Form\Fieldset\LogicalConnectionFtgw' => false,
            'Order\Form\Fieldset\Notification' => false,
            'Order\Form\Fieldset\PhysicalConnectionCdEndToEnd' => false,
            'Order\Form\Fieldset\PhysicalConnectionFtgwEndToMiddle' => false,
            'Order\Form\Fieldset\PhysicalConnectionFtgwMiddleToEnd' => false,
            'Order\Form\Fieldset\ServerCommon' => false,
            'Order\Form\Fieldset\ServerListItem' => false,
            'Order\Form\Fieldset\ServiceInvoicePositionBasic' => false,
            'Order\Form\Fieldset\ServiceInvoicePositionPersonal' => false,
            'Order\Form\Fieldset\User' => false,
        ]
    ],
    'view_manager' => [
        'template_path_stack' => [
            __DIR__ . '/../view'
        ],
        'strategies' => [
            'ViewJsonStrategy'
        ],
        'template_map' => [
            'pagination' => __DIR__ . '/../view/partials/pagination.phtml',
        ]
    ],
    'view_helpers' => [
        'invokables' => [
            'formelementerrors' => 'DbSystel\Form\View\Helper\FormElementErrors'
        ],
        'factories' => [
            'OrderStatusChecker' => 'Order\View\Helper\Factory\OrderStatusCheckerFactory',
        ]
    ],
    'hydrators' => [
        'factories' => [
            'DbSystel\Hydrator\ProtocolSetHydrator' => 'DbSystel\Hydrator\Factory\ProtocolSetHydratorFactory',
            'DbSystel\Hydrator\ProtocolHydrator' => 'DbSystel\Hydrator\Factory\ProtocolHydratorFactory'
        ]
    ]
];
