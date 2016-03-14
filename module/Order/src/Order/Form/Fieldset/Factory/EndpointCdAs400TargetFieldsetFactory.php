<?php
namespace Order\Form\Fieldset\Factory;

use Zend\ServiceManager\FactoryInterface;
use Zend\ServiceManager\ServiceLocatorInterface;
use Order\Form\Fieldset\EndpointCdAs400TargetFieldset;
use DbSystel\DataObject\EndpointCdAs400;

class EndpointCdAs400TargetFieldsetFactory implements FactoryInterface
{

    public function createService(ServiceLocatorInterface $serviceLocator)
    {
        $fieldset = new EndpointCdAs400TargetFieldset();
        $hydrator = $serviceLocator->getServiceLocator()->get('HydratorManager')->get('DbSystel\Hydrator\EndpointCdAs400Hydrator');
        $fieldset->setHydrator($hydrator);
        $prototype = new EndpointCdAs400();
        $fieldset->setObject($prototype);

        return $fieldset;
    }
}