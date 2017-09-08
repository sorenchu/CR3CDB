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

  public function getPerson($id)
  {
    $em = $this->personController->getDoctrine()->getManager();
    return $em->getRepository('DatabaseBundle:PersonalData')->find($id);
  }

  public function getPeopleByType($id, $table)
  {
    if (0 == strcmp("playerdata", $table)) {
      $tableName = 'DatabaseBundle:Playerdata';
      $alias = 'playerdata';
    } else if (0 == strcmp("coachdata", $table)) {
      $tableName = 'DatabaseBundle:Coachdata';
      $alias = 'coachdata';
    } else if (0 == strcmp("memberdata", $table)) {
      $tableName = 'DatabaseBundle:Memberdata';
      $alias = 'memberdata';
    } else if (0 == strcmp("parentdata", $table)) {
      $tableName = 'DatabaseBundle:Parentdata';
      $alias = 'parentdata';
    } else {
      return null;
    }

    $repository = $this->personController->
                          getDoctrine()->getRepository($tableName);
    $query = $repository->createQueryBuilder($alias)
        ->from($tableName, 'data')
        ->join($alias.'.personalData', 'person')
        ->where('person.id = :id')
        ->setParameter('id', $id)
        ->getQuery();
    return $query;
  }

  public function savePerson($personalData, $edit)
  {
    $em = $this->personController->getDoctrine()->getManager();
    if ($edit)
      $em->merge($personalData);
    $em->persist($personalData);
    $em->flush();
  }

  public function deletePerson($id)
  {
    $em = $this->personController->getDoctrine()->getManager();
    $personalData = $em->getRepository('DatabaseBundle:PersonalData')
                      ->find($id);
    $em->remove($personalData);
    $em->flush();
  }

  public function getCategoryFromPerson($id, $table)
  {
    $em = $this->personController->getDoctrine()->getManager();
    if (0 == $table)
      return $em->getRepository('DatabaseBundle:PlayerData')
                ->find($id)
                ->getCategory();
    return $em->getRepository('DatabaseBundle:CoachData')
                ->find($id)
                ->getCategory();
  }

  public function deleteFromTeam($id, $seasonId, $table)
  {
    $em = $this->personController->getDoctrine()->getManager();
    if (0 == $table) {
      $teamMember = $em->getRepository('DatabaseBundle:PlayerData')
                        ->createQueryBuilder('players')
                        ->join('players.season', 'season')
                        ->where('season.id = :seasonId')
                        ->andWhere('players.id = :id')
                        ->setParameter('seasonId', $seasonId)
                        ->setParameter('id', $id)
                        ->getQuery()
                        ->getResult()[0];
    } else {
      $teamMember = $em->getRepository('DatabaseBundle:CoachData')
                        ->createQueryBuilder('coaches')
                        ->join('coaches.season', 'season')
                        ->where('season.id = :seasonId')
                        ->andWhere('coaches.id = :id')
                        ->setParameter('seasonId', $seasonId)
                        ->setParameter('id', $id)
                        ->getQuery()
                        ->getResult()[0];
    }
    $em->remove($teamMember);
    $em->flush();
  }

  public function deleteFromMember($id, $seasonId)
  {
    $em = $this->personController->getDoctrine()->getManager();
    $member = $em->getRepository('DatabaseBundle:MemberData')
                  ->createQueryBuilder('members')
                  ->join('members.season', 'season')
                  ->where('season.id = :seasonId')
                  ->andWhere('members.id = :id')
                  ->setParameter('seasonId', $seasonId)
                  ->setParameter('id', $id)
                  ->getQuery()
                  ->getResult()[0];
    $em->remove($member);
    $em->flush();
  }

  public function deleteFromParent($id, $seasonId)
  {
    $em = $this->personController->getDoctrine()->getManager();
    $parent = $em->getRepository('DatabaseBundle:ParentData')
                  ->createQueryBuilder('parents')
                  ->join('parents.season', 'season')
                  ->where('season.id = := seasonId')
                  ->andWhere('parents.id = :id')
                  ->setParameter('seasonId', $seasonId)
                  ->setParameter('id', $id)
                  ->getQuery()
                  ->getResult()[0];
    $em->remove($parent);
    $em->flush();
  }
}
?>
