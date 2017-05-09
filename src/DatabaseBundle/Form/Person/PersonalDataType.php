<?php
# src/DatabaseBundle/Form/Person/PersonalDataType.php

namespace DatabaseBundle\Form\Person;

use DatabaseBundle\Entity\PersonalData;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\EmailType;
use Symfony\Component\Form\Extension\Core\Type\NumberType;
use Symfony\Component\Form\Extension\Core\Type\BirthdayType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\CheckboxType;

class PersonalDataType extends AbstractType
{
  public function buildForm(FormBuilderInterface $builder, array $options)
  {
    $builder
        ->add('name', TextType::class, array('label' => 'Nombre'))
        ->add('surname', TextType::class, array('label' => 'Apellidos'))
        ->add('nickname', TextType::class, array(
                                  'required' => false,
                                  'label' => 'Apodo',))
        ->add('email', EmailType::class, array(
                                  'required' => false,
                                  'label' => 'Correo Electrónico',))
        ->add('phone', NumberType::class, array(
                                  'required' => false,
                                  'label' => 'Teléfono',))
        ->add('dni', TextType::class, array('required' => false,))
        ->add('birthday', BirthdayType::class, array('label' => 'Fecha de Nacimiento'))
        ->add('sex', 'choice', array(
            'label' => 'Género',
            'choices' => array(
              'male' => 'Hombre',
              'female' => 'Mujer',
            )
          )
        )
        ->add('isPlayer', CheckboxType::class, array(
            'label' => 'Jugador',
            'required' => false,)
        )
        ->add('isCoach', CheckboxType::class, array(
            'label' => 'Entrenador',
            'required' => false,)
        )
        ->add('isParent', CheckboxType::class, array(
            'label' => 'Padre',
            'required' => false,)
        )
        ->add('isMember', CheckboxType::class, array(
            'label' => 'Socio',
            'required' => false,)
        );
  }

  public function getBlockPrefix()
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
