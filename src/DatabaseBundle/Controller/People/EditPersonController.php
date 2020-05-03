<?php
# src/DatabaseBundle/Controller/People/EditPersonController.php

namespace DatabaseBundle\Controller\People;

use DatabaseBundle\Form\Person\PersonalDataType;
use DatabaseBundle\Form\Season\SeasonType;
use DatabaseBundle\Form\Journal\JournalType;

use DatabaseBundle\Entity\PlayerPerson;
use DatabaseBundle\Entity\CoachPerson;
use DatabaseBundle\Entity\ParentData;
use DatabaseBundle\Entity\ParentPerson;
use DatabaseBundle\Entity\MemberPerson;
use DatabaseBundle\Entity\ContactData;
use DatabaseBundle\Entity\PersonalData;
use DatabaseBundle\Entity\Pay;
use DatabaseBundle\Entity\Season;
use DatabaseBundle\Entity\Payment;
use DatabaseBundle\Entity\PaymentHistory;
use DatabaseBundle\Entity\ActivePayment;
use DatabaseBundle\Entity\Journal;

use DatabaseBundle\Controller\People\Subentities\PlayerInfo;
use DatabaseBundle\Controller\People\Subentities\MemberInfo;
use DatabaseBundle\Controller\People\Subentities\CoachInfo;
use DatabaseBundle\Controller\People\Subentities\ParentInfo;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;

use Symfony\Component\Translation\Translator;
use Symfony\Component\Translation\Loader\ArrayLoader;

class EditPersonController extends Controller {

    private $entityManager;
    private $season;
    private $personalData;
    private $playerData;
    private $memberData;

    function editPersonAction($id, $seasonId=null, Request $request) {
        $this->entityManager = $this->getDoctrine()->getManager();
        $this->season = $this->entityManager->getRepository(Season::class)->find($seasonId);
        $seasonForm = $this->createForm(SeasonType::class, $this->season);
        $response = $this->changingSeasonForm($id, $request);
        if ($response instanceof \Symfony\Component\HttpFoundation\RedirectResponse) {
            return $response;
        }
        $this->personalData = $this->entityManager->getRepository(PersonalData::class)->find($id);
        $personalDataForm = $this->createForm(PersonalDataType::class, $this->personalData);
        $this->setContactData($id);
        $this->setPersonInfo($id);
        $personalDataForm = $this->createForm(PersonalDataType::class, $this->personalData);
        $personalDataForm->handleRequest($request);
        if ($personalDataForm->isSubmitted()) {
            if($this->playerData) {
                $pay = $this->playerData->getPay();
                $this->addPayment($pay, $personalDataForm, 'player');
                $this->removePayment($pay, $personalDataForm, $this->season);
            }
            if($this->memberData) {
                $payMember = $this->memberData->getPay();
                $this->addPayment($payMember, $personalDataForm, 'member');
                $this->removePayment($payMember, $personalDataForm);
            }
            $seasonForm = $this->createForm(SeasonType::class, $this->season);
            $this->entityManager->getRepository(PersonalData::class)->savePerson($this->personalData, true);
            $personalDataForm = $this->createForm(PersonalDataType::class, $this->personalData);
        }

        $journal = new Journal();
        $journalForm = $this->createForm(JournalType::class, $journal);
        $journalForm->handleRequest($request);
        if ($journalForm->isSubmitted()) {
            $position = $journalForm->get('position')->getData();
            $this->addJournal($position, $journal);
            $journal = new Journal();
            $journalForm = $this->createForm(JournalType::class, $journal);
        }
        $journalForms = [];
        foreach ($this->personalData->getJournalEntriesBySeason($this->season) as $j) {
            $journalForms[] = $this->createForm(JournalType::class, $j);
        }

        return $this->render('DatabaseBundle:person:editperson.html.twig',
                    [
                        'personalDataForm' => $personalDataForm->createView(),
                        'seasonForm' => $seasonForm->createView(),
                        'personalData' => $this->personalData,
                        'curSeason' => $this->season,
                        'isPlayerBank' => $this->getBank('player', $personalDataForm),
                        'isMemberBank' => $this->getBank('member', $personalDataForm),
                        'underage' => $this->isUnderage(
                            $this->personalData->getPlayerDataBySeason(
                                $this->season)
                        ),
                        'journalForm' => $journalForm->createView(),
                        'journalForms' => $journalForms,
                        'journalLength' => sizeof($journalForms),
                    ]
        );
    }

    private function setContactData(int $id) {
        $contactData = $this->entityManager->
                getRepository(ContactData::class)->getContactData($id);
        if ($contactData) {
            $contactData->setPersonalData($this->personalData);
        }
    }

    private function getBank($data, $personalDataForm) {
        $bank = 'false';
        foreach($personalDataForm->get($data.'Person') as $subForm) {
            $formData = $this->getFormDataArray($subForm);
            if (isset($formData[$data.'Data'])) {
                $playerData = $this->getFormDataArray($subForm)[$data.'Data'];
                if ($playerData->getSeason() == $this->season) {
                    $data = $playerData->getPay();
                    if ($data && $data->getWayOfPayment() == 'bank') {
                        $bank = 'true';
                    }
                }
            }
        }
        return $bank;
    }

    private function removePayment($pay, $personalDataForm) {
        $payments = $pay->getPayment();
        $repository = $this->entityManager->getRepository(\DatabaseBundle\Entity\Payment::class);
        $dbPayments = $repository->getPaymentsByPay($pay->getId());
        if ($payments->count() == sizeof($dbPayments)) {
            return;
        }
        foreach($payments as $payment) {
            foreach($dbPayments as $dbP) {
                if(!$payments->contains($dbP)) {
                    $pay->removePayment($dbP);
                    $repository->removePayment($dbP);
                }
            }
        }
    }

    private function getFormDataArray($form) {
        $data = [];
        foreach($form as $key => $value) {
            $data[$key] = $value->getData();
        }
        return $data;
    }

    private function isUnderage($playerData) {
        if (
            !$playerData
                || $playerData->getCategory() == 'senior'
                || $playerData->getCategory() == 'female'
            ) {
            return 'false';
        }
        return 'true';
    }

    private function addJournal($position, $journal)
    {
        $currentEntries = $this->personalData->getJournalEntriesBySeason($this->season);
        $lastEntry = sizeof($currentEntries)-1;

        if (is_null($position)) {
            $editingJournal = $journal;
            $this->personalData->addJournal($editingJournal);
            $this->season->addJournal($editingJournal);
        } else {
            $editingJournal = $this->personalData->getJournalEntryByPosition($position, $this->season);
            $editingJournal->setTitle($journal->getTitle());
            $editingJournal->setText($journal->getText());
        }

        $editingJournal->setPersonalData($this->personalData);
        $editingJournal->setSeason($this->season);
        $editingJournal->setDate(new \DateTime());
        if ($lastEntry < 1) {
            $editingJournal->setPosition(1);
        } else {
            $editingJournal->setPosition($currentEntries[$lastEntry]->getPosition()+1);
        }
        $this->entityManager->persist($editingJournal);
        $this->entityManager->flush();
    }

    private function addPayment($pay, $personalDataForm, $childEntity) {
        if ($pay->getActivePayment() === null) {
            return;
        }
        foreach($personalDataForm->get($childEntity.'Person') as $subForm) {
            $playerData = $this->getFormDataArray($subForm)[$childEntity.'Data'];
            foreach ($playerData->getPay()->getActivePayment() as $activePayment) {
                if (!$activePayment->getPay()) {
                    $history = new PaymentHistory();
                    $activePayment->setPay($pay);
                    $pm = ($activePayment->getPayment()) ?? new Payment();
                    $activePayment->setPayment($pm);
                    $pm->setPay($pay);
                    $history->addPayment($pm);
                    $pm->setPaymentHistory($history);
                    $pm->setActivePayment($activePayment);
                } else {
                    $pm = $activePayment->getPayment();
                    $originalData = $this->entityManager->getUnitOfWork()->getOriginalEntityData($pm);
                    if (!$pm->compareWithArray($originalData)) {
                        $originalPayment = new Payment();
                        $originalPayment->setPay(
                            $pm->getPay());
                        $originalPayment->setPaymentHistory(
                            $pm->getPaymentHistory());
                        $originalPayment->setPaymentDate(
                            $originalData['paymentDate']);
                        $originalPayment->setAmountPayed(
                            $originalData['amountPayed']);
                        $originalPayment->setStatus(
                            $originalData['status']);
                        $originalPayment->setPay($pay);
                        $pay->addPayment($originalPayment);
                        $pm->setPay($pay);
                    }
                }
            }
        }
    }

    private function changingSeasonForm(int $id, Request $request) {
        $response = $this->forward(
            'DatabaseBundle\Controller\Season\SeasonController::handleForm',
            [
                'id' => $id,
                'path' => 'edit_person',
                'season' => $this->season,
                'request' => $request
            ]
        );
        return $response;
    }

    private function setPersonInfo(int $id) {
        $playerPerson = $this->entityManager->getRepository(PlayerPerson::class)
                            ->getPlayerPerson($id, $this->season);
        $this->playerData = new PlayerInfo(
            $this->personalData,
            $playerPerson,
            $this->season,
            $this->entityManager
        );
        $coachPerson = $this->entityManager->getRepository(CoachPerson::class)
                            ->getCoachPerson($id, $this->season);
        $coachData = new CoachInfo(
            $this->personalData,
            $coachPerson,
            $this->season
        );
        $memberPerson = $this->entityManager->getRepository(MemberPerson::class)
                            ->getMemberPerson($id, $this->season);
        $this->memberData = new MemberInfo(
            $this->personalData,
            $memberPerson,
            $this->season,
            $this->entityManager
        );
        $parentPerson = $this->entityManager->getRepository(ParentPerson::class)
                            ->getParentPerson($id, $this->season);
        $parentData = new ParentInfo(
            $this->personalData,
            $parentPerson,
            $this->season
        );
    }
}
