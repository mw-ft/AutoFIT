<?php
namespace Order\Form\Fieldset;

use DbSystel\DataObject\AbstractEndpoint;

class EndpointCdTandemTargetFieldset extends AbstractEndpointCdTandemFieldset
{

    public function __construct($name = null, $options = [])
    {
        parent::__construct($name, $options);

        $this->setLabel(_('Target - AS400'));
    }

    public function init()
    {
        parent::init();

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
                    'required' => 'required',
                    'class' => 'form-control'
                ]
            ]);
    }

    public function getInputFilterSpecification()
    {
        return [
            'folder' => [
                'required' => true
            ]
        ];
    }

    protected function getConcreteRole()
    {
        return AbstractEndpoint::ROLE_TARGET;
    }

}
