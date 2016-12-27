<?php
# src/DatabaseBundle/Controller/ShowPlayer.php

namespace DatabaseBundle\Controller;

use DatabaseBundle\Controller\DBQuery\ShowTeamQueries;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

class ShowPeopleController extends Controller
{
  private $teamQueries;

  public function __construct()
  {
    $this->teamQueries = new ShowTeamQueries($this);
  }

  public function showAllAction()
  {
    $personalData = $this->teamQueries->getAllMembers();
    return $this->render('DatabaseBundle:Default:showall.html.twig', array(
                'personalData' => $personalData));
  }

  public function showPlayersAction()
  {
    $playerData = $this->teamQueries->getPlayers();
    return $this->render('DatabaseBundle:Default:showplayers.html.twig', array(
                'playerData' => $playerData));
  }

  public function showParentsAction()
  {
    $parentData = $this->teamQueries->getParents();
    return $this->render('DatabaseBundle:Default:showparents.html.twig', array(
                'parentData' => $parentData));
  }

  public function showMembersAction()
  {
    $memberData = $this->teamQueries->getMembers();
    return $this->render('DatabaseBundle:Default:showmembers.html.twig', array(
                'memberData' => $memberData));
  }
}
?>
