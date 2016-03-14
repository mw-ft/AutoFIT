<?php
namespace Order\Form\Fieldset;

use Zend\Form\Fieldset;

class EndpointCdTargetFieldset extends EndpointCdFieldset
{
    public function __construct($name = null, $options = array())
    {
        parent::__construct($name, $options);

        $this->setLabel(_('Target - basic settings'));
    }
}