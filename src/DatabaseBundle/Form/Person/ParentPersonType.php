<?php
# src/DatabaseBundle/Form/Person/ParentPersonType.php

namespace DatabaseBundle\Form\Person;

use DatabaseBundle\Entity\ParentPerson;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

use Symfony\Component\Form\Extension\Core\Type\CheckboxType;

class ParentPersonType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('isParent', CheckboxType::class, array(
                                'label' => 'father',
                                'required' => false,));
    }

    public function getBlockPrefix()
    {
        return 'parentPerson';
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults(array(
                    'data_class' => ParentPerson::class,
        ));
    }
}
?>
