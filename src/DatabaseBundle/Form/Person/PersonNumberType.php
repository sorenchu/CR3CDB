<?php
# src/DatabaseBundle/Form/Person/PersonNumberType.php

namespace DatabaseBundle\Form\Person;

use DatabaseBundle\Entity\PersonNumber;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

use Symfony\Component\Form\Extension\Core\Type\TextType;

class PersonNumberType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options) {
        $builder
            ->add('number', TextType::class, array(
                'label' => 'rugbynumber',
                'required' => false,
            )
        );
    }

    public function getBlockPrefix() {
        return 'personNumber';
    }

    public function configureOptions(OptionsResolver $resolver) {
        $resolver->setDefaults(array(
                    'data_class' => PersonNumber::class,
        ));
    }
}
