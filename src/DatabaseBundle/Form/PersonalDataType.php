<?php
# src/DatabaseBundle/Form/PersonalDataType.php

namespace DatabaseBundle\Form;

use DatabaseBundle\Entity\PersonalData;
use DatabaseBundle\Form\FormFactory\DataFormCreation;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class PersonalDataType extends AbstractType implements DataFormCreation
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
        ->add('isPlayer', 'checkbox', array(
            'label' => 'Jugador',
            'required' => false,)
        )
        ->add('isCoach', 'checkbox', array(
            'label' => 'Entrenador',
            'required' => false,)
        )
        ->add('isParent', 'checkbox', array(
            'label' => 'Padre',
            'required' => false,)
        )
        ->add('isMember', 'checkbox', array(
            'label' => 'Socio',
            'required' => false,)
        );
//        ->add('save', 'submit', array('label' => 'Guardar'));
  }

  public function getName()
  {
    return 'personalData';
  }

  public function configureOptions(OptionsResolver $resolver)
  {
    $resolver->setDefaults(array(
              'data_class' => PersonalData::class,
    ));
  }
}
?>
