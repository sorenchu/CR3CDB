<?php
# src/DatabaseBundle/Form/Person/ParentDataType.php

namespace DatabaseBundle\Form\Person;

use DatabaseBundle\Entity\ParentData;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\Extension\Core\Type\MoneyType;

use Doctrine\ORM\EntityRepository;

class ParentDataType extends AbstractType
{
  public function buildForm(FormBuilderInterface $builder, array $options)
  {
    $this->season = $options['current_season'];
    $builder
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
        ->add('playerdata', EntityType::class, array(
            'label' => 'child',
            'class' => 'DatabaseBundle:PlayerData',
            'query_builder' => function (EntityRepository $er) {
                  return $er->createQueryBuilder('player')
                            ->where('player.category NOT LIKE :senior')
                            ->andWhere('player.category NOT LIKE :femenino')
                            ->setParameter('senior', 'senior')
                            ->setParameter('femenino', 'female');
            },
            'required' => false,
            'multiple' => true,
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
              'current_season' => null,
    ));
  }
}
?>
