<?php
# src/DatabaseBundle/Controller/People/ShowTeams.php

namespace DatabaseBundle\Controller\People;

use DatabaseBundle\Controller\DBQuery\ShowTeamQueries;
use DatabaseBundle\Form\Season\SeasonType;
use DatabaseBundle\Entity\Season;
use DatabaseBundle\Entity\PlayerData;
use DatabaseBundle\Entity\CoachData;

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

    public function showSeniorAction($page=1, Request $request)
    {
        return $this->showSeniorTeam('Senior', $page, $request);
    }

    public function showFemaleAction($page=1, Request $request)
    {
        return $this->showSeniorTeam('Femenino', $page, $request);
    }

    public function showSub18Action($page=1, Request $request)
    {
        return $this->showJuniorTeam('Sub18', $page, $request);
    }

    public function showSub16Action($page=1, Request $request)
    {
        return $this->showJuniorTeam('Sub16', $page,  $request);
    }

    public function showSub14Action($page=1, Request $request)
    {
        return $this->showJuniorTeam('Sub14', $page, $request);
    }

    public function showSub12Action($page=1, Request $request)
    {
        return $this->showJuniorTeam('Sub12', $page, $request);
    }

    public function showSub10Action($page=1, Request $request)
    {
        return $this->showJuniorTeam('Sub10', $page, $request);
    }

    public function showSub8Action($page=1, Request $request)
    {
        return $this->showJuniorTeam('Sub8', $page, $request);
    }

    public function showSub6Action($page=1, Request $request)
    {
        return $this->showJuniorTeam('Sub6', $page, $request);
    }

    private function showSeniorTeam($specificTeam, $page, $request)
    {
        $entityManager = $this->getDoctrine()->getManager();
        $seasonForm = $this->createForm(SeasonType::class);
        $seasonForm->handleRequest($request);
        $season = $seasonForm->get('season')->getData();
        if ($season != null) {
            $this->season = $season;
        } else {
            $this->season = $entityManager->getRepository(Season::class)->getDefaultSeason();
        }

        if (!$seasonForm->isSubmitted())
            $seasonForm->get('season')->setData($this->season);

        $seasonNumber = $entityManager->getRepository(Season::class)->countSeasons();
        if (0 < $seasonNumber) {
            $playerData = $entityManager->getRepository(PlayerData::class)
                ->getByCategory($specificTeam, $this->season->getId(), $page);
            $coachData = $entityManager->getRepository(CoachData::class)
                ->getByCategory($specificTeam, $this->season->getId(), 1);
            $counting = (count($playerData['paginator'])+count($coachData['paginator']))/20;
            $counting = round($counting);
            $showCoaches = false;
            if ($counting == $page) {
                $showCoaches = true;
            }
            return $this->render('DatabaseBundle:teams:showteam.html.twig', array(
                        'playerData' => $playerData['paginator'],
                        'coachData' => $coachData['paginator'],
                        'seasonForm' => $seasonForm->createView(),
                        'teamName' => $specificTeam,
                        'seasonNumber' => $seasonNumber,
                        'season' => $this->season,
                        'counting' => $counting,
                        'showCoaches' => $showCoaches,
                        ));
        }
        return $this->render('DatabaseBundle:teams:showteam.html.twig', array(
                    'teamName' => $specificTeam,
                    'seasonNumber' => $seasonNumber));
    }

    private function showJuniorTeam($specificTeam, $page, $request)
    {
        $entityManager = $this->getDoctrine()->getManager();
        $seasonForm = $this->createForm(SeasonType::class);
        $seasonForm->handleRequest($request);
        $season = $seasonForm->get('season')->getData();
        if ($season != null) {
            $this->season = $season;
        } else {
            $this->season = $entityManager->getRepository(Season::class)->getDefaultSeason();
        }
        if (!$seasonForm->isSubmitted())
            $seasonForm->get('season')->setData($this->season);

        $seasonNumber = $entityManager->getRepository(Season::class)->countSeasons();
        if (0 < $seasonNumber) {
            $playerData = $entityManager->getRepository(PlayerData::class)
                ->getByCategory($specificTeam, $this->season->getId(), $page);
            $coachData = $entityManager->getRepository(CoachData::class)
                ->getByCategory($specificTeam, $this->season->getId(), 1);
            $counting = (count($playerData['paginator'])+count($coachData['paginator']))/20;
            $counting = round($counting)+1;
            $showCoaches = false;
            if ($counting == $page) {
                $showCoaches = true;
            }
            return $this->render('DatabaseBundle:teams:showyoungteam.html.twig', array(
                        'playerData' => $playerData['paginator'],
                        'coachData' => $coachData['paginator'],
                        'seasonForm' => $seasonForm->createView(),
                        'teamName' => $specificTeam,
                        'seasonNumber' => $seasonNumber,
                        'season' => $this->season,
                        'counting' => $counting,
                        'showCoaches' => $showCoaches,
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
