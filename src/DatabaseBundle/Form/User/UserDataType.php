<?php
# src/DatabaseBundle/Form/UserDataType.php

namespace DatabaseBundle\Form;

use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\PasswordType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class UserDataType extends AbstractType
{
  public function buildForm(FormBuilderInterface $builder, array $options)
  {
    $builder
        ->add('username', TextType::class, array('label' => 'Usuario'))
        ->add('password', PasswordType::class, array('label' => 'Contraseña'))
        ->add('role', ChoiceType::class, array(
            'label' => 'Rol',
            'choices' => array(
              'ROLE_ADMIN' => 'Administrador',
              'ROLE_USER' => 'Usuario',
            )
          )
        )
        ->add('save', SubmitType::class, array('label' => 'Guardar'));
  }

  public function getBlockPrefix()
  {
    return 'userData';
  }
}
?>
