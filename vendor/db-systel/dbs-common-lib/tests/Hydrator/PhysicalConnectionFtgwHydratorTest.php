<?php
namespace DbSystel\Hydrator;

use DbSystel\DataObject\PhysicalConnectionFtgw;
use DbSystel\DataObject\LogicalConnection;

/**
 * PhysicalConnectionFtgwHydrator test case.
 */
class PhysicalConnectionFtgwHydratorTest extends AbstractHydratorTest
{

    const CHEXTURE = [
        'id' => 123,
        'logical_connection' => [
            'id' => 567
        ]
    ];

    public function testHydrate()
    {
        $hydratedObject = $this->getHydrator()->hydrate($this->createFixtureArray(), new PhysicalConnectionFtgw());
        
        $this->assertEquals(static::CHEXTURE['logical_connection']['id'], $hydratedObject->getLogicalConnection()
            ->getId());
    }

    protected function createHydrator()
    {
        $serviceManager = \Test\Bootstrap::getServiceManager();
        $hydratorManager = $serviceManager->get('HydratorManager');
        $hydrator = $hydratorManager->get('DbSystel\Hydrator\PhysicalConnectionFtgwHydrator');
        return $hydrator;
    }

    protected function createFixtureObject()
    {
        $physicalConnection = new PhysicalConnectionFtgw();
        $physicalConnection->setId(123);
        $logicalConnection = new LogicalConnection();
        $logicalConnection->setId(567);
        $physicalConnection->setLogicalConnection($logicalConnection);
        return $physicalConnection;
    }
}