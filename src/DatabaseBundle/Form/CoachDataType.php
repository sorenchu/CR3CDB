<?php
# src/DatabaseBundle/Form/CoachDataType.php

namespace DatabaseBundle\Form;

use DatabaseBundle\Entity\CoachData;
use DatabaseBundle\Form\FormFactory\DataFormCreation;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class CoachDataType extends AbstractType implements DataFormCreation
{
  public function buildForm(FormBuilderInterface $builder, array $options)
  {
    $builder
        ->add('season', 'choice', array(
            'label' => 'Temporada',
            'choices' => array(
              2016 => '2016-2017',
              2017 => '2017-2018',
            )
          )
        )
        ->add('salary', 'money', array(
                                    'required' => false,
                                    'label' => 'Sueldo',))
        ->add('category', 'choice', array(
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
//          ->add('save', 'submit', array('label' => 'Guardar'));
  }

  public function getName()
  {
    return 'coachData';
  }

  public function configureOptions(OptionsResolver $resolver)
  {
    $resolver->setDefaults(array(
              'data_class' => CoachData::class,
    ));
  }
}
?>
