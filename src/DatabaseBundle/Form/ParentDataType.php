<?php
# src/DatabaseBundle/Form/ParentDataType.php

namespace DatabaseBundle\Form;

use DatabaseBundle\Entity\ParentData;
use DatabaseBundle\Form\FormFactory\DataFormCreation;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\OptionsResolver\OptionsResolver;

class ParentDataType extends AbstractType implements DataFormCreation
{
  private $children;
  private $parentToChildren;

  public function __construct($children, $parentToChildren)
  {
    $this->children = $children;
  }

  public function buildForm(FormBuilderInterface $builder, array $options)
  {
    $builder
        ->add('season', 'choice', array(
            'label' => 'Temporada',
            'choices' => array(
              2016 => '2016-2017',
              2017 => '2017-2018',
            )
          )
        )
        ->add('playerdata', 'entity', array(
            'label' => 'Hijo',
            'class' => 'DatabaseBundle:PlayerData',
            'choices' => $this->children,
            'required' => true,
            'multiple' => true,
            'expanded' => true,
            'group_by' => 'category',
            )
        );
        //->add('save', 'submit', array('label' => 'Guardar'));
  }

  public function getName()
  {
    return 'parentData';
  }

  public function configureOptions(OptionsResolver $resolver)
  {
    $resolver->setDefaults(array(
              'data_class' => ParentData::class,
    ));
  }
}
?>
