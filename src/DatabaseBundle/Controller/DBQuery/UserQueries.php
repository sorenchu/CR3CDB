<?php
# src/DatabaseBundle/Controller/DBQuery/UserQueries.php

namespace DatabaseBundle\Controller\DBQuery;

use DatabaseBundle\Entity\User;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class UserQueries extends Controller
{
  private $adminController;

  public function __construct($adminController)
  {
    $this->adminController = $adminController;
  }

  public function saveUser($user)
  {
    $em = $this->adminController->getDoctrine()->getManager();
    $em->persist($user);
    $em->flush();
  } 

}
