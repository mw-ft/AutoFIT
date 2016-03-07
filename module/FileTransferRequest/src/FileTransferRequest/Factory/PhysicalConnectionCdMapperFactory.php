<?php
namespace FileTransferRequest\Factory;

use FileTransferRequest\Mapper\PhysicalConnectionCdMapper;
use DbSystel\DataObject\PhysicalConnectionCd;
use Zend\ServiceManager\FactoryInterface;
use Zend\ServiceManager\ServiceLocatorInterface;

class PhysicalConnectionCdMapperFactory implements FactoryInterface
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
        return new PhysicalConnectionCdMapper($serviceLocator->get('Zend\Db\Adapter\Adapter'), $serviceLocator->get('HydratorManager')->get('DbSystel\Hydrator\PhysicalConnectionHydrator'), new PhysicalConnectionCd(), $serviceLocator->get('FileTransferRequest\Mapper\PhysicalConnectionMapperInterface'));
    }
}
