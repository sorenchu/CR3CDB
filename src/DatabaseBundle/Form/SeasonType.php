<?php
# src/DatabaseBundle/Form/SeasonType.php

namespace DatabaseBundle\Form;

Use DatabaseBundle\Entity\Season;

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
        ->addEventListener(FormEvents::POST_SET_DATA, function (FormEvent $event) {
        })
        ->add('save', SubmitType::class, array('label' => 'Mostrar'));
  }
}
?>
