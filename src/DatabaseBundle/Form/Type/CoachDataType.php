<?php
# src/DatabaseBundle/Form/Type/CoachDataType.php

namespace DatabaseBundle\Form\Type;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;

class CoachDataType extends AbstractType
{
  public function buildForm(FormBuilderInterface $builder, array $options)
  {
    $builder
        ->add('season', 'choice', array(
            'label' => 'Temporada',
            'choices' => array(
              1 => '2016-2017',
            )
          )
        )
        ->add('salary', 'money', array(
                                    'required' => false,
                                    'label' => 'Sueldo',))
        ->add('category', 'choice', array(
            'label' => 'Categoría',
            'choices' => array(
              'senior' => 'Senior',
              'femenino' => 'Femenino',
              'cadete' => 'Cadete',
              //'infantil' => 'Infantil',
              'alevin' => 'Alevín',
              'benjamin' => 'Benjamín',
              'prebenjamin' => 'Prebenjamín',
              //'jabato' => 'Jabato',
              //'lince' => 'Lince',
              )
            )
          )
          ->add('save', 'submit', array('label' => 'Guardar'));
  }

  public function getName()
  {
    return 'coachData';
  }
}
?>
