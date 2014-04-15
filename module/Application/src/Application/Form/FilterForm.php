<?php

namespace Application\Form;

use Doctrine\Common\Persistence\ObjectManager;
use DoctrineModule\Persistence\ObjectManagerAwareInterface;
use Zend\Form\Form;
use Zend\Stdlib\InitializableInterface;

class FilterForm extends Form implements ObjectManagerAwareInterface, InitializableInterface
{
    private $om;

    public function __construct($name = null) {
        parent::__construct('filter');
    }

    public function init()
    {
        $this->setAttribute('method', 'get');
        $this->setInputFilter(new FilterInputFilter());
        $this->add(
            [
                'name' => 'department',
                'type' => 'DoctrineModule\Form\Element\ObjectSelect',
                'options' => [
                    'label'              => 'Department',
                    'display_empty_item' => true,
                    'empty_item_label'   => '------',
                    'object_manager'     => $this->getObjectManager(),
                    'target_class'       => 'Application\Entity\Department',
                    'property'           => 'name',
                ],
                'attributes' => [
                    'class' => 'form-control',
                    'id'    => 'department',
                ]
            ]
        );
    }

    /**
     * Set the object manager
     *
     * @param ObjectManager $objectManager
     */
    public function setObjectManager(ObjectManager $objectManager)
    {
        $this->om = $objectManager;
    }

    /**
     * Get the object manager
     *
     * @return ObjectManager
     */
    public function getObjectManager()
    {
        return $this->om;
    }
}