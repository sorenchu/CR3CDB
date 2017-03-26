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
  private $season;

  public function __construct()
  {
    $this->teamQueries = new ShowTeamQueries($this);
  }

  public function showSeniorAction(Request $request)
  {
    return $this->showSeniorTeam('senior', $request);
  }

  public function showFemaleAction(Request $request)
  {
    return $this->showSeniorTeam('femenino', $request);
  }

  public function showCadeteAction(Request $request)
  {
    return $this->showJuniorTeam('cadete', $request);
  }

  public function showAlevinAction(Request $request)
  {
    return $this->showJuniorTeam('alevina', $request);
  }

  public function showBenjaminAction(Request $request)
  {
    return $this->showJuniorTeam('benjamin', $request);
  }

  public function showPrebenjaminAction(Request $request)
  {
    return $this->showJuniorTeam('prebenjamin', $request);
  }

  private function showSeniorTeam($specificTeam, $request)
  {
    // TODO: make this call configurable by user
    $this->season = $this->teamQueries->getSeasonById(1);
    $seasonForm = $this->createForm(new SeasonType);
    $seasonForm->handleRequest($request);
    $season = $seasonForm->get('season')->getData();
    if ($season != NULL)
    {
      $this->season = $season;
    }

    $playerData = $this->teamQueries
                    ->getByCategory($specificTeam, 'DatabaseBundle:PlayerData', $this->season->getId());
    $coachData = $this->teamQueries
                    ->getByCategory($specificTeam, 'DatabaseBundle:CoachData', $this->season->getId());
    return $this->render('DatabaseBundle:teams:showteam.html.twig', array(
                'playerData' => $playerData,
                'coachData' => $coachData,
                'seasonForm' => $seasonForm->createView(),
                'teamName' => $specificTeam));
  }

  private function showJuniorTeam($specificTeam, $request)
  {
    // TODO: make this call configurable by user
    $this->season = $this->teamQueries->getSeasonById(1);
    $seasonForm = $this->createForm(new SeasonType);
    $seasonForm->handleRequest($request);
    $season = $seasonForm->get('season')->getData();
    if ($season != NULL)
    {
      $this->season = $season;
    }

    $playerData = $this->teamQueries
                    ->getByCategory($specificTeam, 'DatabaseBundle:PlayerData', $this->season->getId());
    $coachData = $this->teamQueries
                    ->getByCategory($specificTeam, 'DatabaseBundle:CoachData', $this->season->getId());
    return $this->render('DatabaseBundle:teams:showyoungteam.html.twig', array(
                'playerData' => $playerData,
                'coachData' => $coachData,
                'seasonForm' => $seasonForm->createView(),
                'teamName' => $specificTeam));
  }
}
?>
