<?php
# src/DatabaseBundle/For/Journal/JournalType.php

namespace DatabaseBundle\Form\Journal;

use DatabaseBundle\Entity\Journal;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;

use Symfony\Component\Form\Extension\Core\Type\SubmitType;

class JournalType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder->add('title', TextType::class, array(
                        'label' => 'Título',
                    ))
                ->add('text', TextareaType::class, array(
                        'label' => 'Contenido',
                    ))
                ->add('save', SubmitType::class, array(
                        'label' => 'Guardar'));
    }

    public function getBlockPrefix()
    {
        return 'journal';
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults(array(
                    'data_class' => Journal::class,
        ));
    }

}
