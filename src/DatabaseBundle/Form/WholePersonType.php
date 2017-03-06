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

use DatabaseBundle\Form\FormFactory\DataFormCreation;

class WholePersonType extends AbstractType implements DataFormCreation
{
  public function buildForm(FormBuilderInterface $builder, array $options)
  {
    $builder
      ->add('personalData', PersonalDataType::class)
      ->add('playerData', PlayerDataType::class)
      ->add('coachData', CoachDataType::class)
      ->add('memberData', MemberDataType::class)
//      ->add('parentData', ParentDataType::class)
      ->add('save', 'submit', array('label' => 'Guardar'));
  }
}
?>
