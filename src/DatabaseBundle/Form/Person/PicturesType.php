<?php
# src/DatabaseBundle/Form/Person/PicturesType.php

namespace DatabaseBundle\Form\Person;

use DatabaseBundle\Entity\Pictures;

use Symfony\Component\Form\Extension\Core\Type\FileType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class PicturesType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('frontDni', FileType::class, array(
                'label' => 'DNI (delantero)',
                "attr" => array("class" => "form-control"),
                'data_class' => null,
            ))
            ->add('backDni', FileType::class, array(
                'label' => 'DNI (trasero)',
                "attr" => array("class" => "form-control"),
                'data_class' => null,
            ))
            ->add('familyBook', FileType::class, array(
                'label' => 'Libro de familia',
                "attr" => array("class" => "form-control"),
                'data_class' => null,
            ))
            ->add('healthCareCard', FileType::class, array(
                'label' => 'Tarjeta sanitaria',
                "attr" => array("class" => "form-control"),
                'data_class' => null,
            ))
            ->add('save', SubmitType::class, array(
                'label' => 'Guardar'));
    }

    public function getBlockPrefix()
    {
        return 'pictures';
    }
    
    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults(array(
                  'data_class' => Pictures::class,
        ));
    }
}

?>
