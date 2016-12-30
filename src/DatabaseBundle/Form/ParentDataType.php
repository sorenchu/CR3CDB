<?php
# src/DatabaseBundle/Form/ParentDataType.php

namespace DatabaseBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;

use DatabaseBundle\Form\FormFactory\DataFormCreation;

class ParentDataType extends AbstractType implements DataFormCreation
{
  private $children;
  private $parentToChildren;

  public function __construct($children, $parentToChildren)
  {
    $this->children = $children;
    $this->parentToChildren = $parentToChildren;
  }

  public function buildForm(FormBuilderInterface $builder, array $options)
  {
    $builder
        ->add('season', 'choice', array(
            'label' => 'Temporada',
            'choices' => array(
              1 => '2016-2017',
              2 => '2017-2018',
            )
          )
        )
        ->add('playerdata', 'entity', array(
            'label' => 'Hijo',
            'class' => 'DatabaseBundle:PlayerData',
            'choices' => $this->children,
            'required' => true,
            'multiple' => true,
            'expanded' => false,
            'group_by' => 'category',
            'data' => $this->parentToChildren,
            )
        )
        ->add('save', 'submit', array('label' => 'Guardar'));
  }

  public function getName()
  {
    return 'parentData';
  }
}
?>
