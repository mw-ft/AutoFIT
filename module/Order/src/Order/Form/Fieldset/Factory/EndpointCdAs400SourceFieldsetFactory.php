<?php
namespace Order\Form\Fieldset\Factory;

use Zend\ServiceManager\ServiceLocatorInterface;
use DbSystel\DataObject\EndpointCdAs400;
use Order\Form\Fieldset\EndpointCdAs400SourceFieldset;

class EndpointCdAs400SourceFieldsetFactory extends AbstractEndpointCdAs400FieldsetFactory
{

    public function createService(ServiceLocatorInterface $serviceLocator)
    {
        $fieldset = new EndpointCdAs400SourceFieldset();
        $hydrator = $serviceLocator->getServiceLocator()
            ->get('HydratorManager')
            ->get('Zend\Hydrator\ClassMethods');
        $fieldset->setHydrator($hydrator);
        $prototype = new EndpointCdAs400();
        $fieldset->setObject($prototype);

        return $fieldset;
    }
}
