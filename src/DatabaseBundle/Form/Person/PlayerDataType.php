<?php
# src/DatabaseBundle/Form/Person/PlayerDataType.php

namespace DatabaseBundle\Form\Person;

use DatabaseBundle\Entity\PlayerData;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\MoneyType;
use DatabaseBundle\Form\Person\PayType;
use DatabaseBundle\Form\Person\DateDataType;

use Doctrine\ORM\EntityRepository;

class PlayerDataType extends AbstractType
{
  public function buildForm(FormBuilderInterface $builder, array $options)
  {
    $this->season = $options['current_season'];
    $builder
        ->add('number', TextType::class, array(
            'label' => 'rugbynumber',
            'required' => false,
          )
        )
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
        ->add('category', ChoiceType::class, array(
            'label' => 'category',
            'choices' => array(
              'senior'  => 'senior',
              'female'=> 'female',
              'u18'  => 'sub18',
              'u16'  => 'sub16',
              'u14'  => 'sub14',
              'u12'  => 'sub12',
              'u10'  => 'sub10',
              'u8'   => 'sub8',
              'u6'   => 'sub6',
              ),
          )
        )
        ->add('parentdata', EntityType::class, array(
            'label' => 'parents',
            'class' => 'DatabaseBundle:ParentData',
            'query_builder' => function (EntityRepository $er) {
                  return $er->createQueryBuilder('parent');
            },
            'required' => false,
            'multiple' => true,
            )
        )
        ->add('datedata', DateDataType::class, array(
                'label' => 'activitytime')
        );
  }
  
  public function getBlockPrefix()
  {
    return 'playerData';
  }

  public function configureOptions(OptionsResolver $resolver)
  {
    $resolver->setDefaults(array(
              'data_class' => PlayerData::class,
              'current_season' => null,
    ));
  }
}
?>
