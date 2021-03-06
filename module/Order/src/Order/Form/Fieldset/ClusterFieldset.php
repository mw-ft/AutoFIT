<?php
namespace Order\Form\Fieldset;

use Zend\Form\Fieldset;

class ClusterFieldset extends AbstractClusterFieldset
{

    public function __construct($name = null, $options = [])
    {
        parent::__construct('cluster', $options);
    }

    public function init()
    {
        $this->add([
            'name' => 'id',
            'type' => 'hidden',
            'attributes' => [
                'class' => 'field-cluster-id'
            ]
        ]);

        $this->add([
            'name' => 'virtual_node_name',
            'type' => 'text',
            'options' => [
                'label' => _('cluster\'s virtual node name'),
                'label_attributes' => [
                    'class' => 'col-md-12'
                ]
            ],
            'attributes' => [
                'class' => 'form-control field-cluster-virtual-node-name'
            ]
        ]);
    }

    public function getInputFilterSpecification()
    {
        return [
            'virtual_node_name' => [
                'required' => false,
                'validators' => [
                    [
                        'name' => 'Zend\Validator\Db\RecordExists',
                        'options' => [
                            'table' => 'cluster',
                            'field' => 'virtual_node_name',
                            'adapter' => $this->dbAdapter
                        ]
                    ]
                ]
            ]
        ];
    }

}
