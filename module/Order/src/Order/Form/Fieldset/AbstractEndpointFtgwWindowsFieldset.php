<?php
namespace Order\Form\Fieldset;

use Zend\Form\Fieldset;
use Zend\InputFilter\InputFilterProviderInterface;
use DbSystel\DataObject\AbstractEndpoint;

abstract class AbstractEndpointFtgwWindowsFieldset extends AbstractEndpointFieldset implements 
    InputFilterProviderInterface
{

    public function __construct($name = null, $options = [])
    {
        parent::__construct($name, $options);
        
        $this->setLabel(_('Windows'));
    }

    public function init()
    {
        parent::init();
        
        $this->add(
            [
                'name' => 'include_parameter_set',
                'type' => 'Order\Form\Fieldset\IncludeParameterSetFieldset',
                'options' => []
            ]);
    }

    public function getInputFilterSpecification()
    {
        return [];
    }

    protected function getConcreteType()
    {
        return AbstractEndpoint::TYPE_FTGW_WINDOWS;
    }

}
