<?php

# src/DatabaseBundle/Controller/Journal/JournalController.php

namespace DatabaseBundle\Controller\Journal;

use DatabaseBundle\Form\Journal\JournalType;
use DatabaseBundle\Form\Season\SeasonType;

use DatabaseBundle\Entity\PersonalData;
use DatabaseBundle\Entity\Season;
use DatabaseBundle\Entity\Journal;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class JournalController extends Controller
{
    private $entityManager;

    public function addEntryAction($id, $seasonId, Request $request) {
        $this->entityManager = $this->getDoctrine()->getManager();
        $personalData = $this->entityManager->getRepository(PersonalData::class)->find($id);
        $season = $this->entityManager->getRepository(Season::class)->find($seasonId);
        $response = $this->forward(
            'DatabaseBundle\Controller\Season\SeasonController::handleForm',
            [
                'id' => $id,
                'path' => 'add_entry',
                'season' => $season,
                'request' => $request
            ]
        );
        if ($response instanceof \Symfony\Component\HttpFoundation\RedirectResponse) {
            return $response;
        }

        $journal = new Journal();
        $journalForm = $this->createForm(JournalType::class, $journal);
        $journalForm->handleRequest($request);
        if ($journalForm->isSubmitted()) {
            $journal->setDate(new \DateTime());
            $personalData->addJournal($journal);
            $journal->setPersonalData($personalData);
            $season->addJournal($journal);
            $journal->setSeason($season);
            $this->entityManager->getRepository(PersonalData::class)->savePerson($personalData, true);
            $this->entityManager->flush();
            $journalForm = $this->createForm(JournalType::class, $journal);
        }
        return $this->render('DatabaseBundle:journal:addentry.html.twig', array(
            'journalForm' => $journalForm->createView(),
        ));
    }

    public function showJournalEntriesAction($id, $seasonId)
    {
        $this->entityManager = $this->getDoctrine()->getManager();
        $personalData = $this->entityManager->getRepository(PersonalData::class)->find($id);
        return $this->render('DatabaseBundle:journal:showentries.html.twig', array(
            'personalData' => $personalData,
        ));
    }

    public function deleteEntryAction($id)
    {
        $this->entityManager = $this->getDoctrine()->getManager();
        $entryData = $this->entityManager->getRepository('DatabaseBundle:Journal')
            ->find($id);
        $this->entityManager->remove($entryData);
        $this->entityManager->flush();
        return $this->redirectToRoute(
            'edit_person',
            [
                'id' => $entryData->getPersonalData()->getId(),
                'seasonId' => $entryData->getSeason()->getId()
            ]
        );
    }
}
