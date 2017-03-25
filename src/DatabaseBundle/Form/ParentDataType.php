<?php
# src/DatabaseBundle/Form/ParentDataType.php

namespace DatabaseBundle\Form;

use DatabaseBundle\Entity\ParentData;
use DatabaseBundle\Form\FormFactory\DataFormCreation;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\MoneyType;

use Doctrine\ORM\EntityRepository;

class ParentDataType extends AbstractType implements DataFormCreation
{
  public function buildForm(FormBuilderInterface $builder, array $options)
  {
    $builder
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
        ->add('playerdata', EntityType::class, array(
            'label' => 'Hijo',
            'class' => 'DatabaseBundle:PlayerData',
            'query_builder' => function (EntityRepository $er) {
                  return $er->createQueryBuilder('player')
                            ->where('player.category NOT LIKE :senior')
                            ->andWhere('player.category NOT LIKE :femenino')
                            ->setParameter('senior', 'Senior')
                            ->setParameter('femenino', 'Femenino');
            },
            'required' => true,
            'multiple' => true,
            'expanded' => true,
            'group_by' => 'category',
            )
        );
  }

  public function getBlockPrefix()
  {
    return 'parentData';
  }

  public function configureOptions(OptionsResolver $resolver)
  {
    $resolver->setDefaults(array(
              'data_class' => ParentData::class,
    ));
  }
}
?>
