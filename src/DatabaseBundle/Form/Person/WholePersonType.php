<?php
# src/DatabaseBundle/Form/Person/WholePersonType.php

namespace DatabaseBundle\Form\Person;

use DatabaseBundle\Form\Person\PersonalDataType;
use DatabaseBundle\Form\Person\PlayerDataType;
use DatabaseBundle\Form\Person\CoachDataType;
use DatabaseBundle\Form\Person\MemberDataType;
use DatabaseBundle\Form\Person\ParentDataType;

use DatabaseBundle\Entity\WholePerson;

use Symfony\Component\Form\Extension\Core\Type\CollectionType;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

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
          $playerData = $event->getData()->getPlayerData();
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

  public function configureOptions(OptionsResolver $resolver)
  {
    $resolver->setDefaults(array(
              'data_class' => WholePerson::class,
              'current_season' => null,
    ));
  }
}
?>
