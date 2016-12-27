<?php
# src/DatabaseBundle/Controller/EditPersonController.php

namespace DatabaseBundle\Controller;

use DatabaseBundle\Entity\PersonalData;
use DatabaseBundle\Entity\PlayerData;
use DatabaseBundle\Entity\CoachData;
use DatabaseBundle\Entity\MemberData;
use DatabaseBundle\Entity\ParentData;

use DatabaseBundle\Controller\DataFormFactory\DataFormFactoryController;
use DatabaseBundle\Controller\DBQuery\GetEditionQueries;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class EditPersonController extends Controller
{

  public function editPersonAction($id, Request $request)
  {
    $dataFormFactory = new DataFormFactoryController($this);
    $peopleQueries = new GetEditionQueries($this);

    $em = $this->getDoctrine()->getManager();
    $personalData = $em->getRepository('DatabaseBundle:PersonalData')->find($id);

    $playerData = $peopleQueries->getTableDataForPerson($id, "playerdata");
    $coachData = $peopleQueries->getTableDataForPerson($id, "coachdata");
    $memberData = $peopleQueries->getTableDataForPerson($id, "memberdata");
    $parentData = $peopleQueries->getTableDataForPerson($id, "parentdata");
    // TODO: new query for getting children
    
    $personalDataForm = $dataFormFactory->getCreatedForm("personal", $personalData);
    $personalDataForm->handleRequest($request);

    $playerDataForm = $dataFormFactory->getCreatedForm("player", $playerData);
    $playerDataForm->handleRequest($request);

    $coachDataForm = $dataFormFactory->getCreatedForm("coach", $coachData);
    $coachDataForm->handleRequest($request);

    $memberDataForm = $dataFormFactory->getCreatedForm("member", $memberData);
    $memberDataForm->handleRequest($request);

    $parentDataForm = $dataFormFactory->getCreatedForm("parent", $parentData);
    $parentDataForm->handleRequest($request);

    if($personalDataForm->isSubmitted()) 
    {
      $em->persist($personalData);
      $em->flush();
    }

    $this->submittingForm($playerDataForm, $playerData, $personalData);
    $this->submittingForm($coachDataForm, $coachData, $personalData);
    $this->submittingForm($memberDataForm, $memberData, $personalData);

    if($parentDataForm->isSubmitted())
    {
      $test = $parentDataForm["playerdata"]->getData()[0];
      $parentData->setPersonalData($personalData);
      $parentData->addParentToChild($test);
      $em->merge($parentData);
      $em->flush();
    }

    return $this->render('DatabaseBundle:person:editperson.html.twig', array(
                'personalDataForm' => $personalDataForm->createView(),
                'playerDataForm' => $playerDataForm->createView(),
                'coachDataForm' => $coachDataForm->createView(),
                'memberDataForm' => $memberDataForm->createView(),
                'parentDataForm' => $parentDataForm->createView(),
                'personalData' => $personalData,
    ));
  }

  private function submittingForm($dataForm, $data, $personalData)
  {
    $em = $this->getDoctrine()->getManager();
    if($dataForm->isSubmitted())
    {
      $data->setPersonalData($personalData);
      $em->merge($data);
      $em->flush();
      return $data;
    }
    return NULL;
  }
}
?>
