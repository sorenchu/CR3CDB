<?php 
# src/DatabaseBundle/Controller/DBQuery/SeasonQueries.php

namespace DatabaseBundle\Controller\DBQuery;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class SeasonQueries extends Controller
{
  private $seasonController;

  public function __construct($seasonController)
  {
    $this->seasonController = $seasonController;
  }

  public function saveSeason($season)
  {
    $em = $this->seasonController->getDoctrine()->getManager();
    $em->persist($season);
    $em->flush(); 
  }

  public function getAllSeasons()
  {
    return $this->seasonController
              ->getDoctrine()
                ->getRepository('DatabaseBundle:Season')
                  ->findAll(); 
  }

}
?>
