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
    
    $wholePersonForm = $dataFormFactory->getCreatedForm("whole", null);
    $wholePersonForm->handleRequest($request);

    if ($wholePersonForm->isSubmitted())
    {
      $em->persist($wholePerson);
      $em->persist($personalData);
      $em->flush();
    }

    return $this->render('DatabaseBundle:person:editperson.html.twig', array(
                'wholePersonForm' => $wholePersonForm->createView(),
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
