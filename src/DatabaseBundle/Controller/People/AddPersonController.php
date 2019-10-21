<?php
# src/DatabaseBundle/Controller/People/AddPersonController.php

namespace DatabaseBundle\Controller\People;

use DatabaseBundle\Entity\PersonalData;
use DatabaseBundle\Entity\ContactData;
use DatabaseBundle\Entity\PlayerData;
use DatabaseBundle\Entity\CoachData;
use DatabaseBundle\Entity\Season;
use DatabaseBundle\Form\Person\PersonalDataType;

use DatabaseBundle\Controller\DBQuery\GetEditionQueries;
use DatabaseBundle\Controller\DBQuery\ShowTeamQueries;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

class AddPersonController extends Controller
{
    private const PLAYER = 0;
    private const COACH = 1;

    private $peopleQueries;

    public function __construct()
    {
        $this->peopleQueries = new GetEditionQueries($this);
    }

    public function newAction(Request $request)
    {
        $entityManager = $this->getDoctrine()->getManager();
        $personalData = new PersonalData();
        $personalDataForm = $this->createForm(PersonalDataType::class, $personalData);
        $personalDataForm->handleRequest($request);

        if($personalDataForm->isSubmitted()) {
            $contactData = $this->setContactData($personalDataForm->get("contactData"));
            $contactData->setPersonalData($personalData);
            $personalData->setContactData($contactData);
        
            $entityManager->getRepository(PersonalData::class)->savePerson($personalData, false);
            return $this->redirectToRoute('edit_person', 
                    array(
                        'id' => $personalData->getId(),
                        'seasonId' => $entityManager->getRepository(Season::class)->getDefaultSeason()->getId(),
                        ));
        }

        return $this->render('DatabaseBundle:person:new.html.twig', array(
                    'personalDataForm' => $personalDataForm->createView(),
                    ));
    }

    public function setContactData($contactDataForm)
    {
        $contactData = new ContactData();
        $contactData->setAddress($this->viewData($contactDataForm["address"]));
        $contactData->setCity($this->viewData($contactDataForm["city"]));
        $contactData->setZipcode($this->viewData($contactDataForm["zipcode"]));
        $contactData->setProvince($this->viewData($contactDataForm["province"]));
        $contactData->setPhone($this->viewData($contactDataForm["phone"]));
        $contactData->setEmail($this->viewData($contactDataForm["email"]));

        return $contactData;
    }

    public function viewData($formSlot) 
    {
        if ($formSlot->getViewData() == "") {
            return NULL;
        }
        return $formSlot->getViewData();
    }

    public function deletePersonAction($id)
    {
        $this->peopleQueries->deletePerson($id);
        $entityManager = $this->getDoctrine()->getManager();
        return $this->render('DatabaseBundle:people:showall.html.twig', array(
                    'personalData' => $entityManager->getRepository(PersonalData::class)->findAll(),
                    'season' => $entityManager->getRepository(Season::class)->getDefaultSeason(),
                    )
                );
    }

    public function deleteFromTeamAction($id, $season, $table)
    {
        $category = $this->getCategoryFromPerson($id, $season, $table);
        $this->deleteFromTeam($id, $season, $table);
        return $this->redirectToTeam($category, $season);
    }

    private function redirectToTeam($category)
    {
        $page = array('page' => 1);
        switch($category)
        {
            case 'senior':
                return $this->redirectToRoute('show_senior',
                        $page
                        );
            case 'femenino':
                return $this->redirectToRoute('show_female',
                        $page
                        );
            case 'cadete':
                return $this->redirectToRoute('show_cadete',
                        $page
                        );
            case 'alevin':
                return $this->redirectToRoute('show_alevin',
                        $page
                        );
            case 'benjamin':
                return $this->redirectToRoute('show_benjamin',
                        $page
                        );
            case 'prebenjamin':
                return $this->redirectToRoute('show_prebenjamin',
                        $page
                        );
            default:
                return $this->redirectToRoute('show_all',
                        $page
                        );
        }
    }

    public function deleteFromTeam($id, $seasonId, $playerOrCoach) {
        $em = $this->getDoctrine()->getManager();
        if ($playerOrCoach == self::PLAYER) {
            $member = $em->getRepository(PlayerData::class)
                ->deleteFromTeam($id, $seasonId);
        } else {
            $member = $em->getRepository(CoachData::class)
                ->deleteFromTeam($id, $seasonId);
        }
        if ($member) {
            $em->remove($member);
            $em->flush();
        }
        $person = $em->getRepository('DatabaseBundle:PersonalData')
            ->find($id);
        $em->getRepository(PersonalData::class)
            ->savePerson($person, true);
    }

    public function deleteFromMemberAction($id, $season)
    {
        $this->peopleQueries->deleteFromMember($id, $season);
        return $this->redirectToRoute('show_members',
                array()
                );
    }

    public function deleteFromParentAction($id, $season)
    {
        $this->peopleQueries->deleteFromParent($id, $season);
        return $this->redirectToRoute('show_parents',
                array()
                );
    }

    private function getCategoryFromPerson($id, $season, $table)
    {
        $entityManager = $this->getDoctrine()->getManager();
        if (0 == $table) {
            $member = $entityManager->getRepository(PlayerData::class)->getCategory($id, $season);
        } else {
            $member = $entityManager->getRepository(CoachData::class)->getCategory($id, $season);
        }
        return $member->getCategory();
    }
}
?>
