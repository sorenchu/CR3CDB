<?php
# src/DatabaseBundle/Controller/People/EditPersonController.php

namespace DatabaseBundle\Controller\People;

use DatabaseBundle\Form\Person\PersonalDataType;
use DatabaseBundle\Form\Season\SeasonType;
use DatabaseBundle\Entity\Payment;

use DatabaseBundle\Controller\DBQuery\GetEditionQueries;
use DatabaseBundle\Controller\DBQuery\SeasonQueries;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class EditPersonController extends Controller
{
  public function editPersonAction($id, $seasonId=null, Request $request)
  {
    $peopleQueries = new GetEditionQueries($this);
    $seasonQueries = new SeasonQueries($this);

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
    $log = $this->get('logger');
    if ($personalData->getIsPlayer())
    {
      $handlingData = new HandlingData($this, "player");
      $playerData = $handlingData->getChildData();
      $playerData->setPersonalData($personalData);
      $playerData->setSeason($season);
      if (null == $personalData->playerIsInCurrentSeason($season))
      {
        $personalData->getPlayerData()->add($playerData);
      }
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
    $bank = $this->getWayOfPayment($personalData, $personalDataForm);
    if ($personalDataForm->isSubmitted())
    {
      $seasonForm = $this->createForm(new SeasonType(), $season);
      $bank = $this->checkPayment($personalData, $personalDataForm);
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

  private function checkPayment($personalData, $personalDataForm) 
  {
    return $this->addPayment($personalData, $personalDataForm);
  }

  private function getWayOfPayment($personalData, $personalDataForm)
  {
    $bank = false;
    foreach ($personalData->getPlayerData() as $pd) {
      foreach($personalDataForm->get("playerData") as $subForm) {
        $data = $this->getFormDataArray($subForm)["pay"];
        if ($data && $data->getWayOfPayment() == 'bank') {
          $bank = true;
        }
      }
    }
    return $bank;
  }

  private function addPayment($personalData, $personalDataForm) 
  {
    $bank = false;
    foreach ($personalData->getPlayerData() as $pd) {
      foreach($personalDataForm->get("playerData") as $subForm) {
        $data = $this->getFormDataArray($subForm)["pay"];
        if ($data->getPlayerData() == NULL) {
          $data->setPlayerData($pd);
        }
        foreach($data->getPayment() as $pay) {
          if ($pay->getPay() == NULL) {
            $pay->setPay($data);
          }
        }
        if ($data->getWayOfPayment() == 'bank') {
          $bank = true;
        }
      }
    }
    return $bank;
  }

  private function getFormDataArray($form)
  {
    $data = [];
    $logger = $this->get('logger');
    foreach($form as $key => $value) {
        $data[$key] = $value->getData();
    }
    return $data;
  }
}
?>
