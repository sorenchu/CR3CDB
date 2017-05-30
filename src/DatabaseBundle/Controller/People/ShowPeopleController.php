<?php
# src/DatabaseBundle/Controller/People/ShowPlayer.php

namespace DatabaseBundle\Controller\People;

use DatabaseBundle\Controller\DBQuery\ShowTeamQueries;
use DatabaseBundle\Controller\DBQuery\SeasonQueries;
use DatabaseBundle\Form\Season\SeasonType;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

class ShowPeopleController extends Controller
{
  private $teamQueries;
  private $seasonQueries;
  private $season;

  public function __construct()
  {
    $this->teamQueries = new ShowTeamQueries($this);
    $this->seasonQueries = new SeasonQueries($this);
  }

  public function showAllAction()
  {
    $personalData = $this->teamQueries->getAllMembers();
    return $this->render('DatabaseBundle:people:showall.html.twig', array(
                'personalData' => $personalData,
                'season' => $this->seasonQueries->getDefaultSeason()));
  }

  public function showParentsAction(Request $request)
  {
    $seasonForm = $this->createForm(new SeasonType);
    $seasonForm->handleRequest($request);
    $season = $seasonForm->get('season')->getData();
    if ($season != null)
    {
      $this->season = $season;
    }  
    else
    {
      $this->season = $this->seasonQueries->getDefaultSeason();
    }
    if (!$seasonForm->isSubmitted())
      $seasonForm->get('season')->setData($this->season);

    $seasonNumber = $this->seasonQueries->countSeasons();
    if (0 < $seasonNumber)
    {
      $parentData = $this->teamQueries->getParents($this->season->getId());
      return $this->render('DatabaseBundle:people:showparents.html.twig', array(
                  'parentData' => $parentData,
                  'seasonForm' => $seasonForm->createView(),
                  'seasonNumber' => $seasonNumber,
                  'season' => $this->season,
      ));
    }
    else
    {
      return $this->render('DatabaseBundle:people:showparents.html.twig', array(
                  'seasonNumber' => $seasonNumber
      ));
    }
  }

  public function showMembersAction(Request $request)
  {
    $seasonForm = $this->createForm(new SeasonType);
    $seasonForm->handleRequest($request);
    $season = $seasonForm->get('season')->getData();
    if ($season != null)
    {
      $this->season = $season;
    }
    else
    {
      $this->season = $this->seasonQueries->getDefaultSeason();
    } 
    if (!$seasonForm->isSubmitted())
      $seasonForm->get('season')->setData($this->season);
  
    $seasonNumber = $this->seasonQueries->countSeasons();
    if (0 < $seasonNumber)
    {
      $memberData = $this->teamQueries->getMembers($this->season->getId());
      return $this->render('DatabaseBundle:people:showmembers.html.twig', array(
                  'memberData' => $memberData,
                  'seasonForm' => $seasonForm->createView(),
                  'seasonNumber' => $seasonNumber,
                  'season' => $this->season,
      ));
    }
    else
    {
      return $this->render('DatabaseBundle:people:showmembers.html.twig', array(
                  'seasonNumber' => $seasonNumber,
      ));
    }
  }
}
?>
