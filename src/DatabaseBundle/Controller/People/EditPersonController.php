<?php
# src/DatabaseBundle/Controller/People/EditPersonController.php

namespace DatabaseBundle\Controller\People;

use DatabaseBundle\Form\Person\PersonalDataType;
use DatabaseBundle\Form\Season\SeasonType;

use DatabaseBundle\Entity\PlayerPerson;
use DatabaseBundle\Entity\CoachPerson;
use DatabaseBundle\Entity\ParentData;
use DatabaseBundle\Entity\ParentPerson;
use DatabaseBundle\Entity\MemberPerson;
use DatabaseBundle\Entity\ContactData;
use DatabaseBundle\Entity\PersonalData;
use DatabaseBundle\Entity\Pay;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class EditPersonController extends Controller
{
    private $entityManager;

    public function editPersonAction($id, $seasonId=null, Request $request)
    {
        $playerData = NULL;
        $bank = 'false';
        $underage = 'false';

        $this->entityManager = $this->getDoctrine()->getManager();
        $season = $this->entityManager->getRepository(\DatabaseBundle\Entity\Season::class)->find($seasonId);
        $seasonForm = $this->createForm(\DatabaseBundle\Form\Season\SeasonType::class, $season);
        $seasonForm->handleRequest($request);
        if ($seasonForm->isSubmitted()) {
            return $this->redirectToRoute('edit_person',
                    array('id' => $id,
                        'seasonId' => $seasonForm->get('season')
                        ->getData()->getId()
                        ));
        }

        $personalData = $this->entityManager->getRepository(PersonalData::class)->find($id);
        $contactData = $this->entityManager->getRepository(ContactData::class)->getContactData($id);
        if ($contactData) {
            $contactData->setPersonalData($personalData);
        }
    
        $playerPerson = $this->entityManager->getRepository(PlayerPerson::class)->getPlayerPerson($id, $season);
        if ($playerPerson == NULL) {
            $playerPerson = new PlayerPerson();
            $playerPerson->setIsPlayer(false);
            $handlingData = new HandlingData($this, "player");
            $playerData = $handlingData->getChildData();
            $playerData->setPersonalData($personalData);
            $playerData->setSeason($season);
            $playerData->setPlayerPerson($playerPerson);
            $playerPerson->setPersonalData($personalData);
            $personalData->addPlayerPerson($playerPerson);

            $pay = $this->entityManager->getRepository(Pay::class)->getPay($playerData->getId());
            if ($pay == NULL) {
                $pay = new Pay();
            }
            if ($pay->getPayment() == NULL) {
                $payment = new Payment();
                $payment->setPay($pay);
                $pay->addPayment($payment);
            }
            $playerData->setPay($pay);
            $pay->setPlayerData($playerData);

            $playerPerson->setPlayerData($playerData);
            $personalData->addPlayerDatum($playerData);
        } else {
            $playerData = $playerPerson->getPlayerData();
        }

        $coachPerson = $this->entityManager->getRepository(CoachPerson::class)->getCoachPerson($id, $season);
        if ($coachPerson == NULL) {
            $coachPerson = new CoachPerson();
            $coachPerson->setIsCoach(false);
            $handlingData = new HandlingData($this, "coach");
            $coachData = $handlingData->getChildData();
            $coachData->setPersonalData($personalData);
            $coachData->setSeason($season);
            $coachData->setCoachPerson($coachPerson);
            $coachPerson->setCoachData($coachData);
            $coachPerson->setPersonalData($personalData);
            $personalData->addCoachPerson($coachPerson);
            $personalData->addCoachDatum($coachData);
        }

        $memberPerson = $this->entityManager->getRepository(MemberPerson::class)->getMemberPerson($id, $season);
        if ($memberPerson == NULL) {
            $memberPerson = new MemberPerson();
            $memberPerson->setIsMember(false);
            $handlingData = new HandlingData($this, "member");
            $memberData = $handlingData->getChildData();
            $memberData->setPersonalData($personalData);
            $memberData->setSeason($season);
            $memberData->setMemberPerson($memberPerson);
            $memberPerson->setMemberData($memberData);
            $memberPerson->setPersonalData($personalData);
            $personalData->addMemberPerson($memberPerson);
            $personalData->addMemberDatum($memberData);

            $payMember = $this->entityManager->getRepository(Pay::class)->getPay($memberData->getId());
            if ($payMember == NULL) {
                $payMember = new Pay();
            }
            if ($payMember->getPayment() == NULL) {
                $payment = new Payment();
                $payment->setPay($payMember);
                $payMember->addPayment($payment);
            }
            $memberData->setPay($payMember);
            $pay->setMemberData($memberData);

            $memberPerson->setMemberData($memberData);
            $personalData->addMemberDatum($memberData);
        } else {
            $memberData = $memberPerson->getMemberData();
        }

        $parentPerson = $this->entityManager->getRepository(ParentPerson::class)->getParentPerson($id, $season);
        if ($parentPerson == NULL) {
            $parentPerson = new ParentPerson();
            $parentPerson->setIsParent(false);
            $handlingData = new HandlingData($this, "parent");
            $parentData = $handlingData->getChildData();
            $parentData->setPersonalData($personalData);
            $parentData->setSeason($season);
            $parentData->setParentPerson($parentPerson);
            $parentPerson->setParentData($parentData);
            $parentPerson->setPersonalData($personalData);
            $personalData->addParentPerson($parentPerson);
            $personalData->addParentDatum($parentData);
        }

        $personalDataForm = $this->createForm(\DatabaseBundle\Form\Person\PersonalDataType::class, $personalData);
        $personalDataForm->handleRequest($request);
        $bank = $this->getBank($playerData, $personalDataForm, $season);
        $underage = $this->isUnderage($personalData->getPlayerDataBySeason($season));
        if ($personalDataForm->isSubmitted()) {
            if($playerData) {
                $pay = $playerData->getPay();
                $this->addPayment($pay, $personalDataForm, "playerData");
                $this->removePayment($pay, $personalDataForm, $season);
            }
            if($memberData) {
                $payMember = $memberData->getPay();
                $this->addPayment($payMember, $personalDataForm, "memberData");
                $this->removePayment($payMember, $personalDataForm, $season);
            }
            $seasonForm = $this->createForm(\DatabaseBundle\Form\Season\SeasonType::class, $season);
            $this->entityManager->getRepository(PersonalData::class)->savePerson($personalData, true);
            $personalDataForm = $this->createForm(\DatabaseBundle\Form\Person\PersonalDataType::class, $personalData);
        }
        return $this->render('DatabaseBundle:person:editperson.html.twig', array(
                    'personalDataForm' => $personalDataForm->createView(),
                    'seasonForm' => $seasonForm->createView(),
                    'personalData' => $personalData,
                    'curSeason' => $season,
                    'isBank' => $bank,
                    'underage' => $underage,
                    ));
    }

    private function getBank($playerData, $personalDataForm, $season)
    {
        $bank = 'false';
        foreach($personalDataForm->get("playerData") as $subForm) {
            if ($this->getFormDataArray($subForm)["season"] == $season) {
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
            foreach($this->getFormDataArray($subForm["pay"]["payment"]) as $pm) {
                if (!$pm->getPay()) {
                    $pm->setPay($pay);
                    $pay->addPayment($pm);
                }
            }
        }
    }

    private function removePayment($pay, $personalDataForm, $season)
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

    private function getPlayerDataForm($personalDataForm, $season)
    {
        foreach($personalDataForm->get("playerData") as $subForm) {
            if ($subForm->get("season")->getViewData() == $season->getId()) {
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
}
?>
