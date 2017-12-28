<?php
# src/DatabaseBundle/Form/Person/PayType.php

namespace DatabaseBundle\Form\Person;

use DatabaseBundle\Entity\Pay;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\MoneyType;
use Symfony\Component\Form\Extension\Core\Type\CollectionType;

class PayType extends AbstractType
{
  public function buildForm(FormBuilderInterface $builder, array $options) {
      $builder
          ->add('wayOfPayment', ChoiceType::class, 
                  array(
                    'label' => 'Modo de pago',
                    'choices' => array(
                        'bank' => 'Domiciliación bancaria',
                        'transfer' => 'Transferencia',
                        'deposit' => 'Ingreso',
                        'cash' => 'Efectivo',),
                    'empty_data' => 'bank',
          ))
          ->add('totalAmount', MoneyType::class, 
                  array(
                    'required' => true,
                    'label' => 'Coste',
                    'empty_data' => 0,
          ))
          ->add('person', TextType::class,
                  array(
                    'required' => false,  
                    'label' => 'Titular de la cuenta'
          ))
          ->add('accountNumber', TextType::class,
                  array(
                    'required' => false,
                    'label' => 'Número de cuenta'
          ))
          ->add('payment', CollectionType::class, 
                    array(
                      'entry_type' => PaymentType::class,
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
