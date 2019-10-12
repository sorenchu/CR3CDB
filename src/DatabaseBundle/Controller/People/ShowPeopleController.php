<?php
# src/DatabaseBundle/Controller/People/ShowPlayer.php

namespace DatabaseBundle\Controller\People;

use DatabaseBundle\Controller\DBQuery\ShowTeamQueries;
use DatabaseBundle\Controller\Paginator\Paginator;
use DatabaseBundle\Form\Season\SeasonType;
use DatabaseBundle\Entity\PersonalData;
use DatabaseBundle\Entity\Season;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

class ShowPeopleController extends Controller
{
    private $teamQueries;
    private $season;

    public function __construct()
    {
        $this->teamQueries = new ShowTeamQueries($this);
    }

    public function showAllAction($page=1)
    {
        $entityManager = $this->getDoctrine()->getManager();
        $personalData = $entityManager->getRepository(PersonalData::class)
                ->getAll($page);
        $counting = count($personalData['paginator'])/20;
        $counting = round($counting)+1;
        return $this->render('DatabaseBundle:people:showall.html.twig', array(
                    'personalData' => $personalData['paginator'],
                    'season' => $entityManager->getRepository(Season::class)->getDefaultSeason(),
                    'counting' => $counting));
    }

    public function showParentsAction(Request $request)
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
            $parentData = $this->teamQueries->getParents($this->season->getId());
            return $this->render('DatabaseBundle:people:showparents.html.twig', array(
                        'parentData' => $parentData,
                        'seasonForm' => $seasonForm->createView(),
                        'seasonNumber' => $seasonNumber,
                        'season' => $this->season,
                        ));
        } else {
            return $this->render('DatabaseBundle:people:showparents.html.twig', array(
                        'seasonNumber' => $seasonNumber
                        ));
        }
    }

    public function showMembersAction(Request $request)
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
            $memberData = $this->teamQueries->getMembers($this->season->getId());
            return $this->render('DatabaseBundle:people:showmembers.html.twig', array(
                        'memberData' => $memberData,
                        'seasonForm' => $seasonForm->createView(),
                        'seasonNumber' => $seasonNumber,
                        'season' => $this->season,
                        ));
        } else {
            return $this->render('DatabaseBundle:people:showmembers.html.twig', array(
                        'seasonNumber' => $seasonNumber,
                        ));
        }
    }
}
?>
