<?php

namespace Person;

use Person\Controller\PersonController;
use Person\Controller\PersonControllerFactory;
use Person\Model\PersonTableFactory;

return [
    'router' => [
        'routes' => [
            'person' => [
                'type' => \Zend\Router\Http\Segment::class,
                'options' => [
                    'route' => '/person[/:action[/:id]]',
                    'constraints' => [
                        'action' => '[a-zA-Z][a-zA-Z0-9_-]*',
                        'id' => '[0-9]+',
                    ],
                    'defaults' => [
                        'controller' => Controller\PersonController::class,
                        'action' => 'index',
                    ],
                ],
            ],
        ],
    ],
    'controllers' => [
        'factories' => [
            PersonController::class => PersonControllerFactory::class
        ],
    ],

    'service_manager' => [
        'factories' => [
            Model\PersonTable::class => PersonTableFactory::class
        ],
    ],

	'view_manager' => [
    'template_path_stack' => [
        'person' => __DIR__ . '/../view',
    ],
],

    'db' => [   // https://docs.zendframework.com/zend-db/adapter/
    'driver' => 'Pdo_Mysql',
    'database' => 'teste', //nome do banco de dados
    'username' => 'root',
    'password' => 'root',
    'hostname' => 'localhost',
]
];