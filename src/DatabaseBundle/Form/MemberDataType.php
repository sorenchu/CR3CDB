<?php
# src/DatabaseBundle/Form/MemberDataType.php

namespace DatabaseBundle\Form;

use DatabaseBundle\Entity\MemberData;
use DatabaseBundle\Form\FormFactory\DataFormCreation;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\Extension\Core\Type\IntegerType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\MoneyType;

use Doctrine\ORM\EntityRepository;

class MemberDataType extends AbstractType implements DataFormCreation
{
  public function buildForm(FormBuilderInterface $builder, array $options)
  {
    $builder
        ->add('memberId', IntegerType::class, array(
            'required' => true,
            'label' => 'Número de socio'))
        ->add('season', EntityType::class, array(
            'label' => 'Temporada',
            'class' => 'DatabaseBundle:Season',
            'query_builder' => function (EntityRepository $er) {
                  return $er->createQueryBuilder('season');
          },
          'required' => true,
          'multiple' => false,
          'expanded' => false,
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