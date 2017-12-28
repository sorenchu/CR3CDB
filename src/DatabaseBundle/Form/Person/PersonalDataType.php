<?php
# src/DatabaseBundle/Form/Person/PersonalDataType.php

namespace DatabaseBundle\Form\Person;

use DatabaseBundle\Entity\PersonalData;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\NumberType;
use Symfony\Component\Form\Extension\Core\Type\BirthdayType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\CheckboxType;
use Symfony\Component\Form\Extension\Core\Type\CollectionType;

use Symfony\Component\Form\FormEvent;
use Symfony\Component\Form\FormEvents;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;

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
        ->add('dni', TextType::class, array('required' => false,))
        ->add('birthday', BirthdayType::class, array('label' => 'Fecha de Nacimiento'))
        ->add('sex', ChoiceType::class, array(
            'label' => 'Género',
            'choices' => array(
              'male' => 'Hombre',
              'female' => 'Mujer',
            ),
            'choices_as_values' => true,
          )
        )
        ->add('contactData', ContactDataType::class)
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
        )
        ->addEventListener(FormEvents::POST_SET_DATA,
                           function (FormEvent $event) {
            $personalData = $event->getData();
            $form = $event->getForm();

            if ($personalData)
            {
              if ($personalData->getIsPlayer())
              {
                $form->add('playerData', CollectionType::class,
                           array('entry_type' => PlayerDataType::class,
                                 'allow_add' => true,
                                 'by_reference' => false,)
                          );
              }
              if ($personalData->getIsCoach())
              {
                $form->add('coachData', CollectionType::class,
                           array('entry_type' => CoachDataType::class,
                                 'allow_add' => true,
                                 'by_reference' => false,)
                          );
              }
              if ($personalData->getIsMember())
              {
                $form->add('memberData', CollectionType::class,
                           array('entry_type' => MemberDataType::class,
                                 'allow_add' => true,
                                 'by_reference' => false,)
                          );
              }
              if ($personalData->getIsParent())
              {
                $form->add('parentData', CollectionType::class,
                           array('entry_type' => ParentDataType::class,
                                 'allow_add' => true,
                                 'by_reference' => false,)
                          );
              }
            } 
        })
        ->add('save', SubmitType::class, array(
            'label' => 'Guardar'));
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
