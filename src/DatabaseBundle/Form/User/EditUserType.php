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
              array('label' => 'user',
                    'disabled' => 'true'))
        ->add('role', ChoiceType::class, array(
            'label' => 'Rol',
            'choices' => array(
              'admin' => 'ROLE_ADMIN', 
              'user'       => 'ROLE_USER',
              'accounting'      => 'ROLE_ACCOUNTING',
            ),
            'disabled' => 'true',
        ))
        ->add('oldpassword', PasswordType::class, array(
                     'label' => 'currentpassword')
          )
        ->add('password', RepeatedType::class, array(
                     'type' => PasswordType::class,
                     'invalid_message' => 'Las contraseñas deben coincidir',
                     'options' => array(
                            'attr' => array('class' => 'password-field')),
                     'required' => false,
                     'first_options'  => array('label' => 'Nueva contraseña'),
                     'second_options' => array('label' => 'Repita contraseña'),
          ))
        ->add('save', SubmitType::class, array('label' => 'save'));
  }

  public function getBlockPrefix()
  {
      return "editUser";
  }
}
?>
