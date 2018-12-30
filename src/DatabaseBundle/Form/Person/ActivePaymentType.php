<?php
# src/DatabaseBundle/Form/Person/ActivePaymentType.php

namespace DatabaseBundle\Form\Person;

use DatabaseBundle\Entity\ActivePayment;

use DatabaseBundle\Form\Person\PaymentType;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;


class ActivePaymentType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options) {
        $builder
            ->add('payment', PaymentType::class);
    }

    public function getBlockPrefix()
    {
        return 'activePayment';
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults(array(
                    'data_class' => ActivePayment::class,
        ));
    }
}
?>
