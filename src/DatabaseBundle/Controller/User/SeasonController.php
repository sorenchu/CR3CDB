<?php
# src/DatabaseBundle/Controller/User/SeasonController.php
namespace DatabaseBundle\Controller\User;

use DatabaseBundle\Entity\Season;
use DatabaseBundle\Form\Season\AddSeasonType;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

class SeasonController extends Controller
{
    public function showSeasonsAction()
    {
        $entityManager = $this->getDoctrine()->getManager();
        $seasons = $entityManager->getRepository(Season::class)->findAll();
        return $this->render('DatabaseBundle:season:showseasons.html.twig', array(
                    'seasons' => $seasons));
    }

    public function addSeasonAction(Request $request) 
    {
        $season = new Season();  
        $seasonForm = $this->createForm(new AddSeasonType(), $season);
        $seasonForm->handleRequest($request);
        $error = false;

        $entityManager = $this->getDoctrine()->getManager();
        if ($entityManager->getRepository(Season::class)->countSeasons() == 0) {
            $season->setDefaultseason(true);
        } else if ($season->getDefaultseason()) {
            $currentDefaultSeason = $entityManager->getDefaultSeason();
            $entityManager->getRepository(Season::class)->setAsNotDefault($currentDefaultSeason);
        }

        if ($seasonForm->isSubmitted()) {
            $seasonText = $this->getSeasonTextFormatted($season);
            $season->setSeasontext($seasonText);
            $entityManager->persist($season);
            $entityManager->flush();
        }
        return $this->render('DatabaseBundle:season:new.html.twig', array(
                    'seasonForm' => $seasonForm->createView(),
                    'edit' => false,
                    'error' => false,
                    ));
    }

    public function deleteSeasonAction($id) 
    {
        $entityManager = $this->getDoctrine()->getManager();
        if ($id == $entityManager->getRepository(Season::class)->getDefaultSeason()->getId()) {
            $deleted = false;
        } else {
            $deleted = $this->deleteSeason($id);
        }
        $seasons = $entityManager->getRepository(Season::class)->findAll();
        return $this->render('DatabaseBundle:season:showseasons.html.twig', array(
                    'seasons' => $seasons,
                    'deleted' => $deleted));
    }

    public function editSeasonAction($id, Request $request) 
    {
        $entityManager = $this->getDoctrine()->getManager();
        $season = $entityManager->getRepository(Season::class)->find($id);
        $seasonForm = $this->createForm(new AddSeasonType(), $season);
        $seasonForm->handleRequest($request);
        $error = false;

        $entityManager = $this->getDoctrine()->getManager();
        $currentDefaultSeason = $entityManager->getRepository(Season::class)->getDefaultSeason();
        if ($entityManager->getRepository(Season::class)->countSeasons() == 1) {
            $season->setDefaultseason(true);
        } else if ($season->getDefaultseason() and $season != $currentDefaultSeason) {
            $entityManager->getRepository(Season::class)->setAsNotDefault($currentDefaultSeason);
            $entityManager->persist($currentDefaultSeason);
        } else if ($currentDefaultSeason->getSeasonText() === $season->getSeasonText()
                    and !$season->getDefaultseason()) {
                $error = true;
                $season->setDefaultseason(true);
        }

        if ($seasonForm->isSubmitted()) {
            $seasonText = $this->getSeasonTextFormatted($season);
            $season->setSeasontext($seasonText);
            $entityManager->persist($season);
            $entityManager->flush();
        }
        return $this->render('DatabaseBundle:season:new.html.twig', array(
                    'seasonForm' => $seasonForm->createView(),
                    'edit' => true,
                    'error' => $error,
                    ));
    }

    private function getSeasonTextFormatted($season)
    {
        $firstYear = $season->getStartingyear();
        $secondYear = $season->getStartingyear()+1;
        return $firstYear.'/'.$secondYear;
    }

    private function deleteSeason($id)
    {
        $em = $this->getDoctrine()->getManager();
        $season = $em->getRepository('DatabaseBundle:Season')
            ->find($id);
        $em->remove($season);
        $em->flush();
    }
}
?>
