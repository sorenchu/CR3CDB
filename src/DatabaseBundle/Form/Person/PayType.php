<?php
# src/DatabaseBundle/Form/Person/PayType.php

namespace DatabaseBundle\Form\Person;

use DatabaseBundle\Entity\Pay;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\MoneyType;
use Symfony\Component\Form\Extension\Core\Type\CollectionType;

class PayType extends AbstractType
{
  public function buildForm(FormBuilderInterface $builder, array $options) {
      $builder
          ->add('wayOfPay', ChoiceType::class, 
                  array(
                    'label' => 'Modo de pago',
                    'choices' => array(
                        'bank' => 'Domiciliación bancaria',
                        'transfer' => 'Transferencia',
                        'deposit' => 'Ingreso',
                        'cash' => 'Efectivo',
          )))
          ->add('totalAmount', MoneyType::class, 
                  array(
                    'required' => false,
                    'label' => 'Coste'
          ))
          ->add('payment', CollectionType::class, 
                    array(
                      'entry_type' => PaymentType::class,
                      'allow_add' => true,
                      'by_reference' => false,
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
