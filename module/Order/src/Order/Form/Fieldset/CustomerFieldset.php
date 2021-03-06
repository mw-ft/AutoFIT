<?php
namespace Order\Form\Fieldset;

use Zend\Form\Fieldset;
use Zend\InputFilter\InputFilterProviderInterface;

class CustomerFieldset extends Fieldset implements InputFilterProviderInterface
{

    public function __construct($name = null, $options = [])
    {
        parent::__construct('customer', $options);
    }

    public function init()
    {
        $this->add(
            [
                'type' => 'text',
                'name' => 'name',
                'options' => [
                    'label' => _('firm'),
                    'label_attributes' => [
                        'class' => 'col-md-12'
                    ]
                ],
                'attributes' => [
                    'class' => 'form-control field-customer-name'
                ]
            ]);
    }

    public function getInputFilterSpecification()
    {
        return [];
    }

}
