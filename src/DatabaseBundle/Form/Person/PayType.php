<?php
# src/DatabaseBundle/Form/Person/PayType.php

namespace DatabaseBundle\Form\Person;

use DatabaseBundle\Entity\Pay;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\CollectionType;

class PayType extends AbstractType
{
  public function buildForm(FormBuilderInterface $builder, array $options) {
      $builder
          ->add('wayOfPayment', ChoiceType::class, 
                  array(
                    'label' => 'wayofpayment',
                    'choices' => array(
                         'bank'     => 'bank',
                         'transfer' => 'transfer',
                         'deposit'  => 'deposit',
                         'cash'     => 'cash',
                    ),
                    'empty_data' => 'bank',
          ))
          ->add('person', TextType::class,
                  array(
                    'required' => false,  
                    'label' => 'accountowner',
          ))
          ->add('accountNumber', TextType::class,
                  array(
                    'required' => false,
                    'label' => 'accountnumber',
          ))
          ->add('activepayment', CollectionType::class, 
                    array(
                      'entry_type' => ActivePaymentType::class,
                      'entry_options' => array('label' => false),
                      'allow_add' => true,
                      'by_reference' => false,
                      'allow_delete' => true,
          ));
  }

  public function getBlockPrefix()
  {
      return 'pay';
  }

  public function configureOptions(OptionsResolver $resolver) {
      $resolver->setDefaults(array(
                  'data_class' => Pay::class,
      ));
  }
}
?>
