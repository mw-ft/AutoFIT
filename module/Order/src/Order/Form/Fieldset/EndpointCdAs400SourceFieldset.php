<?php
namespace Order\Form\Fieldset;

use DbSystel\DataObject\AbstractEndpoint;
class EndpointCdAs400SourceFieldset extends AbstractEndpointCdAs400Fieldset
{

    public function __construct($name = null, $options = array())
    {
        parent::__construct($name, $options);

        $this->setLabel(_('Source - AS400'));
    }

    public function init()
    {
        parent::init();
    }

    public function getInputFilterSpecification()
    {
        return [];
    }
    
    protected function getConcreteRole()
    {
        return AbstractEndpoint::ROLE_SOURCE;
    }
}
