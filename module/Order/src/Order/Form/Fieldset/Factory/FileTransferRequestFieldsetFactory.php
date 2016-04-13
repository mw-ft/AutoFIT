<?php
namespace Order\Form\Fieldset\Factory;

use Zend\ServiceManager\FactoryInterface;
use Order\Form\Fieldset\FileTransferRequestCdFieldset;
use Order\Form\Fieldset\FileTransferRequestFtgwFieldset;
use DbSystel\DataObject\FileTransferRequest;
use Zend\ServiceManager\ServiceLocatorInterface;
use DbSystel\DataObject\LogicalConnection;

class FileTransferRequestFieldsetFactory implements FactoryInterface
{

    public function createService(ServiceLocatorInterface $serviceLocator)
    {
        $realServiceLocator = $serviceLocator->getServiceLocator();
        $requestAnalyzer = $realServiceLocator->get('Order\Utility\RequestAnalyzer');
        $isOrderRequest = $requestAnalyzer->isOrderRequest();
        $connectionType = $requestAnalyzer->getConnectionType();

        if (strcasecmp($requestAnalyzer->getConnectionType(), LogicalConnection::TYPE_CD) === 0) {
            $fieldset = new FileTransferRequestCdFieldset();
        } elseif (strcasecmp($requestAnalyzer->getConnectionType(), LogicalConnection::TYPE_FTGW) === 0) {
            $fieldset = new FileTransferRequestFtgwFieldset();
        }

        $hydrator = $serviceLocator->getServiceLocator()
            ->get('HydratorManager')
            ->get('Zend\Hydrator\ClassMethods');
        $fieldset->setHydrator($hydrator);
        $prototype = new FileTransferRequest();
        $fieldset->setObject($prototype);

        return $fieldset;
    }

}
