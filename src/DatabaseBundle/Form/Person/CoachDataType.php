<?php
# src/DatabaseBundle/Form/Person/CoachDataType.php

namespace DatabaseBundle\Form\Person;

use DatabaseBundle\Entity\CoachData;
use DatabaseBundle\Entity\Season;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\MoneyType;

use Doctrine\ORM\EntityRepository;

class CoachDataType extends AbstractType
{
  public function buildForm(FormBuilderInterface $builder, array $options)
  {
    $this->season = $options['current_season'];
    $builder
        ->add('number', TextType::class, array(
            'label' => 'Número de ficha',
            'required' => false,
            )
        )
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
        ->add('salary', MoneyType::class, array(
                                    'required' => false,
                                    'label' => 'Sueldo',))
        ->add('category', ChoiceType::class, array(
            'label' => 'Categoría',
            'choices' => array(
              'senior' => 'Senior',
              'femenino' => 'Femenino',
              'sub18' => 'Sub-18',
              'sub16' => 'Sub-16',
              'sub14' => 'Sub-14',
              'sub12' => 'Sub-12',
              'sub10' => 'Sub-10',
              'sub8' => 'Sub-8',
              'sub6' => 'Sub-6',
              ),
            'choices_as_values' => true,
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
