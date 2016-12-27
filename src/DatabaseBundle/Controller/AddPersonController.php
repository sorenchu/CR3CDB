<?php
# src/DatabaseBundle/Controller/AddPersonController.php

namespace DatabaseBundle\Controller;

use DatabaseBundle\Entity\PersonalData;
use DatabaseBundle\Form\Type\PersonalDataType;

use DatabaseBundle\Controller\DBQuery\GetEditionQueries;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

class AddPersonController extends Controller
{
  public function newAction(Request $request)
  {
    $peopleQueries = new GetEditionQueries($this);
    $personalData = new PersonalData();
    $personalDataForm = $this->createForm(new PersonalDataType(), $personalData);
    $personalDataForm->handleRequest($request);

    if($personalDataForm->isSubmitted()) 
    {
      $em = $this->getDoctrine()->getManager();
      $em->persist($personalData);
      $em->flush();
      return $this->redirectToRoute('edit_person', 
                    array('id' => $peopleQueries->getNewPerson($personalData)->getId()));
    }

    return $this->render('DatabaseBundle:Default:new.html.twig', array(
                'personalDataForm' => $personalDataForm->createView(),
    ));
  }

  public function deletePersonAction($id)
  {
    $em = $this->getDoctrine()->getManager();
    $personalData = $em->getRepository('DatabaseBundle:PersonalData')->find($id);
    $em->remove($personalData);
    $em->flush();
    $personalData = $em->getRepository('DatabaseBundle:PersonalData')->findAll();
    return $this->render('DatabaseBundle:Default:showall.html.twig', array(
                'personalData' => $personalData));
  }
}
?>
