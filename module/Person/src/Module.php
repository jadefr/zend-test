<?php

namespace Person;
use Person\Controller\PersonController;
use Person\Model\PersonTable;
use Zend\Db\Adapter\AdapterInterface;
use Zend\Db\ResultSet\ResultSet;
use Zend\ModuleManager\Feature\ConfigProviderInterface;
use Zend\Db\TableGateway\TableGateway;

class Module implements ConfigProviderInterface {

	public function getConfig() {
		return include __DIR__."/../config/module.config.php";
	}

	public function getServiceConfig() {
	    return [
            'factories' => [
                Model\PersonTable::class => function($container) {
	                $tableGateway = $container->get(Model\PersonTableGateway::class);
	                return new PersonTable($tableGateway);
                },
                Model\PersonTableGateway::class => function($container) {
	              $dbAdapter = $container->get(AdapterInterface::class);
	              $resultSetPrototype = new ResultSet();
	              $resultSetPrototype->setArrayObjectPrototype(new Model\Person());
	              return new TableGateway('person', $dbAdapter, null, $resultSetPrototype); // person é o nome da tabela a ser criada no BD; TableGateway é uma classe do zend
                },
            ]
        ];
    }
    public function getControllerConfig() {
	    return [
	        'factories' => [
	            PersonController::class => function($container) {
	                $tableGateway = $container->get(Model\PersonTable::class);
	                return new PersonController($tableGateway);
                },
            ]
        ];
    }

}


