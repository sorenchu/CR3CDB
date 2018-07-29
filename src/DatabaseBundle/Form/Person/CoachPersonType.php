<?php
# src/DatabaseBundle/Form/Person/CoachPersonType.php

namespace DatabaseBundle\Form\Person;

use DatabaseBundle\Entity\CoachPerson;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

use Symfony\Component\Form\Extension\Core\Type\CheckboxType;

class CoachPersonType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('isCoach', CheckboxType::class, array(
                                'label' => 'Entrenador',
                                'required' => false,));
    }

    public function getBlockPrefix()
    {
        return 'coachPerson';
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults(array(
                    'data_class' => CoachPerson::class,
        ));
    }
}
?>
