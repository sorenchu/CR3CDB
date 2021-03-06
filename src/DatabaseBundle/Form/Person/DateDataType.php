<?php
# src/DatabaseBundle/Form/Person/DateDataType.php

namespace DatabaseBundle\Form\Person;

use DatabaseBundle\Entity\DateData;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

use Symfony\Component\Form\Extension\Core\Type\CheckboxType;
use Symfony\Component\Form\Extension\Core\Type\DateType;

class DateDataType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('active', CheckboxType::class, array(
                                'label' => 'active',
                                'required' => false,))
            ->add('joiningDate', DateType::class, array(
                                'label' => 'signupdate',
                                'widget' => 'single_text',
                                'required' => false,))
            ->add('leavingDate', DateType::class, array(
                                'label' => 'signdowndate',
                                'widget' => 'single_text',
                                'required' => false,));
    }

    public function getBlockPrefix()
    {
        return 'dateData';
    }
  
    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults(array(
                  'data_class' => DateData::class,
        ));
    }

}
?>
