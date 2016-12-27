<?php
# src/DatabaseBundle/Form/Type/FormFactory/DataFormCreation.php

namespace DatabaseBundle\Form\Type\FormFactory;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;

interface DataFormCreation
{
  public function buildForm(FormBuilderInterface $builder, array $options);

  public function getName();
}
?>
