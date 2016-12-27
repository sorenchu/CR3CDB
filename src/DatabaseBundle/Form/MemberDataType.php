<?php
# src/DatabaseBundle/Form/MemberDataType.php

namespace DatabaseBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;

use DatabaseBundle\Form\FormFactory\DataFormCreation;

class MemberDataType extends AbstractType implements DataFormCreation
{
  public function buildForm(FormBuilderInterface $builder, array $options)
  {
    $builder
        ->add('memberId', 'integer', array(
            'required' => true,
            'label' => 'Número de socio'))
        ->add('season', 'choice', array(
            'label' => 'Temporada',
            'choices' => array(
              2016 => '2016-2017',
            )
          )
        )
        ->add('payment', 'money', array(
                                    'required' => false,
                                    'label' => 'Pagos',))
        ->add('save', 'submit', array('label' => 'Guardar'));
  }

  public function getName()
  {
    return 'memberData';
  }
}

?>
