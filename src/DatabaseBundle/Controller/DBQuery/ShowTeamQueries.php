<?php
# src/DatabaseBundle/Controller/DBQuery/ShowTeamQueries.php

namespace DatabaseBundle\Controller\DBQuery;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class ShowTeamQueries extends Controller
{
  private $personController;

  public function __construct($personController)
  {
    $this->personController = $personController;
  }

  public function getAllMembers()
  {
    return ($this->personController
       ->getDoctrine()
         ->getRepository('DatabaseBundle:WholePerson')
           ->findAll()); 
  }

  public function getPlayers()
  {
    $em = $this->personController
              ->getDoctrine()
                ->getManager();
    $query = $em->createQuery(
         'SELECT playerdata
          FROM DatabaseBundle:PlayerData playerdata
          JOIN playerdata.wholePerson c
          WHERE c.id <> :null
          ORDER BY playerdata.category ASC')
          ->setParameter('null', 'NULL');

    return $query->getResult();
  }

  public function getParents($seasonId)
  {
    return $this->personController
             ->getDoctrine()
               ->getRepository('DatabaseBundle:ParentData')
                ->createQueryBuilder('parents')
                  ->join('parents.season', 'season')
                  ->where('season.id = :seasonId')
                  ->setParameter('seasonId', $seasonId)
                  ->getQuery()
                  ->getResult();
  }

  public function getMembers($seasonId)
  {
    return $this->personController
              ->getDoctrine()
                ->getRepository('DatabaseBundle:MemberData')
                  ->createQueryBuilder('members')
                    ->join('members.season', 'season')
                    ->where('season.id = :seasonId')
                    ->setParameter('seasonId', $seasonId)
                    ->getQuery()
                    ->getResult();
  }

  public function getByCategory($name, $tableName, $seasonId)
  {
    $alias = 'aliastable';
    $repository = $this->personController
                    ->getDoctrine()
                      ->getRepository($tableName);
    $query = $repository->createQueryBuilder($alias)
                  ->from($tableName, 'data')
                  ->join($alias.'.season', 'season')
                  ->where($alias.'.category LIKE :category')
                  ->andWhere('season.id = :seasonId')
                  ->setParameter('category', $name)
                  ->setParameter('seasonId', $seasonId)
                  ->getQuery();
    return $query->getResult();
  }
}
?>
