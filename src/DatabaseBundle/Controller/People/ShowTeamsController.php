<?php
# src/DatabaseBundle/Controller/People/ShowTeams.php

namespace DatabaseBundle\Controller\People;

use DatabaseBundle\Controller\DBQuery\ShowTeamQueries;
use DatabaseBundle\Form\SeasonType;

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

  public function showSeniorAction(Request $request)
  {
    $seasonForm = $this->createForm(new SeasonType);
    $seasonForm->handleRequest($request);

    // TODO: get season id from here and pass to query
    $season = $seasonForm->get('season')->getData();

    $playerData = $this->teamQueries
                    ->getByCategory('Senior', 'DatabaseBundle:PlayerData');
    $coachData = $this->teamQueries
                    ->getByCategory('Senior', 'DatabaseBundle:CoachData');
    return $this->render('DatabaseBundle:teams:showteam.html.twig', array(
                'playerData' => $playerData,
                'coachData' => $coachData,
                'seasonForm' => $seasonForm->createView(),
                'teamName' => 'Senior'));
  }

  public function showFemaleAction()
  {
    $seasonForm = $this->createForm(new SeasonType);
    $playerData = $this->teamQueries
                    ->getByCategory('Femenino', 'DatabaseBundle:PlayerData');
    $coachData = $this->teamQueries
                    ->getByCategory('Femenino', 'DatabaseBundle:CoachData');
    return $this->render('DatabaseBundle:teams:showteam.html.twig', array(
                'playerData' => $playerData,
                'coachData' => $coachData,
                'seasonForm' => $seasonForm->createView(),
                'teamName' => 'Femenino'));
  }

  public function showCadeteAction()
  {
    $seasonForm = $this->createForm(new SeasonType);
    $playerData = $this->teamQueries
                    ->getByCategory('Cadete', 'DatabaseBundle:PlayerData');
    $coachData = $this->teamQueries
                    ->getByCategory('Cadete', 'DatabaseBundle:CoachData');
    return $this->render('DatabaseBundle:teams:showyoungteam.html.twig', array(
                'playerData' => $playerData,
                'coachData' => $coachData,
                'seasonForm' => $seasonForm->createView(),
                'teamName' => 'Cadete'));
  }

  public function showAlevinAction()
  {
    $seasonForm = $this->createForm(new SeasonType);
    $playerData = $this->teamQueries
                    ->getByCategory('Alevin', 'DatabaseBundle:PlayerData');
    $coachData = $this->teamQueries
                    ->getByCategory('Alevin', 'DatabaseBundle:CoachData');
    return $this->render('DatabaseBundle:teams:showyoungteam.html.twig', array(
                'playerData' => $playerData,
                'coachData' => $coachData,
                'seasonForm' => $seasonForm->createView(),
                'teamName' => 'Alevín'));
  }

  public function showBenjaminAction()
  {
    $seasonForm = $this->createForm(new SeasonType);
    $playerData = $this->teamQueries
                    ->getByCategory('Benjamin', 'DatabaseBundle:PlayerData');
    $coachData = $this->teamQueries
                    ->getByCategory('Benjamin', 'DatabaseBundle:CoachData');
    return $this->render('DatabaseBundle:teams:showyoungteam.html.twig', array(
                'playerData' => $playerData,
                'coachData' => $coachData,
                'seasonForm' => $seasonForm->createView(),
                'teamName' => 'Benjamín'));
  }

  public function showPrebenjaminAction()
  {
    $seasonForm = $this->createForm(new SeasonType);
    $playerData = $this->teamQueries
                    ->getByCategory('Prebenjamin', 'DatabaseBundle:PlayerData');
    $coachData = $this->teamQueries
                    ->getByCategory('Prebenjamin', 'DatabaseBundle:CoachData');
    return $this->render('DatabaseBundle:teams:showyoungteam.html.twig', array(
                'playerData' => $playerData,
                'coachData' => $coachData,
                'seasonForm' => $seasonForm->createView(),
                'teamName' => 'Prebenjamín'));
  }
}
?>
