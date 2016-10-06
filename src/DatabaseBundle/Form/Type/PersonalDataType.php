<?php
# src/DatabaseBundle/Form/Type/PersonalDataType.php

namespace DatabaseBundle\Form\Type;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;

class PersonalDataType extends AbstractType
{
  public function buildForm(FormBuilderInterface $builder, array $options)
  {
    $builder
        ->add('name', 'text', array('label' => 'Nombre'))
        ->add('surname', 'text', array('label' => 'Apellidos'))
        ->add('nickname', 'text', array(
                                  'required' => false,
                                  'label' => 'Apodo',))
        ->add('email', 'email', array(
                                  'required' => false,
                                  'label' => 'Correo Electrónico',))
        ->add('phone', 'number', array(
                                  'required' => false,
                                  'label' => 'Teléfono',))
        ->add('dni', 'text', array('required' => false,))
        ->add('birthday', 'birthday', array('label' => 'Fecha de Nacimiento'))
        ->add('sex', 'choice', array(
            'label' => 'Género',
            'choices' => array(
              'male' => 'Hombre',
              'female' => 'Mujer',
            )
          )
        )
        ->add('save', 'submit', array('label' => 'Guardar'));
  }

  public function getName()
  {
    return 'personalData';
  }
}
?>


