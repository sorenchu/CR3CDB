<?php
# src/DatabaseBundle/Form/Type/ParentDataType.php

namespace DatabaseBundle\Form\Type;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;

class ParentDataType extends AbstractType
{
  public function buildForm(FormBuilderInterface $builder, array $options)
  {
    $builder
        ->add('season', 'choice', array(
            'label' => 'Temporada',
            'choices' => array(
              2016 => '2016-2017',
            )
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
