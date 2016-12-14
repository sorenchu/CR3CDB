<?php
# src/DatabaseBundle/Form/Type/ParentDataType.php

namespace DatabaseBundle\Form\Type;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;

class ParentDataType extends AbstractType
{
  private $children;
  private $om;
  private $playerdata;

  public function __construct($children)
  {
    $this->children = $children;
  }

  public function buildForm(FormBuilderInterface $builder, array $options)
  {
    $builder
        ->add('season', 'choice', array(
            'label' => 'Temporada',
            'choices' => array(
              1 => '2016-2017',
              2 => '2017-2018',
            )
          )
        )
        ->add('playerdata', 'entity', array(
            'label' => 'Hijo',
            'class' => 'DatabaseBundle:PlayerData',
            'choices' => $this->children,
            'choice_label' => 'personalData.surname',
            'required' => false,
            'multiple' => true,
            )
        )
        ->add('save', 'submit', array('label' => 'Guardar'));
  }

  public function getName()
  {
    return 'parentData';
  }

  private function getAllChildren() 
  {
/*    $query = $this->em->createQuery(
        'SELECT playerdata
        FROM DatabaseBundle:PlayerData playerdata
        WHERE playerdata.category NOT LIKE :senior')
        ->setParameter('senior', 'Senior');

    return $query->getResult();*/
    return;
  }
}
?>
