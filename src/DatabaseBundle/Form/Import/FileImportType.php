<?php
# src/DatabaseBundle/Form/Import/FileImportType.php

namespace DatabaseBundle\Form\Import;

use DatabaseBundle\Entity\FileImport;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

use Symfony\Component\Form\Extension\Core\Type\FileType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\ResetType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;

class FileImportType extends AbstractType
{
  public function buildForm(FormBuilderInterface $builder, array $options)
  {
      $builder
        ->add('pathToFile', FileType::class, array(
            'label' => 'Archivo a importar'))
        ->add('content', ChoiceType::class, array(
                        'label' => 'Contenido',
                        'choices' => array(
                            'personalData' => 'Datos personales',
                            'playerData' => 'Fichas federativas',
                        )
                      )
        )
        ->add('upload', SubmitType::class, array('label' => 'Subir'))
        ->add('reset', ResetType::class, array('label' => 'Cancelar'));
  }

  public function getBlockPrefix()
  {
      return 'importFile';
  }

  public function configureOptions(OptionsResolver $resolver)
  {
      $resolver->setDefaults(array(
          'data_class' => FileImport::class,
      ));
  }
}
?>
