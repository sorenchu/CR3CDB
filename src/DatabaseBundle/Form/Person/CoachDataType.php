<?php
# src/DatabaseBundle/Form/Person/CoachDataType.php

namespace DatabaseBundle\Form\Person;

use DatabaseBundle\Entity\CoachData;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\MoneyType;

use Doctrine\ORM\EntityRepository;

class CoachDataType extends AbstractType
{
  public function buildForm(FormBuilderInterface $builder, array $options)
  {
    $this->season = $options['current_season'];
    $builder
        ->add('season', EntityType::class, array(
            'label' => 'Temporada',
            'class' => 'DatabaseBundle:Season',
            'query_builder' => function (EntityRepository $er) {
                  return $er->createQueryBuilder('season');
            },
            'choices' => $this->season,
            'required' => true,
            'multiple' => false,
            'expanded' => false,
            'disabled' => true,
          )
        )
        ->add('salary', MoneyType::class, array(
                                    'required' => false,
                                    'label' => 'Sueldo',))
        ->add('category', ChoiceType::class, array(
            'label' => 'Categoría',
            'choices' => array(
              'senior' => 'Senior',
              'femenino' => 'Femenino',
              'cadete' => 'Cadete',
              //'infantil' => 'Infantil',
              'alevin' => 'Alevín',
              'benjamin' => 'Benjamín',
              'prebenjamin' => 'Prebenjamín',
              //'jabato' => 'Jabato',
              //'lince' => 'Lince',
              )
            )
          );
  }

  public function getBlockPrefix()
  {
    return 'coachData';
  }

  public function configureOptions(OptionsResolver $resolver)
  {
    $resolver->setDefaults(array(
              'data_class' => CoachData::class,
              'current_season' => null,
    ));
  }
}
?>