<?php
namespace Order\Form\Fieldset;

use Zend\Form\Fieldset;

class PhysicalConnectionCdFieldset extends PhysicalConnectionFieldset
{

    public function __construct($name = null, $options = array())
    {
        parent::__construct('physical_connection_cd', $options);
        
        $this->add(array(
            'type' => 'Zend\Form\Element\Checkbox',
            'name' => 'secure_plus',
            'options' => array(
                'label' => _('Secure Plus'),
                'use_hidden_element' => false,
                'checked_value' => '1',
                'unchecked_value' => '0'
            )
        ));
    }

    public function getInputFilterSpecification()
    {
        return [
            'secure_plus' => [
                'required' => false,
                'filters' => [
                    0 => [
                        'name' => 'Zend\Filter\StringTrim',
                        'options' => []
                    ]
                ],
                'validators' => [],
                'description' => _('application code'),
                'allow_empty' => true,
                'continue_if_empty' => true
            ]
        ];
    }
}