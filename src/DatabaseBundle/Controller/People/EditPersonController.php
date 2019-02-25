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

use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;

use Symfony\Component\Translation\Translator;
use Symfony\Component\Translation\Loader\ArrayLoader;

class EditPersonController extends Controller
{
    private $entityManager;
    private $season;
    private $personalData;

    public function editPersonAction($id, $seasonId=null, Request $request)
    {
        $playerData = NULL;
        $bank = 'false';
        $underage = 'false';
        $playerPayments = NULL;

        $this->entityManager = $this->getDoctrine()->getManager();
        $this->season = $this->entityManager->getRepository(Season::class)->find($seasonId);
        $seasonForm = $this->createForm(SeasonType::class, $this->season);
        $seasonForm->handleRequest($request);
        if ($seasonForm->isSubmitted()) {
            return $this->redirectToRoute('edit_person',
                    array('id' => $id,
                        'seasonId' => $seasonForm->get('season')
                        ->getData()->getId()
                        ));
        }

        $this->personalData = $this->entityManager->getRepository(PersonalData::class)->find($id);
        $contactData = $this->entityManager->getRepository(ContactData::class)->getContactData($id);
        if ($contactData) {
            $contactData->setPersonalData($this->personalData);
        }

        $playerPerson = $this->entityManager->getRepository(PlayerPerson::class)->getPlayerPerson($id, $this->season);
        if ($playerPerson == NULL) {
            $playerPerson = new PlayerPerson();
            $playerPerson->setIsPlayer(false);
            $handlingData = new HandlingData($this, "player");
            $playerData = $handlingData->getChildData();
            $playerData->setPersonalData($this->personalData);
            $playerData->setSeason($this->season);
            $playerData->setPlayerPerson($playerPerson);
            $playerPerson->setPersonalData($this->personalData);
            $this->personalData->addPlayerPerson($playerPerson);
            $playerData->setCategoryBySeason($this->season);

            $pay = $this->entityManager->getRepository(Pay::class)->getPay($playerData->getId());
            if ($pay == NULL) {
                $pay = new Pay();
            }
            $playerData->setPay($pay);
            $pay->setPlayerData($playerData);

            $playerPerson->setPlayerData($playerData);
            $this->personalData->addPlayerDatum($playerData);
        } else {
            $playerData = $playerPerson->getPlayerData();
            $pay = $this->entityManager->getRepository(Pay::class)->getPay($playerData->getId());
            if ($pay == NULL) {
                $pay = new Pay();
                $playerData->setPay($pay);
                $pay->setPlayerData($playerData);
            }
            $playerData->setCategoryBySeason($this->season);
            $playerPayments = $this->entityManager->getRepository(Payment::class)
                                ->getPaymentsByPay($playerData->getPay()->getId());
        }

        $coachPerson = $this->entityManager->getRepository(CoachPerson::class)->getCoachPerson($id, $this->season);
        if ($coachPerson == NULL) {
            $coachPerson = new CoachPerson();
            $coachPerson->setIsCoach(false);
            $handlingData = new HandlingData($this, "coach");
            $coachData = $handlingData->getChildData();
            $coachData->setPersonalData($this->personalData);
            $coachData->setSeason($this->season);
            $coachData->setCoachPerson($coachPerson);
            $coachPerson->setCoachData($coachData);
            $coachPerson->setPersonalData($this->personalData);
            $this->personalData->addCoachPerson($coachPerson);
            $this->personalData->addCoachDatum($coachData);
        }

        $memberPerson = $this->entityManager->getRepository(MemberPerson::class)->getMemberPerson($id, $this->season);
        if ($memberPerson == NULL) {
            $memberPerson = new MemberPerson();
            $memberPerson->setIsMember(false);
            $handlingData = new HandlingData($this, "member");
            $memberData = $handlingData->getChildData();
            $memberData->setPersonalData($this->personalData);
            $memberData->setSeason($this->season);
            $memberData->setMemberPerson($memberPerson);
            $memberPerson->setMemberData($memberData);
            $memberPerson->setPersonalData($this->personalData);
            $this->personalData->addMemberPerson($memberPerson);
            $this->personalData->addMemberDatum($memberData);

            $payMember = $this->entityManager->getRepository(Pay::class)->getPay($memberData->getId());
            if ($payMember == NULL) {
                $payMember = new Pay();
            }
            $memberData->setPay($payMember);
            $payMember->setMemberData($memberData);

            $memberPerson->setMemberData($memberData);
            $this->personalData->addMemberDatum($memberData);
        } else {
            $memberData = $memberPerson->getMemberData();
        }

        $parentPerson = $this->entityManager->getRepository(ParentPerson::class)->getParentPerson($id, $this->season);
        if ($parentPerson == NULL) {
            $parentPerson = new ParentPerson();
            $parentPerson->setIsParent(false);
            $handlingData = new HandlingData($this, "parent");
            $parentData = $handlingData->getChildData();
            $parentData->setPersonalData($this->personalData);
            $parentData->setSeason($this->season);
            $parentData->setParentPerson($parentPerson);
            $parentPerson->setParentData($parentData);
            $parentPerson->setPersonalData($this->personalData);
            $this->personalData->addParentPerson($parentPerson);
            $this->personalData->addParentDatum($parentData);
        }

        $personalDataForm = $this->createForm(PersonalDataType::class, $this->personalData);
        $personalDataForm->handleRequest($request);
        $playerBank = $this->getBank("playerData", $personalDataForm);
        $memberBank = $this->getBank("memberData", $personalDataForm);
        $underage = $this->isUnderage($this->personalData->getPlayerDataBySeason($this->season));
        if ($personalDataForm->isSubmitted()) {
            if($playerData) {
                $pay = $playerData->getPay();
                $this->addPayment($pay, $personalDataForm, "playerData");
                $this->removePayment($pay, $personalDataForm, $this->season);
            }
            if($memberData) {
                $payMember = $memberData->getPay();
                $this->addPayment($payMember, $personalDataForm, "memberData");
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

        $journalForms = array();
        foreach ($this->personalData->getJournalEntriesBySeason($this->season) as $j) {
            $journalForms[] = $this->createForm(JournalType::class, $j);
        }

        return $this->render('DatabaseBundle:person:editperson.html.twig', array(
                    'personalDataForm' => $personalDataForm->createView(),
                    'seasonForm' => $seasonForm->createView(),
                    'personalData' => $this->personalData,
                    'curSeason' => $this->season,
                    'isPlayerBank' => $playerBank,
                    'isMemberBank' => $memberBank,
                    'underage' => $underage,
                    'playerPayments' => $playerPayments,
                    'journalForm' => $journalForm->createView(),
                    'journalForms' => $journalForms,
                    'journalLength' => sizeof($journalForms),
                    ));
    }

    private function getBank($data, $personalDataForm)
    {
        $bank = 'false';
        foreach($personalDataForm->get($data) as $subForm) {
            if ($this->getFormDataArray($subForm)["season"] == $this->season) {
                $data = $this->getFormDataArray($subForm)["pay"];
                if ($data && $data->getWayOfPayment() == 'bank') {
                    $bank = 'true';
                }
            }
        }
        return $bank;
    }

    private function addPay($playerData, $personalDataForm) 
    {
        foreach($personalDataForm->get("playerData") as $subForm) {
            if($this->getFormDataArray($subForm)["season"] == $playerData->getSeason()) {
                $pay = $this->getFormDataArray($subForm)["pay"];
                $playerData->setCategory($playerData->getCategory());
                $pay->setPlayerData($playerData);
                $playerData->setPay($pay);
                return $pay;
            }
        }
    }

    private function addPayment($pay, $personalDataForm, $childEntity)
    {
        foreach($personalDataForm->get($childEntity) as $subForm) {
            foreach($this->getFormDataArray($subForm["pay"]["activepayment"]) as $activePayment) {
                if (!$activePayment->getPay()) {
                    $history = new PaymentHistory();
                    $activePayment->setPay($pay);

                    $pm = $activePayment->getPayment();
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

    private function removePayment($pay, $personalDataForm)
    {
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

    private function getFormDataArray($form)
    {
        $data = [];
        foreach($form as $key => $value) {
            $data[$key] = $value->getData();
        }
        return $data;
    }

    private function getPlayerDataForm($personalDataForm)
    {
        foreach($personalDataForm->get("playerData") as $subForm) {
            if ($subForm->get("season")->getViewData() == $this->season->getId()) {
                return $subForm;
            }
        }
    }

    private function isUnderage($playerData)
    {
        if ($playerData->getCategory() == 'senior' or $playerData->getCategory() == 'female') {
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

}
?>
