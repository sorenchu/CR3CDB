<?php
# src/DatabaseBundle/Form/Person/PlayerPersonType.php

namespace DatabaseBundle\Form\Person;

use DatabaseBundle\Entity\PlayerPerson;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

use Symfony\Component\Form\Extension\Core\Type\CheckboxType;

use Symfony\Component\Form\FormEvent;
use Symfony\Component\Form\FormEvents;

class PlayerPersonType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options) {
        $builder
            ->add('isPlayer', CheckboxType::class, array(
                                'label' => 'player',
                                'required' => false,))
            ->addEventListener(FormEvents::POST_SET_DATA,
                               function (FormEvent $event) {
                $personalData = $event->getData();
                $form = $event->getForm();

                if ($personalData) {
                    $form->add('playerData', PlayerDataType::class);
                }
        });
    }

    public function getBlockPrefix()
    {
        return 'playerPerson';
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults(array(
                    'data_class' => PlayerPerson::class,
        ));
    }
}
?>
