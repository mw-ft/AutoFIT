<?php
namespace Order\Form\Fieldset;

use Zend\Form\Fieldset;
use Zend\InputFilter\InputFilterProviderInterface;

abstract class AbstractSpecificEndpointCdAs400Fieldset extends Fieldset implements InputFilterProviderInterface
{

    public function __construct($name = null, $options = array())
    {
        parent::__construct($name, $options);

        $this->setLabel(_('AS400'));
    }

    public function init()
    {
        $this->add(
            array(
                'type' => 'text',
                'name' => 'username',
                'options' => [
                    'label' => _('username'),
                    'label_attributes' => [
                        'class' => 'col-md-12'
                    ]
                ],
                'attributes' => [
                    'required' => 'required',
                    'class' => 'form-control'
                ]
            ));
    }

    public function getInputFilterSpecification()
    {
        return [
            'username' => [
                'required' => true
            ]
        ];
    }
}