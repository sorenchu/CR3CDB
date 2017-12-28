<?php
# src/DatabaseBundle/Form/Season/SeasonType.php

namespace DatabaseBundle\Form\Season;

use DatabaseBundle\Entity\Season;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Doctrine\ORM\EntityRepository;

use Symfony\Component\Form\FormEvent;
use Symfony\Component\Form\FormEvents;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;

class SeasonType extends AbstractType 
{
  public function buildForm(FormBuilderInterface $builder, array $options)
  {
    $this->season = $options['current_season'];
    $builder
        ->add('season', EntityType::class, array(
            'label' => 'Temporada',
            'class' => Season::class,
            'query_builder' => function (EntityRepository $er) {
              return $er->createQueryBuilder(Season::class);
            },
            'choices' => $this->season,
            'required' => true,
            'multiple' => false,
            'expanded' => false,
            'choices_as_values' => true,
            )
        );
  }

  public function getBlockPrefix()
  {
     return 'season';
  }

  public function configureOptions(OptionsResolver $resolver)
  {
    $resolver->setDefaults(array(
                'data_class' => Season::class,
                'current_season' => null,
    ));  
  }
}
?>
