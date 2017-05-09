<?php
# src/DatabaseBundle/Form/Season/AddSeasonType.php

namespace DatabaseBundle\Form\Season;

use DatabaseBundle\Entity\Season;

use Symfony\Component\Form\Extension\Core\Type\NumberType;
use Symfony\Component\Form\Extension\Core\Type\CheckboxType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class AddSeasonType extends AbstractType
{
  public function buildForm(FormBuilderInterface $builder, array $options)
  {
    $builder
        ->add('startingyear', NumberType::class, array(
                                          'required' => true,
                                          'label' => 'Año',))
        ->add('defaultseason', CheckboxType::class, array(
                                          'label' => 'Por defecto',
                                          'required' => false,))
        ->add('save', SubmitType::class, array(
                                          'label' => 'Guardar'));
  }
}
?>
