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
    $playerData = $this->filterByCategory('Senior', 'DatabaseBundle:PlayerData')->getResult();
    $coachData = $this->filterByCategory('Senior', 'DatabaseBundle:CoachData')->getResult();
    return $this->render('DatabaseBundle:Teams:showteam.html.twig', array(
                'playerData' => $playerData,
                'coachData' => $coachData,
                'teamName' => 'Senior'));
  }

  public function showFemaleAction()
  {
    $playerData = $this->filterByCategory('Femenino', 'DatabaseBundle:PlayerData')->getResult();
    $coachData = $this->filterByCategory('Femenino', 'DatabaseBundle:CoachData')->getResult();
    return $this->render('DatabaseBundle:Teams:showteam.html.twig', array(
                'playerData' => $playerData,
                'coachData' => $coachData,
                'teamName' => 'Femenino'));
  }

  public function showCadeteAction()
  {
    $playerData = $this->filterByCategory('Cadete', 'DatabaseBundle:PlayerData')->getResult();
    $coachData = $this->filterByCategory('Cadete', 'DatabaseBundle:CoachData')->getResult();
    return $this->render('DatabaseBundle:Teams:showteam.html.twig', array(
                'playerData' => $playerData,
                'coachData' => $coachData,
                'teamName' => 'Cadete'));
  }

  public function showAlevinAction()
  {
    $playerData = $this->filterByCategory('Alevin', 'DatabaseBundle:PlayerData')->getResult();
    $coachData = $this->filterByCategory('Alevin', 'DatabaseBundle:CoachData')->getResult();
    return $this->render('DatabaseBundle:Teams:showteam.html.twig', array(
                'playerData' => $playerData,
                'coachData' => $coachData,
                'teamName' => 'Alevín'));
  }

  public function showBenjaminAction()
  {
    $playerData = $this->filterByCategory('Benjamin', 'DatabaseBundle:PlayerData')->getResult();
    $coachData = $this->filterByCategory('Benjamin', 'DatabaseBundle:CoachData')->getResult();
    return $this->render('DatabaseBundle:Teams:showteam.html.twig', array(
                'playerData' => $playerData,
                'coachData' => $coachData,
                'teamName' => 'Benjamín'));
  }

  public function showPrebenjaminAction()
  {
    $playerData = $this->filterByCategory('Prebenjamin', 'DatabaseBundle:PlayerData')->getResult();
    $coachData = $this->filterByCategory('Prebenjamin', 'DatabaseBundle:CoachData')->getResult();
    return $this->render('DatabaseBundle:Teams:showteam.html.twig', array(
                'playerData' => $playerData,
                'coachData' => $coachData,
                'teamName' => 'Prebenjamín'));
  }

  private function filterByCategory($name, $tableName)
  {
    $alias = 'aliastable';
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
