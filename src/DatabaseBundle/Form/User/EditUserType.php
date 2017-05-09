<?php
# src/DatabaseBundle/Form/User/EditUserType.php

namespace DatabaseBundle\Form\User;

use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\PasswordType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\RepeatedType;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class EditUserType extends AbstractType
{
  public function buildForm(FormBuilderInterface $builder, array $options)
  {
    $builder
        ->add('username', TextType::class,
              array('label' => 'Usuario',
                    'disabled' => 'true'))
        ->add('role', ChoiceType::class, array(
            'label' => 'Rol',
            'choices' => array(
              'ROLE_ADMIN' => 'Administrador',
              'ROLE_USER' => 'Usuario',
            ),
            'disabled' => 'true')
          )
        ->add('password', RepeatedType::class, array(
                     'type' => PasswordType::class,
                     'invalid_message' => 'Las contraseñas deben coincidir',
                     'options' => array(
                            'attr' => array('class' => 'password-field')),
                     'required' => true,
                     'first_options'  => array('label' => 'Nueva contraseña'),
                     'second_options' => array('label' => 'Repita contraseña'),
          ))
        ->add('save', SubmitType::class, array('label' => 'Guardar'));
  }

  public function getBlockPrefix()
  {
      return "editUser";
  }
}
?>
