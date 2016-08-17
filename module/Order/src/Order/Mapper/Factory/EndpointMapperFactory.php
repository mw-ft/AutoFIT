<?php
namespace Order\Mapper\Factory;

use Zend\ServiceManager\FactoryInterface;
use Zend\ServiceManager\ServiceLocatorInterface;
use Order\Mapper\EndpointMapper;

class EndpointMapperFactory implements FactoryInterface
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
        $service = new EndpointMapper($serviceLocator->get('Zend\Db\Adapter\Adapter'),
            $serviceLocator->get('HydratorManager')->get('Zend\Hydrator\ClassMethods'));

        $service->setServerMapper($serviceLocator->get('Order\Mapper\ServerMapper'));
        $service->setExternalServerMapper($serviceLocator->get('Order\Mapper\ExternalServerMapper'));
        $service->setApplicationMapper($serviceLocator->get('Order\Mapper\ApplicationMapper'));
        $service->setCustomerMapper($serviceLocator->get('Order\Mapper\CustomerMapper'));
        $service->setIncludeParameterSetMapper($serviceLocator->get('Order\Mapper\IncludeParameterSetMapper'));
        $service->setAccessConfigSetMapper($serviceLocator->get('Order\Mapper\AccessConfigSetMapper'));
        $service->setProtocolMapper($serviceLocator->get('Order\Mapper\ProtocolMapper'));
        $service->setClusterMapper($serviceLocator->get('Order\Mapper\ClusterMapper'));
        $service->setEndpointClusterConfigMapper($serviceLocator->get('Order\Mapper\EndpointClusterConfigMapper'));
        $service->setArrayProcessor($serviceLocator->get('DbSystel\Utility\ArrayProcessor'));

        return $service;
    }

}
