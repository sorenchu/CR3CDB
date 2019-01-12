<?php
# src/DatabaseBundle/Form/User/UserDataType.php

namespace DatabaseBundle\Form\User;

use DatabaseBundle\Entity\User;

use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\PasswordType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class UserDataType extends AbstractType
{
  private $admin;
  
  public function __construct($admin=false) 
  {
    $this->admin = $admin;
  }

  public function buildForm(FormBuilderInterface $builder, array $options)
  {
        if ($this->admin == true) {
            $builder->add('username', TextType::class,
                 array('label' => 'user',
                        'disabled' => true,))
                    ->add('role', ChoiceType::class, array(
                        'label' => 'role',
                        'choices' => array(
                            'admin' => 'ROLE_ADMIN',
                            'user' => 'ROLE_USER',
                            'accounting' => 'ROLE_ACCOUNTING',
                            ),
                        'disabled' => true,
                ));
        } else {
            $builder->add('username', TextType::class,
                 array('label' => 'Usuario',))
                    ->add('role', ChoiceType::class, array(
                        'label' => 'role',
                        'choices' => array(
                            'admin' => 'ROLE_ADMIN',
                            'user' => 'ROLE_USER',
                            'accounting' => 'ROLE_ACCOUNTING',
                            ),
                ));
        }
        $builder->add('password', PasswordType::class, array('label' => 'password'))
            ->add('save', SubmitType::class, array('label' => 'save'));
  }

  public function getBlockPrefix()
  {
    return 'userData';
  }

  public function configureOptions(OptionsResolver $resolver)
  {
    $resolver->setDefaults(array(
              'data_class' => User::class,
    ));
  }
}
?>
