<?php
# src/DatabaseBundle/Form/Type/ParentDataType.php

namespace DatabaseBundle\Form\Type;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;

use DatabaseBundle\Form\Type\FormFactory\DataFormCreation;

class ParentDataType extends AbstractType implements DataFormCreation
{
  private $children;

  public function __construct($children)
  {
    $this->children = $children;
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
            'required' => false,
            'multiple' => true,
            'expanded' => false,
            'group_by' => 'category',
            // TODO: it needs to get the actual children of the parent
            'preferred_choices' => array(),
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
