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

}


