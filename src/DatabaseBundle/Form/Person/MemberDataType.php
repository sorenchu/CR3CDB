<?php
# src/DatabaseBundle/Form/Person/MemberDataType.php

namespace DatabaseBundle\Form\Person;

use DatabaseBundle\Entity\MemberData;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\Extension\Core\Type\IntegerType;
use Symfony\Component\Form\Extension\Core\Type\MoneyType;
use DatabaseBundle\Form\Person\PayType;

use Doctrine\ORM\EntityRepository;

class MemberDataType extends AbstractType
{
  public function buildForm(FormBuilderInterface $builder, array $options)
  {
    $this->season = $options['current_season'];
    $builder
        ->add('memberId', IntegerType::class, array(
            'required' => false,
            'label' => 'membernumber'))
        ->add('season', EntityType::class, array(
            'label' => 'season',
            'class' => 'DatabaseBundle:Season',
            'query_builder' => function (EntityRepository $er) {
                  return $er->createQueryBuilder('season');
            },
            'choices' => $this->season,
            'required' => false,
            'multiple' => false,
            'expanded' => false,
            'disabled' => true,
          )
        )
        ->add('pay', PayType::class, array(
            'label' => 'payments',))
        ->add('datedata', DateDataType::class, array(
                'label' => 'activitytime')
        );
  }

  public function getBlockPrefix()
  {
    return 'memberData';
  }

  public function configureOptions(OptionsResolver $resolver)
  {
    $resolver->setDefaults(array(
              'data_class' => MemberData::class,
              'current_season' => null,
    ));
  }
}

?>
