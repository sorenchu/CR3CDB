<?php
# src/DatabaseBundle/Form/Person/PlayerPersonType.php

namespace DatabaseBundle\Form\Person;

use DatabaseBundle\Entity\PlayerPerson;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

use Symfony\Component\Form\Extension\Core\Type\CheckboxType;

class PlayerPersonType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('isPlayer', CheckboxType::class, array(
                                'label' => 'Jugador',
                                'required' => false,));
    }

    public function getBlockPrefix()
    {
        return 'coachPerson';
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults(array(
                    'data_class' => PlayerPerson::class,
        ));
    }
}
?>
