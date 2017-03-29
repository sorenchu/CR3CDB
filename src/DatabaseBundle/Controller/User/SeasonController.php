<?php

# src/DatabaseBundle/Controller/User/SeasonController.php

namespace DatabaseBundle\Controller\User;

use DatabaseBundle\Entity\Season;
use DatabaseBundle\Form\AddSeasonType;
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

  public function addSeasonAction(Request $request) 
  {
    $season = new Season();  
    $seasonForm = $this->createForm(new AddSeasonType(), $season);
    $seasonForm->handleRequest($request);

    if ($this->seasonQueries->countSeasons() == 0)
    {
      $season->setDefaultseason(true);
    }
    else if ($season->getDefaultseason())
    {
      $currentDefaultSeason = $this->seasonQueries->getDefaultSeason();
      $this->seasonQueries->setAsNotDefault($currentDefaultSeason);
    }

    if ($seasonForm->isSubmitted())
    {
      $seasonText = $this->getSeasonTextFormatted($season);
      $season->setSeasontext($seasonText);
      $this->seasonQueries->saveSeason($season);
      return $this->redirectToRoute('edit_season',
                    array('id' => $this->seasonQueries
                                        ->getSeasonByText($season)->getId()));
    }
    return $this->render('DatabaseBundle:season:new.html.twig', array(
                'seasonForm' => $seasonForm->createView(),
                'edit' => false,
    ));
  }

  public function deleteSeasonAction($id) 
  {
    if ($id == $this->seasonQueries->getDefaultSeason()->getId())
    {
      $deleted = false;
    }
    else 
    {
      $deleted = $this->seasonQueries->deleteSeason($id);
    }
    $seasons = $this->seasonQueries->getAllSeasons();
    return $this->render('DatabaseBundle:season:showseasons.html.twig', array(
                'seasons' => $seasons,
                'deleted' => $deleted));
  }

  public function editSeasonAction($id, Request $request) 
  {
    $season = $this->seasonQueries->getSeason($id);
    $seasonForm = $this->createForm(new AddSeasonType(), $season);
    $seasonForm->handleRequest($request);

    if ($this->seasonQueries->countSeasons() == 1)
    {
      $season->setDefaultseason(true);
    }
    else if ($season->getDefaultseason())
    {
      $currentDefaultSeason = $this->seasonQueries->getDefaultSeason();
      $this->seasonQueries->setAsNotDefault($currentDefaultSeason);
    }

    if ($seasonForm->isSubmitted())
    {
      $seasonText = $this->getSeasonTextFormatted($season);
      $season->setSeasontext($seasonText);
      $this->seasonQueries->saveSeason($season);
    }
    return $this->render('DatabaseBundle:season:new.html.twig', array(
                'seasonForm' => $seasonForm->createView(),
                'edit' => true,
    ));
  }

  private function getSeasonTextFormatted($season)
  {
    $firstYear = $season->getStartingyear();
    $secondYear = $season->getStartingyear()+1;
    return $firstYear.'/'.$secondYear;
  }
}
?>
