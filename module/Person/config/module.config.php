<?php

namespace Person;

use Zend\ServiceManager\Factory\InvokableFactory;

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
				//Controller\PersonController::class => InvokableFactory::class,
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
        'username' => '',
        'password' => '',
        'hostname' => 'localhost',
    ]
];