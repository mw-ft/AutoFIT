<?php
namespace FileTransferRequest\Form\Fieldset\Factory;

use Zend\ServiceManager\FactoryInterface;
use FileTransferRequest\Form\Fieldset\PhysicalConnectionFtgwFieldset;
use DbSystel\DataObject\PhysicalConnectionFtgw;
use Zend\ServiceManager\ServiceLocatorInterface;

class PhysicalConnectionFtgwFieldsetFactory implements FactoryInterface
{

    public function createService(ServiceLocatorInterface $serviceLocator)
    {
        $fieldset = new PhysicalConnectionFtgwFieldset();
        $hydrator = $serviceLocator->get('HydratorManager')->get('DbSystel\Hydrator\PhysicalConnectionFtgwHydrator');
        $fieldset->setHydrator($hydrator);
        $prototype = new PhysicalConnectionFtgw();
        $fieldset->setObject($prototype);

        return $fieldset;
    }
}
