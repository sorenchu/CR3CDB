<?php
# src/DatabaseBundle/Form/Person/PersonalDataType.php

namespace DatabaseBundle\Form\Person;

use DatabaseBundle\Entity\PersonalData;
use DatabaseBundle\Form\Person\ContactDataType;
use DatabaseBundle\Form\Person\PlayerPersonType;
use DatabaseBundle\Form\Person\CoachPersonType;

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
        ->add('sex', 'choice', array(
            'label' => 'Género',
            'choices' => array(
              'male' => 'Hombre',
              'female' => 'Mujer',
            )
          )
        )
        ->add('contactData', ContactDataType::class)
        ->add('isParent', CheckboxType::class, array(
            'label' => 'Padre',
            'required' => false,)
        )
        //->add('isMember', CheckboxType::class, array(
        //    'label' => 'Socio',
        //    'required' => false,)
        //)
        ->add('playerPerson', CollectionType::class,
                array('entry_type' => PlayerPersonType::class,
                        'allow_add' => true,
                        'by_reference' => true,)
                )
        ->add('coachPerson', CollectionType::class,
                array('entry_type' => CoachPersonType::class,
                        'allow_add' => true,
                        'by_reference' => true,)
                )
        ->add('memberPerson', CollectionType::class,
                array('entry_type' => MemberPersonType::class,
                        'allow_add' => true,
                        'by_reference' => true,)
                )
        ->addEventListener(FormEvents::POST_SET_DATA,
                           function (FormEvent $event) {
            $personalData = $event->getData();
            $form = $event->getForm();

            if ($personalData)
            {
              $form->add('playerData', CollectionType::class,
                         array('entry_type' => PlayerDataType::class,
                               'allow_add' => true,
                               'by_reference' => false,)
                        );
              $form->add('coachData', CollectionType::class,
                         array('entry_type' => CoachDataType::class,
                               'allow_add' => true,
                               'by_reference' => false,)
                        );
              $form->add('memberData', CollectionType::class,
                         array('entry_type' => MemberDataType::class,
                               'allow_add' => true,
                               'by_reference' => false,)
                        );
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
