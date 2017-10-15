<?php
# src/DatabaseBundle/Form/Person/ContactDataType.php

namespace DatabaseBundle\Form\Person;

use DatabaseBundle\Entity\ContactData;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\EmailType;
use Symfony\Component\Form\Extension\Core\Type\NumberType;

class ContactDataType extends AbstractType
{
  public function buildForm(FormBuilderInterface $builder, array $options) 
  {
    $builder
        ->add('address', TextType::class, array(
                          'required' => false,
                          'label' => 'Dirección'))
        ->add('city', TextType::class, array(
                          'required' => false,
                          'label' => 'Ciudad'))
        ->add('zipcode', NumberType::class, array(
                          'required' => false,
                          'label' => 'Código postal'))
        ->add('province', TextType::class, array(
                          'required' => false,
                          'label' => 'Provincia'))
        ->add('phone', NumberType::class, array(
                          'required' => false,
                          'label' => 'Teléfono'))
        ->add('email', EmailType::class, array(
                                  'required' => false,
                                  'label' => 'Correo Electrónico',));
  }

  public function getBlockPrefix()
  {
    return 'contactData';
  }

  public function configureOptions(OptionsResolver $resolver)
  {
    $resolver->setDefaults(array(
              'data_class' => ContactData::class,
    ));
  }
}
?>
