<?php
# src/DatabaseBundle/Controller/People/EditPersonController.php

namespace DatabaseBundle\Controller\People;

use DatabaseBundle\Form\Person\PersonalDataType;
use DatabaseBundle\Form\Season\SeasonType;
use DatabaseBundle\Entity\Pay;
use DatabaseBundle\Entity\Payment;

use DatabaseBundle\Controller\DBQuery\GetEditionQueries;
use DatabaseBundle\Controller\DBQuery\SeasonQueries;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class EditPersonController extends Controller
{
  private $peopleQueries;
  private $id;

  public function editPersonAction($id, $seasonId=null, Request $request)
  {
    $this->peopleQueries = new GetEditionQueries($this);
    $seasonQueries = new SeasonQueries($this);
    $playerData = NULL;
    $bank = false;

    $season = $seasonQueries->getSeason($seasonId);
    $seasonForm = $this->createForm(new SeasonType(), $season);
    $seasonForm->handleRequest($request);
    if ($seasonForm->isSubmitted()) {
      return $this->redirectToRoute('edit_person',
                    array('id' => $id,
                          'seasonId' => $seasonForm->get('season')
                                          ->getData()->getId()
      ));
    }

    $personalData = $this->peopleQueries->getPerson($id);
    if ($personalData->getIsPlayer()) {
      $handlingData = new HandlingData($this, "player");
      $playerData = $handlingData->getChildData();
      $playerData->setPersonalData($personalData);
      $playerData->setSeason($season);
      $pay = $this->peopleQueries->getPay($personalData->getId()); 
      if ($pay == NULL) {
        $pay = new Pay();
      }
      $pay->setPlayerData($playerData);
      if (null == $personalData->playerIsInCurrentSeason($season)) {
        $personalData->getPlayerData()->add($playerData);
      }
      if ($pay->getPayment() == NULL) {
        $payment = new Payment();
        $payment->setPay($pay);
        $pay->addPayment($payment);
      }
      $playerData->setPay($pay);
    }

    if ($personalData->getIsCoach()) {
      $handlingData = new HandlingData($this, "coach");
      $coachData = $handlingData->getChildData();
      $coachData->setPersonalData($personalData);
      $coachData->setSeason($season);
      if (null == $personalData->coachIsInCurrentSeason($season)) {
        $personalData->getCoachData()->add($coachData);
      }
    }

    if ($personalData->getIsMember()) {
      $handlingData = new HandlingData($this, "member");
      $memberData = $handlingData->getChildData();
      $memberData->setPersonalData($personalData);
      $memberData->setSeason($season);
      if (null == $personalData->memberIsInCurrentSeason($season)) {
        $personalData->getMemberData()->add($memberData);
      }
    }

    if ($personalData->getIsParent()) {
      $handlingData = new HandlingData($this, "parent");
      $parentData = $handlingData->getChildData();
      $parentData->setPersonalData($personalData);
      $parentData->setSeason($season);
      if (null == $personalData->parentIsInCurrentSeason($season)) {
        $personalData->getParentData()->add($parentData);
      }
    }

    $personalDataForm = $this->createForm(new PersonalDataType(), $personalData);
    $personalDataForm->handleRequest($request);
    if ($playerData) 
      $bank = $this->getBank($playerData, $personalDataForm, $season);
    if ($personalDataForm->isSubmitted()) {
      if($playerData) {
        $pay = $this->addPay($personalData->getPlayerDataBySeason($season), $personalDataForm);
        $this->addPayment($pay, $personalDataForm);
        $this->removePayment($pay, $personalDataForm, $season);
      }
      $seasonForm = $this->createForm(new SeasonType(), $season);
      $this->peopleQueries->savePerson($personalData, true);
      $personalDataForm = $this->createForm(new PersonalDataType(), $personalData);
    }
    return $this->render('DatabaseBundle:person:editperson.html.twig', array(
                'personalDataForm' => $personalDataForm->createView(),
                'seasonForm' => $seasonForm->createView(),
                'personalData' => $personalData,
                'curSeason' => $season,
                'isBank' => $bank,
    ));
  }

  private function getBank($playerData, $personalDataForm, $season)
  {
    $bank = false;
    foreach($personalDataForm->get("playerData") as $subForm) {
      if ($this->getFormDataArray($subForm)["season"] == $season) {
        $data = $this->getFormDataArray($subForm)["pay"];
        if ($data && $data->getWayOfPayment() == 'bank') {
          $bank = 'bank';
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

  private function addPayment($pay, $personalDataForm)
  {
    foreach($personalDataForm->get("playerData") as $subForm) {
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
    $dbPayments = $this->peopleQueries->getPaymentsByPay($pay->getId());
    if ($payments->count() == sizeof($dbPayments)) {
      return;
    }
    foreach($payments as $payment) {
      foreach($dbPayments as $dbP) {
        if(!$payments->contains($dbP)) {
          $pay->removePayment($dbP);
          $this->peopleQueries->removePayment($dbP);
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
}
?>
