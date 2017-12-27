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

    public function getSeason($id)
    {
        $em = $this->seasonController->getDoctrine()->getManager();
        $season = $em->getRepository('DatabaseBundle:Season')->find($id);
        return $season;
    }

    public function getSeasonByText($season)
    {
        $repository = $this->seasonController
            ->getDoctrine()
            ->getRepository('DatabaseBundle:Season');
        return $repository->getIdFromText($season->getSeasontext());
    }

    public function deleteSeason($id)
    {
        $em = $this->seasonController->getDoctrine()->getManager();
        $season = $em->getRepository('DatabaseBundle:Season')
            ->find($id);
        $em->remove($season);
        $em->flush();
        return true;
    }

    public function getDefaultSeason()
    {
        $repository = $this->seasonController
            ->getDoctrine()
            ->getRepository('DatabaseBundle:Season');
        return $repository->getDefaultSeason();
    }

    public function setAsNotDefault($season)
    {
        $season->setDefaultseason(false);  
        $this->saveSeason($season);
    }

    public function countSeasons()
    {
        $repository = $this->seasonController
            ->getDoctrine()
            ->getRepository('DatabaseBundle:Season');
        return $repository->countSeasons();
    }
}
?>
