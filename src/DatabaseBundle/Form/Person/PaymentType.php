<?php
# src/DatabaseBundle/Form/Person/PaymentType.php

namespace DatabaseBundle\Form\Person;

use DatabaseBundle\Entity\Payment;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\MoneyType;
use Symfony\Component\Form\Extension\Core\Type\DateType;

class PaymentType extends AbstractType
{
  public function buildForm(FormBuilderInterface $builder, array $options) {
      $builder
          ->add('wayOfPay', ChoiceType::class, 
                  array(
                    'label' => 'Modo de pago',
                    'choices' => array(
                        'bank' => 'Domiciliación bancaria',
                        'transfer' => 'Transferencia',
                        'cash' => 'Efectivo',
          )))
          ->add('amountOwned', MoneyType::class, 
                  array(
                    'required' => false,
                    'label' => 'Debe',
          ))
          ->add('amountPayed', MoneyType::class,
                  array(
                    'required' => false,
                    'label' => 'Pagado',
          ))
          ->add('paymentDate', DateType::class,
                  array(
                    'required' => false,
                    'label' => 'Fecha de pago',
                    'widget' => 'single_text',
                    'format' => 'dd/MM/yyyy'
          ));
  }

  public function configureOptions(OptionsResolver $resolver) {
      $resolver->setDefaults(array(
                  'data_class' => Payment::class,
      ));
  }
}
?>
