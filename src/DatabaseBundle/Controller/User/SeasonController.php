<?php

# src/DatabaseBundle/Controller/User/SeasonController.php

namespace DatabaseBundle\Controller\User;

use DatabaseBundle\Entity\Season;
use DatabaseBundle\Form\NewSeasonType;
use DatabaseBundle\Controller\DBQuery\SeasonQueries;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

class SeasonController extends Controller
{
  private $seasonQueries;

  public function __construct()
  {
    $this->seasonQueries = new SeasonQueries($this);
  }

  public function showSeasonsAction()
  {
    $seasons = $this->seasonQueries->getAllSeasons();
    return $this->render('DatabaseBundle:season:showseasons.html.twig', array(
                'seasons' => $seasons));
  }

  public function addSeasonAction() 
  {

  }

  public function deleteSeasonAction() 
  {

  }

  public function editSeasonAction() 
  {

  }
}
?>
