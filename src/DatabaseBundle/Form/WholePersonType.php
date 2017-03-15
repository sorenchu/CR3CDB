<?php
# src/DatabaseBundle/Form/WholePersonType.php

namespace DatabaseBundle\Form;

use DatabaseBundle\Form\PersonalDataType;
use DatabaseBundle\Form\PlayerDataType;
use DatabaseBundle\Form\CoachDataType;
use DatabaseBundle\Form\MemberDataType;
use DatabaseBundle\Form\ParentDataType;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\Form\FormEvent;
use Symfony\Component\Form\FormEvents;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;

class WholePersonType extends AbstractType
{
  public function buildForm(FormBuilderInterface $builder, array $options)
  {
    $builder
      ->add('personalData', PersonalDataType::class)
      ->addEventListener(FormEvents::POST_SET_DATA, function (FormEvent $event) {
          $personalData = $event->getData()->getPersonalData();
          $form = $event->getForm();

          if ($personalData)
          {
            if ($personalData->getIsPlayer())
            {
              $personalData->setIsPlayer(true);
              $form->add('playerData', PlayerDataType::class);
            }
            if ($personalData->getIsCoach())
            {
              $form->add('coachData', CoachDataType::class);
            }
            if ($personalData->getIsMember())
            {
              $form->add('memberData', MemberDataType::class);
            }
            if ($personalData->getIsParent())
            {
              $form->add('parentData', ParentDataType::class);
            }
          } 
      })
      ->add('save', SubmitType::class, array('label' => 'Guardar'));
  }

  public function getBlockPrefix()
  {
    return 'wholePerson';
  }
}
?>
