<?php
# src/DatabaseBundle/Form/MemberDataType.php

namespace DatabaseBundle\Form;

use DatabaseBundle\Entity\MemberData;
use DatabaseBundle\Form\FormFactory\DataFormCreation;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

use Symfony\Component\Form\Extension\Core\Type\IntegerType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\MoneyType;

class MemberDataType extends AbstractType implements DataFormCreation
{
  public function buildForm(FormBuilderInterface $builder, array $options)
  {
    $builder
        ->add('memberId', IntegerType::class, array(
            'required' => true,
            'label' => 'Número de socio'))
        ->add('season', ChoiceType::class, array(
            'label' => 'Temporada',
            'choices' => array(
              2016 => '2016-2017',
              2017 => '2017-2018',
            )
          )
        )
        ->add('payment', MoneyType::class, array(
                                    'required' => false,
                                    'label' => 'Pagos',));
  }

  public function getBlockPrefix()
  {
    return 'memberData';
  }

  public function configureOptions(OptionsResolver $resolver)
  {
    $resolver->setDefaults(array(
              'data_class' => MemberData::class,
    ));
  }
}

?>
