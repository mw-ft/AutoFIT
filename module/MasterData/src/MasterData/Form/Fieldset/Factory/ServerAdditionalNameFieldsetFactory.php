<?php
namespace MasterData\Form\Fieldset\Factory;

use Zend\ServiceManager\FactoryInterface;
use MasterData\Form\Fieldset\ServerAdditionalNameFieldset;
use DbSystel\DataObject\Server;
use Zend\ServiceManager\ServiceLocatorInterface;

class ServerAdditionalNameFieldsetFactory implements FactoryInterface
{

    public function createService(ServiceLocatorInterface $serviceLocator)
    {
        $fieldset = new ServerAdditionalNameFieldset(null, []);
        $hydrator = $serviceLocator->getServiceLocator()
            ->get('HydratorManager')
            ->get('Zend\Hydrator\ClassMethods');
        $fieldset->setHydrator($hydrator);
        $prototype = new Server();
        $fieldset->setObject($prototype);

        $dbAdapter = $serviceLocator->getServiceLocator()->get('Zend\Db\Adapter\Adapter');
        $fieldset->setDbAdapter($dbAdapter);

        return $fieldset;
    }

}
