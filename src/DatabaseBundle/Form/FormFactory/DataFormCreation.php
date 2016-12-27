<?php
# src/DatabaseBundle/Form/FormFactory/DataFormCreation.php

namespace DatabaseBundle\Form\FormFactory;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;

interface DataFormCreation
{
  public function buildForm(FormBuilderInterface $builder, array $options);

  public function getName();
}
?>
