<?php
# src/DatabaseBundle/Controller/ShowPlayer.php

namespace DatabaseBundle\Controller;

use DatabaseBundle\Entity\PersonalData;
use DatabaseBundle\Entity\PlayerData;
use DatabaseBundle\Form\Type\PersonalDataType;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

class ShowPeopleController extends Controller
{
  public function showAllAction()
  {
    $personalData = $this->getDoctrine()
              ->getRepository('DatabaseBundle:PersonalData')   
              ->findAll();
    return $this->render('DatabaseBundle:Default:showall.html.twig', array(
                'personalData' => $personalData));
  }

  public function showPlayersAction()
  {
    $em = $this->getDoctrine()->getManager();
    $query = $em->createQuery(
        'SELECT playerdata
         FROM DatabaseBundle:PlayerData playerdata
         JOIN playerdata.personalData c
         WHERE c.id <> :null
         ORDER BY c.surname ASC')
        ->setParameter('null', 'NULL');

    $playerData = $query->getResult();
    return $this->render('DatabaseBundle:Default:showplayers.html.twig', array(
                'playerData' => $playerData));
  }

  public function showSeniorAction()
  {
    $playerData = $this->teamQuery('Senior')->getResult();
    return $this->render('DatabaseBundle:Default:showsenior.html.twig', array(
                'playerData' => $playerData));
  }

  /*public function showFemaleAction()
  {
    $playerData = $this->
  }*/

  public function showAlevinAction()
  {
    $playerData = $this->teamQuery('Alevin')->getResult();
    return $this->render('DatabaseBundle:Default:showalevin.html.twig', array(
                'playerData' => $playerData));

  }

  private function teamQuery($name)
  {
    $tableName = 'DatabaseBundle:PlayerData';
    $alias = 'playerdata';

    $repository = $this->getDoctrine()
              ->getRepository($tableName);
    $query = $repository->createQueryBuilder($alias)
        ->from($tableName, 'data')
        ->where($alias.'.category LIKE :category')
        ->setParameter('category', $name)
        ->getQuery();
    return $query;
  }
}
?>
