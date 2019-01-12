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
                          'label' => 'address'))
        ->add('city', TextType::class, array(
                          'required' => false,
                          'label' => 'city'))
        ->add('zipcode', NumberType::class, array(
                          'required' => false,
                          'label' => 'zipcode'))
        ->add('province', TextType::class, array(
                          'required' => false,
                          'label' => 'province'))
        ->add('phone', NumberType::class, array(
                          'required' => false,
                          'label' => 'phonenumber'))
        ->add('email', EmailType::class, array(
                                  'required' => false,
                                  'label' => 'email',));
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
