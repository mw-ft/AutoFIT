<?php
namespace DbSystel\Hydrator\Factory;

use Zend\ServiceManager\FactoryInterface;
use Zend\ServiceManager\ServiceLocatorInterface;
use DbSystel\DataObject\LogicalConnection;
use DbSystel\Hydrator\Strategy\Entity\GenericEntityStrategy;
use Zend\Hydrator\NamingStrategy\MapNamingStrategy;

class PhysicalConnectionFtgwHydratorFactory implements FactoryInterface
{

    /**
     * Create service
     *
     * @param ServiceLocatorInterface $serviceLocator            
     *
     * @return mixed
     */
    public function createService(ServiceLocatorInterface $serviceLocator)
    {
        $physicalConnectionFtgwHydrator = $serviceLocator->get('Zend\Hydrator\ClassMethods');
        $logicalConnectionHydrator = $serviceLocator->get('Zend\Hydrator\ClassMethods');

        $physicalConnectionFtgwHydrator->addStrategy('logical_connection', new GenericEntityStrategy($logicalConnectionHydrator, new LogicalConnection()));

        $namingStrategy = new MapNamingStrategy(array(
            'logical_connection' => 'logicalConnection',
        ));
        $physicalConnectionFtgwHydrator->setNamingStrategy($namingStrategy);

        return $physicalConnectionFtgwHydrator;
    }
}