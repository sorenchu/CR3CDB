<?php
# src/DatabaseBundle/Form/Searcher/SearcherType.php

namespace DatabaseBundle\Form\Searcher;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

use Symfony\Component\Form\Extension\Core\Type\TextType;

use Symfony\Component\Form\FormEvent;
use Symfony\Component\Form\FormEvents;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;

class SearcherType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('searcher', TextType::class, array('label' => 'search'))
            ->add('search', SubmitType::class, array('label' => 'searching'));
    }

    public function getBlockPrefix()
    {
        return 'searcher';
    }
}
?>
