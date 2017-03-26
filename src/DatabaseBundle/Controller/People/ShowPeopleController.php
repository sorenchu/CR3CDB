<?php
# src/DatabaseBundle/Controller/People/ShowPlayer.php

namespace DatabaseBundle\Controller\People;

use DatabaseBundle\Controller\DBQuery\ShowTeamQueries;
use DatabaseBundle\Form\SeasonType;

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

  public function showAllAction()
  {
    $wholePerson = $this->teamQueries->getAllMembers();
    return $this->render('DatabaseBundle:people:showall.html.twig', array(
                'personalData' => $wholePerson));
  }

  public function showPlayersAction()
  {
    $playerData = $this->teamQueries->getPlayers();
    return $this->render('DatabaseBundle:people:showplayers.html.twig', array(
                'playerData' => $playerData));
  }

  public function showParentsAction(Request $request)
  {
    $this->season = $this->teamQueries->getSeasonById(1);
    $seasonForm = $this->createForm(new SeasonType);
    $seasonForm->handleRequest($request);
    $season = $seasonForm->get('season')->getData();
    if ($season != NULL)
    {
      $this->season = $season;
    }  

    $parentData = $this->teamQueries->getParents($this->season->getId());
    return $this->render('DatabaseBundle:people:showparents.html.twig', array(
                'parentData' => $parentData,
                'seasonForm' => $seasonForm->createView(),
            ));
  }

  public function showMembersAction(Request $request)
  {
    $this->season = $this->teamQueries->getSeasonById(1);
    $seasonForm = $this->createForm(new SeasonType);
    $seasonForm->handleRequest($request);
    $season = $seasonForm->get('season')->getData();
    if ($season != NULL)
    {
      $this->season = $season;
    }  
  
    $memberData = $this->teamQueries->getMembers($this->season->getId());
    return $this->render('DatabaseBundle:people:showmembers.html.twig', array(
                'memberData' => $memberData,
                'seasonForm' => $seasonForm->createView(),
            ));
  }
}
?>
