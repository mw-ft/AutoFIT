<?php
namespace Order\Form\Fieldset;

use Zend\Form\Fieldset;
use Zend\InputFilter\InputFilterProviderInterface;
use DbSystel\DataObject\AbstractEndpoint;

abstract class AbstractEndpointFtgwProtocolServerFieldset extends AbstractEndpointFieldset implements
    InputFilterProviderInterface
{

    public function __construct($name = null, $options = [])
    {
        parent::__construct($name, $options);

        $this->setLabel(_('ProtocolServer'));
    }

    public function init()
    {
        parent::init();

        $this->add(
            [
                'type' => 'text',
                'name' => 'username',
                'options' => [
                    'label' => _('application user'),
                    'label_attributes' => [
                        'class' => 'col-md-12'
                    ]
                ],
                'attributes' => [
                    'required' => 'required',
                    'class' => 'form-control field-application-user'
                ]
            ]);

        $this->add(
            [
                'type' => 'text',
                'name' => 'folder',
                'options' => [
                    'label' => _('folder'),
                    'label_attributes' => [
                        'class' => 'col-md-12'
                    ]
                ],
                'attributes' => [
                    'class' => 'form-control field-folder'
                ]
            ]);

        $this->add([
            'name' => 'dns_address',
            'type' => 'text',
            'options' => [
                'label' => _('DNS address'),
                'label_attributes' => [
                    'class' => 'col-md-12'
                ]
            ],
            'attributes' => [
                'class' => 'form-control field-dns-address'
            ]
        ]);

        $this->add(
            [
                'type' => 'text',
                'name' => 'ip',
                'options' => [
                    'label' => _('IP'),
                    'label_attributes' => [
                        'class' => 'col-md-12'
                    ]
                ],
                'attributes' => [
                    'class' => 'form-control field-ip'
                ]
            ]);

        $this->add(
            [
                'type' => 'text',
                'name' => 'port',
                'options' => [
                    'label' => _('port'),
                    'label_attributes' => [
                        'class' => 'col-md-12'
                    ]
                ],
                'attributes' => [
                    'class' => 'form-control field-port'
                ]
            ]);

        $this->add(
            [
                'name' => 'protocol_set',
                'type' => 'Order\Form\Fieldset\ProtocolSet',
                'options' => []
            ]);
    }

    public function getInputFilterSpecification()
    {
        $inputFilterSpecification = [];
        return array_merge(parent::getInputFilterSpecification(), $inputFilterSpecification);
    }

    protected function getConcreteType()
    {
        return AbstractEndpoint::TYPE_FTGW_PROTOCOL_SERVER;
    }

}
