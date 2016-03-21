<?php
namespace Order\Form\Fieldset;

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
}