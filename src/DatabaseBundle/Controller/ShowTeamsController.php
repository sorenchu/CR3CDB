<?php
# src/DatabaseBundle/Controller/ShowTeams.php

namespace DatabaseBundle\Controller;

use DatabaseBundle\Entity\PersonalData;
use DatabaseBundle\Entity\PlayerData;
use DatabaseBundle\Form\Type\PersonalDataType;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

class ShowTeamsController extends Controller
{
  public function showSeniorAction()
  {
    $playerData = $this->teamQuery('Senior')->getResult();
    return $this->render('DatabaseBundle:Teams:showteam.html.twig', array(
                'playerData' => $playerData,
                'teamName' => 'Senior'));
  }

  public function showFemaleAction()
  {
    $playerData = $this->teamQuery('Femenino')->getResult();
    return $this->render('DatabaseBundle:Teams:showteam.html.twig', array(
                'playerData' => $playerData,
                'teamName' => 'Femenino'));
  }

  public function showCadeteAction()
  {
    $playerData = $this->teamQuery('Cadete')->getResult();
    return $this->render('DatabaseBundle:Teams:showteam.html.twig', array(
                'playerData' => $playerData,
                'teamName' => 'Cadete'));
  }

  public function showAlevinAction()
  {
    $playerData = $this->teamQuery('Alevin')->getResult();
    return $this->render('DatabaseBundle:Teams:showteam.html.twig', array(
                'playerData' => $playerData,
                'teamName' => 'Alevín'));
  }

  public function showBenjaminAction()
  {
    $playerData = $this->teamQuery('Benjamin')->getResult();
    return $this->render('DatabaseBundle:Teams:showteam.html.twig', array(
                'playerData' => $playerData,
                'teamName' => 'Benjamín'));
  }

  public function showPrebenjaminAction()
  {
    $playerData = $this->teamQuery('Prebenjamin')->getResult();
    return $this->render('DatabaseBundle:Teams:showteam.html.twig', array(
                'playerData' => $playerData,
                'teamName' => 'Prebenjamín'));
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
