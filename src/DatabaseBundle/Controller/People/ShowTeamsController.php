<?php
# src/DatabaseBundle/Controller/People/ShowTeams.php

namespace DatabaseBundle\Controller\People;

use DatabaseBundle\Controller\DBQuery\ShowTeamQueries;
use DatabaseBundle\Controller\DBQuery\SeasonQueries;
use DatabaseBundle\Form\Season\SeasonType;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

class ShowTeamsController extends Controller
{
    private $teamQueries;
    private $seasonQueries;
    private $season;

    public function __construct()
    {
        $this->teamQueries = new ShowTeamQueries($this);
        $this->seasonQueries = new SeasonQueries($this);
    }

    public function showSeniorAction(Request $request)
    {
        return $this->showSeniorTeam('senior', $request);
    }

    public function showFemaleAction(Request $request)
    {
        return $this->showSeniorTeam('femenino', $request);
    }

    public function showSub18Action(Request $request)
    {
        return $this->showJuniorTeam('sub18', $request);
    }

    public function showSub16Action(Request $request)
    {
        return $this->showJuniorTeam('sub16', $request);
    }

    public function showSub14Action(Request $request)
    {
        return $this->showJuniorTeam('sub14', $request);
    }

    public function showSub12Action(Request $request)
    {
        return $this->showJuniorTeam('sub12', $request);
    }

    public function showSub10Action(Request $request)
    {
        return $this->showJuniorTeam('sub10', $request);
    }

    public function showSub8Action(Request $request)
    {
        return $this->showJuniorTeam('sub8', $request);
    }

    public function showSub6Action(Request $request)
    {
        return $this->showJuniorTeam('sub6', $request);
    }

    private function showSeniorTeam($specificTeam, $request)
    {
        $seasonForm = $this->createForm(new SeasonType());
        $seasonForm->handleRequest($request);
        $season = $seasonForm->get('season')->getData();
        if ($season != null) {
            $this->season = $season;
        } else {
            $this->season = $this->seasonQueries->getDefaultSeason();
        }

        if (!$seasonForm->isSubmitted())
            $seasonForm->get('season')->setData($this->season);

        $seasonNumber = $this->seasonQueries->countSeasons();
        if (0 < $seasonNumber) {
            $playerData = $this->teamQueries
                ->getByCategory($specificTeam, 'DatabaseBundle:PlayerData', $this->season->getId());
            $coachData = $this->teamQueries
                ->getByCategory($specificTeam, 'DatabaseBundle:CoachData', $this->season->getId());
            return $this->render('DatabaseBundle:teams:showteam.html.twig', array(
                        'playerData' => $playerData,
                        'coachData' => $coachData,
                        'seasonForm' => $seasonForm->createView(),
                        'teamName' => $specificTeam,
                        'seasonNumber' => $seasonNumber,
                        'season' => $this->season,
                        ));
        }
        return $this->render('DatabaseBundle:teams:showteam.html.twig', array(
                    'teamName' => $specificTeam,
                    'seasonNumber' => $seasonNumber));
    }

    private function showJuniorTeam($specificTeam, $request)
    {
        $seasonForm = $this->createForm(new SeasonType);
        $seasonForm->handleRequest($request);
        $season = $seasonForm->get('season')->getData();
        if ($season != null) {
            $this->season = $season;
        } else {
            $this->season = $this->seasonQueries->getDefaultSeason();
        }
        if (!$seasonForm->isSubmitted())
            $seasonForm->get('season')->setData($this->season);

        $seasonNumber = $this->seasonQueries->countSeasons();
        if (0 < $seasonNumber) {
            $playerData = $this->teamQueries
                ->getByCategory($specificTeam, 'DatabaseBundle:PlayerData', $this->season->getId());
            $coachData = $this->teamQueries
                ->getByCategory($specificTeam, 'DatabaseBundle:CoachData', $this->season->getId());
            return $this->render('DatabaseBundle:teams:showyoungteam.html.twig', array(
                        'playerData' => $playerData,
                        'coachData' => $coachData,
                        'seasonForm' => $seasonForm->createView(),
                        'teamName' => $specificTeam,
                        'seasonNumber' => $seasonNumber,
                        'season' => $this->season,
                        ));
        } else {
            return $this->render('DatabaseBundle:teams:showyoungteam.html.twig', array(
                        'seasonForm' => $seasonForm->createView(),
                        'teamName' => $specificTeam,
                        'seasonNumber' => $seasonNumber));
        }
    }
}
?>
