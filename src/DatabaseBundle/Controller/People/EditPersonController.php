<?php
# src/DatabaseBundle/Controller/People/EditPersonController.php

namespace DatabaseBundle\Controller\People;

use DatabaseBundle\Form\Person\PersonalDataType;
use DatabaseBundle\Form\Season\SeasonType;
use DatabaseBundle\Entity\Pay;

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
    $peopleQueries = new GetEditionQueries($this);
    $seasonQueries = new SeasonQueries($this);
    $playerData = NULL;
    #$bank = true;

    $season = $seasonQueries->getSeason($seasonId);
    $seasonForm = $this->createForm(new SeasonType(), $season);
    $seasonForm->handleRequest($request);
    if ($seasonForm->isSubmitted())
    {
      return $this->redirectToRoute('edit_person',
                    array('id' => $id,
                          'seasonId' => $seasonForm->get('season')
                                          ->getData()->getId()
      ));
    }

    $personalData = $peopleQueries->getPerson($id);
    if ($personalData->getIsPlayer())
    {
      $handlingData = new HandlingData($this, "player");
      $playerData = $handlingData->getChildData();
      $playerData->setPersonalData($personalData);
      $playerData->setSeason($season);
      $pay = $peopleQueries->getPay($personalData->getId()); 
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

    if ($personalData->getIsCoach())
    {
      $handlingData = new HandlingData($this, "coach");
      $coachData = $handlingData->getChildData();
      $coachData->setPersonalData($personalData);
      $coachData->setSeason($season);
      if (null == $personalData->coachIsInCurrentSeason($season))
      {
        $personalData->getCoachData()->add($coachData);
      }
    }

    if ($personalData->getIsMember())
    {
      $handlingData = new HandlingData($this, "member");
      $memberData = $handlingData->getChildData();
      $memberData->setPersonalData($personalData);
      $memberData->setSeason($season);
      if (null == $personalData->memberIsInCurrentSeason($season))
      {
        $personalData->getMemberData()->add($memberData);
      }
    }

    if ($personalData->getIsParent())
    {
      $handlingData = new HandlingData($this, "parent");
      $parentData = $handlingData->getChildData();
      $parentData->setPersonalData($personalData);
      $parentData->setSeason($season);
      if (null == $personalData->parentIsInCurrentSeason($season))
      {
        $personalData->getParentData()->add($parentData);
      }
    }

    $personalDataForm = $this->createForm(new PersonalDataType(), $personalData);
    $personalDataForm->handleRequest($request);
    $bank = $this->getBank($playerData, $personalDataForm);
    if ($personalDataForm->isSubmitted())
    {
      $this->addPayment($personalData->getPlayerData(), $personalDataForm);
      $seasonForm = $this->createForm(new SeasonType(), $season);
      $peopleQueries->savePerson($personalData, true);
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

  private function checkPayment($playerData, $personalDataForm) 
  {
    return $this->addPayment($playerData, $personalDataForm);
  }

  private function getBank($playerData, $personalDataForm)
  {
    $bank = false;
    foreach($personalDataForm->get("playerData") as $subForm) {
      $data = $this->getFormDataArray($subForm)["pay"];
      if ($data && $data->getWayOfPayment() == 'bank') {
        $bank = 'bank';
      }
    }
    return $bank;
  }

  private function addPayment($playerData, $personalDataForm) 
  {
    $pay = new Pay();
    foreach($personalDataForm->get("playerData") as $subForm) {
      foreach($playerData as $pd) {
        if($this->getFormDataArray($subForm)["season"] == $pd->getSeason()) {
          $pay = $this->getFormDataArray($subForm)["pay"];
          $pd->setCategory(
              $pd->getCategory()
              );

          $pay->setPlayerData($pd);
          $pd->setPay($pay);
          return;
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
}
?>
