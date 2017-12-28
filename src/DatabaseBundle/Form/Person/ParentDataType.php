<?php
# src/DatabaseBundle/Form/Person/ParentDataType.php

namespace DatabaseBundle\Form\Person;

use DatabaseBundle\Entity\ParentData;
use DatabaseBundle\Entity\PlayerData;
use DatabaseBundle\Entity\Season;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\MoneyType;

use Doctrine\ORM\EntityRepository;

class ParentDataType extends AbstractType
{
  public function buildForm(FormBuilderInterface $builder, array $options)
  {
    $this->season = $options['current_season'];
    $builder
        ->add('season', EntityType::class, array(
            'label' => 'Temporada',
            'class' => Season::class,
            'query_builder' => function (EntityRepository $er) {
                  return $er->createQueryBuilder('season');
          },
          'choices' => $this->season,
          'required' => true,
          'multiple' => false,
          'expanded' => false,
          'disabled' => true,
          'choices_as_values' => true,
          )
        )
        ->add('playerdata', EntityType::class, array(
            'label' => 'Hijo',
            'class' => PlayerData::class,
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
              'current_season' => null,
    ));
  }
}
?>
