<?php
# src/DatabaseBundle/Form/Person/PaymentType.php

namespace DatabaseBundle\Form\Person;

use DatabaseBundle\Entity\Payment;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\MoneyType;
use Symfony\Component\Form\Extension\Core\Type\DateType;

class PaymentType extends AbstractType
{
  public function buildForm(FormBuilderInterface $builder, array $options) {
      $builder
          ->add('amountPayed', MoneyType::class,
                  array(
                    'required' => false,
                    'label' => 'Pagado',
          ))
          ->add('paymentDate', DateType::class,
                  array(
                    'required' => false,
                    'label' => 'Fecha de recibo',
                    'widget' => 'single_text'
          ))
          ->add('status', ChoiceType::class,
                  array(
                    'label' => 'Estado',
                    'choices' => array(
                        'Pendiente de cobro' => 'pending',
                        'Cobrado'            => 'charged',
                        'Devuelto'           => 'returned',
                    ),
          ));
  }

  public function getBlockPrefix()
  {
      return 'payment';
  }

  public function configureOptions(OptionsResolver $resolver) {
      $resolver->setDefaults(array(
                  'data_class' => Payment::class,
      ));
  }
}
?>
