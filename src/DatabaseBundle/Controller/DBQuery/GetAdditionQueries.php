<?php
# src/DatabaseBundle/Controller/DBQuery/GetAdditionQueries.php

namespace DatabaseBundle\Controller\DBQuery;

use DatabaseBundle\Entity\PersonalData;
use DatabaseBundle\Entity\PlayerData;
use DatabaseBundle\Entity\CoachData;
use DatabaseBundle\Entity\MemberData;
use DatabaseBundle\Entity\ParentData;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class GetAdditionQueries extends Controller
{
  private $personController;

  public function __construct($personController)
  {
    $this->personController = $personController;
  }

  public function getDataById($id, $table)
  {

  }
}
?>
