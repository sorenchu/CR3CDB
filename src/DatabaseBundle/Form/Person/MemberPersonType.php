<?php
# src/DatabaseBundle/Form/Person/MemberPersonType.php

namespace DatabaseBundle\Form\Person;

use DatabaseBundle\Entity\MemberPerson;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

use Symfony\Component\Form\Extension\Core\Type\CheckboxType;

use Symfony\Component\Form\FormEvent;
use Symfony\Component\Form\FormEvents;

class MemberPersonType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('isMember', CheckboxType::class, array(
                                'label' => 'member',
                                'required' => false,))
            ->addEventListener(FormEvents::POST_SET_DATA,
                               function (FormEvent $event) {
                $personalData = $event->getData();
                $form = $event->getForm();

                if ($personalData) {
                    $form->add('memberData', MemberDataType::class);
                }
            });
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
