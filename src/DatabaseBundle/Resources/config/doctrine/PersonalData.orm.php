<?php

use Doctrine\ORM\Mapping\ClassMetadataInfo;

$metadata->setInheritanceType(ClassMetadataInfo::INHERITANCE_TYPE_NONE);
$metadata->customRepositoryClassName = 'DatabaseBundle\Repository\PersonalDataRepository';
$metadata->setChangeTrackingPolicy(ClassMetadataInfo::CHANGETRACKING_DEFERRED_IMPLICIT);
$metadata->mapField(array(
   'fieldName' => 'id',
   'type' => 'integer',
   'id' => true,
   'columnName' => 'id',
  ));
$metadata->mapField(array(
   'columnName' => 'name',
   'fieldName' => 'name',
   'type' => 'string',
   'length' => '40',
  ));
$metadata->mapField(array(
   'columnName' => 'surname',
   'fieldName' => 'surname',
   'type' => 'string',
   'length' => '150',
  ));
$metadata->mapField(array(
   'columnName' => 'nickname',
   'fieldName' => 'nickname',
   'type' => 'string',
   'length' => '30',
   'nullable' => true,
  ));
$metadata->mapField(array(
   'columnName' => 'email',
   'fieldName' => 'email',
   'type' => 'string',
   'length' => 255,
   'nullable' => true,
  ));
$metadata->mapField(array(
   'columnName' => 'phone',
   'fieldName' => 'phone',
   'type' => 'integer',
   'nullable' => true,
  ));
$metadata->mapField(array(
   'columnName' => 'dni',
   'fieldName' => 'dni',
   'type' => 'string',
   'length' => '10',
   'nullable' => true,
   'unique' => true,
  ));
$metadata->mapField(array(
   'columnName' => 'sex',
   'fieldName' => 'sex',
   'type' => 'string',
   'length' => '7',
  ));
$metadata->mapField(array(
   'columnName' => 'birthday',
   'fieldName' => 'birthday',
   'type' => 'datetime',
   'nullable' => true,
  ));
$metadata->setIdGeneratorType(ClassMetadataInfo::GENERATOR_TYPE_AUTO);
