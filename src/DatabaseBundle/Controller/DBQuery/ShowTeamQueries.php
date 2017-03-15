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

  public function getParents()
  {
    return $this->personController
             ->getDoctrine()
               ->getRepository('DatabaseBundle:ParentData')
                 ->findAll();
  }

  public function getMembers()
  {
    return $this->personController
             ->getDoctrine()
               ->getRepository('DatabaseBundle:MemberData')
                 ->findAll();
  }

  public function getByCategory($name, $tableName)
  {
    $alias = 'aliastable';
    $repository = $this->personController
                    ->getDoctrine()
                      ->getRepository($tableName);
    $query = $repository->createQueryBuilder($alias)
                  ->from($tableName, 'data')
                  ->where($alias.'.category LIKE :category')
                  ->setParameter('category', $name)
                  ->getQuery();
    return $query->getResult();
  }
}
?>
