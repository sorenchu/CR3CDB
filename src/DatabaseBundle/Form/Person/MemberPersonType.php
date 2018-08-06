<?php
# src/DatabaseBundle/Form/Person/MemberPersonType.php

namespace DatabaseBundle\Form\Person;

use DatabaseBundle\Entity\MemberPerson;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

use Symfony\Component\Form\Extension\Core\Type\CheckboxType;

class MemberPersonType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('isMember', CheckboxType::class, array(
                                'label' => 'Socio',
                                'required' => false,));
    }

    public function getBlockPrefix()
    {
        return 'memberPerson';
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults(array(
                    'data_class' => MemberPerson::class,
        ));
    }
}
?>
