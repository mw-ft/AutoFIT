<?php
namespace FileTransferRequest\Form\Fieldset;

use DbSystel\DataObject\FileTransferRequest;
use Zend\Form\Fieldset;
use Zend\InputFilter\InputFilterProviderInterface;

class PhysicalConnectionFieldset extends Fieldset implements InputFilterProviderInterface
{

    public function __construct($name = null, $options = array())
    {
        parent::__construct($name, $options);

        $this->setLabel(_('Basic settings'));
    }

    public function getInputFilterSpecification()
    {
        return [];
    }
}