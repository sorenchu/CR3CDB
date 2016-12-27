<?php
# src/DatabaseBundle/Form/Type/PlayerDataType.php

namespace DatabaseBundle\Form\Type;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;

use DatabaseBundle\Form\Type\FormFactory\DataFormCreation;

class PlayerDataType extends AbstractType implements DataFormCreation
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
        ->add('payment', 'money', array(
                                    'required' => false,
                                    'label' => 'Pagos',))
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
    return 'playerData';
  }
}
?>
