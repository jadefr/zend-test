<?php
namespace Person\Controller;

use Interop\Container\ContainerInterface;
use Person\Model\PersonTable;
use Zend\ServiceManager\Factory\FactoryInterface;

/**
 * Class PersonControllerFactory
 * @package Person\Controller
 */
class PersonControllerFactory implements FactoryInterface
{


    /**
     * Create an object
     *
     * @param ContainerInterface $container
     * @param string $requestedName
     * @param null|array $options
     * @return object
     * @throws ServiceNotFoundException if unable to resolve the service.
     * @throws ServiceNotCreatedException if an exception is raised when
     *     creating a service.
     * @throws ContainerException if any other error occurs
     */
    public function __invoke(ContainerInterface $container, $requestedName, array $options = null)
    {
        $personTable = $container->get(PersonTable::class);
        return new PersonController($personTable);
    }
}