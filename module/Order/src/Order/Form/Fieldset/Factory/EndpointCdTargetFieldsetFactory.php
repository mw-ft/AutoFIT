<?php
namespace Order\Form\Fieldset\Factory;

use Zend\ServiceManager\FactoryInterface;
use Order\Form\Fieldset\EndpointCdTargetFieldset;
use DbSystel\DataObject\EndpointCdAs400;
use Zend\ServiceManager\ServiceLocatorInterface;

class EndpointCdTargetFieldsetFactory implements FactoryInterface
{

    public function createService(ServiceLocatorInterface $serviceLocator)
    {
        $fieldset = new EndpointCdTargetFieldset();
        $hydrator = $serviceLocator->getServiceLocator()->get('HydratorManager')->get('DbSystel\Hydrator\EndpointCdHydrator');
        $fieldset->setHydrator($hydrator);
        // @todo make it generic!
        $prototype = new EndpointCdAs400();
        $fieldset->setObject($prototype);

        return $fieldset;
    }
}
