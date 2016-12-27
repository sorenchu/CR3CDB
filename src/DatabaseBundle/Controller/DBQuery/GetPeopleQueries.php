<?php
# src/DatabaseBundle/Controller/DBQuery/GetPeopleQueries.php

namespace DatabaseBundle\Controller\DBQuery;

use DatabaseBundle\Entity\PersonalData;
use DatabaseBundle\Entity\PlayerData;
use DatabaseBundle\Entity\CoachData;
use DatabaseBundle\Entity\MemberData;
use DatabaseBundle\Entity\ParentData;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class GetPeopleQueries extends Controller
{
  private $editPersonController;

  public function __construct($editPersonController)
  {
    $this->editPersonController = $editPersonController;
  }

  public function getPeopleByType($id, $table)
  {
    if (0 == strcmp("playerdata", $table))
    {
      $tableName = 'DatabaseBundle:Playerdata';
      $alias = 'playerdata';
    }
    else if (0 == strcmp("coachdata", $table))
    {
      $tableName = 'DatabaseBundle:Coachdata';
      $alias = 'coachdata';
    }
    else if (0 == strcmp("memberdata", $table))
    {
      $tableName = 'DatabaseBundle:Memberdata';
      $alias = 'memberdata';
    }
    else if (0 == strcmp("parentdata", $table))
    {
      $tableName = 'DatabaseBundle:Parentdata';
      $alias = 'parentdata';
    }
    else 
    {
      return null;
    }

    $repository = $this->editPersonController->
                          getDoctrine()->getRepository($tableName);
    $query = $repository->createQueryBuilder($alias)
        ->from($tableName, 'data')
        ->join($alias.'.personalData', 'person')
        ->where('person.id = :id')
        ->setParameter('id', $id)
        ->getQuery();
    return $query;
  }

  public function getTypeOfPerson($query, $table)
  {
    if (NULL != $query->getOneOrNullResult())
    {
      $data = $query->getOneOrNullResult();
    }
    else
    {
      if (0 == strcmp("playerdata", $table))
      {
        $data = new PlayerData();
      }
      else if (0 == strcmp("coachdata", $table))
      {
        $data = new CoachData();
      }
      else if (0 == strcmp("memberdata", $table))
      {
        $data = new MemberData();
      }
      else if (0 == strcmp("parentdata", $table))
      {
        $data = new ParentData();
      }
    }
    return $data;
  }

  public function getTableDataForPerson($id, $table)
  {
    $query = $this->getPeopleByType($id, $table);
    return $this->getTypeOfPerson($query, $table);
  }
}

?>
