<?php
# src/DatabaseBundle/Controller/DBQuery/GetEditionQueries.php

namespace DatabaseBundle\Controller\DBQuery;

use DatabaseBundle\Entity\PersonalData;
use DatabaseBundle\Entity\PlayerData;
use DatabaseBundle\Entity\CoachData;
use DatabaseBundle\Entity\MemberData;
use DatabaseBundle\Entity\ParentData;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class GetEditionQueries extends Controller
{
  private $personController;

  public function __construct($personController)
  {
    $this->personController = $personController;
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

    $repository = $this->personController->
                          getDoctrine()->getRepository($tableName);
    $query = $repository->createQueryBuilder($alias)
        ->from($tableName, 'data')
        ->join($alias.'.wholePerson', 'person')
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

  public function getNewPerson($wholePerson)
  {
    $em = $this->personController->getDoctrine()->getManager();
    $query = $em->createQuery(
        'SELECT wholeperson
         FROM DatabaseBundle:WholePerson wholeperson
         WHERE wholeperson.id = :id')
         ->setParameter('id', $wholePerson->getId());

    return $query->getResult()[0];
  }

  public function savePerson($wholePerson)
  {
    $em = $this->personController->getDoctrine()->getManager();
    $em->persist($wholePerson);
    $em->flush();
  }

  public function deletePerson($id)
  {
    $em = $this->personController->getDoctrine()->getManager();
    $wholePerson = $em->getRepository('DatabaseBundle:WholePerson')
                      ->find($id);
    $em->remove($wholePerson);
    $em->flush();
  }
}

?>
