<?php
# src/DatabaseBundle/Controller/People/ShowTeams.php

namespace DatabaseBundle\Controller\People;

use DatabaseBundle\Controller\DBQuery\ShowTeamQueries;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

class ShowTeamsController extends Controller
{
  private $teamQueries;

  public function __construct()
  {
    $this->teamQueries = new ShowTeamQueries($this);
  }

  public function showSeniorAction()
  {
    $playerData = $this->teamQueries
                    ->getByCategory('Senior', 'DatabaseBundle:PlayerData');
    $coachData = $this->teamQueries
                    ->getByCategory('Senior', 'DatabaseBundle:CoachData');
    return $this->render('DatabaseBundle:teams:showteam.html.twig', array(
                'playerData' => $playerData,
                'coachData' => $coachData,
                'teamName' => 'Senior'));
  }

  public function showFemaleAction()
  {
    $playerData = $this->teamQueries
                    ->getByCategory('Femenino', 'DatabaseBundle:PlayerData');
    $coachData = $this->teamQueries
                    ->getByCategory('Femenino', 'DatabaseBundle:CoachData');
    return $this->render('DatabaseBundle:teams:showteam.html.twig', array(
                'playerData' => $playerData,
                'coachData' => $coachData,
                'teamName' => 'Femenino'));
  }

  public function showCadeteAction()
  {
    $playerData = $this->teamQueries
                    ->getByCategory('Cadete', 'DatabaseBundle:PlayerData');
    $coachData = $this->teamQueries
                    ->getByCategory('Cadete', 'DatabaseBundle:CoachData');
    return $this->render('DatabaseBundle:teams:showyoungteam.html.twig', array(
                'playerData' => $playerData,
                'coachData' => $coachData,
                'teamName' => 'Cadete'));
  }

  public function showAlevinAction()
  {
    $playerData = $this->teamQueries
                    ->getByCategory('Alevin', 'DatabaseBundle:PlayerData');
    $coachData = $this->teamQueries
                    ->getByCategory('Alevin', 'DatabaseBundle:CoachData');
    return $this->render('DatabaseBundle:teams:showyoungteam.html.twig', array(
                'playerData' => $playerData,
                'coachData' => $coachData,
                'teamName' => 'Alevín'));
  }

  public function showBenjaminAction()
  {
    $playerData = $this->teamQueries
                    ->getByCategory('Benjamin', 'DatabaseBundle:PlayerData');
    $coachData = $this->teamQueries
                    ->getByCategory('Benjamin', 'DatabaseBundle:CoachData');
    return $this->render('DatabaseBundle:teams:showyoungteam.html.twig', array(
                'playerData' => $playerData,
                'coachData' => $coachData,
                'teamName' => 'Benjamín'));
  }

  public function showPrebenjaminAction()
  {
    $playerData = $this->teamQueries
                    ->getByCategory('Prebenjamin', 'DatabaseBundle:PlayerData');
    $coachData = $this->teamQueries
                    ->getByCategory('Prebenjamin', 'DatabaseBundle:CoachData');
    return $this->render('DatabaseBundle:teams:showyoungteam.html.twig', array(
                'playerData' => $playerData,
                'coachData' => $coachData,
                'teamName' => 'Prebenjamín'));
  }
}
?>
