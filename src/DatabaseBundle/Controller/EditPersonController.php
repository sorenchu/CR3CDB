<?php
# src/DatabaseBundle/Controller/EditPersonController.php

namespace DatabaseBundle\Controller;

use DatabaseBundle\Form\WholePerson;
use DatabaseBundle\Form\WholePersonType;

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
    $wholePerson = $em->getRepository('DatabaseBundle:WholePerson')->find($id);

    $wholePersonForm = $this->createForm(new WholePersonType(), $wholePerson);
    $wholePersonForm->handleRequest($request);

    if ($wholePersonForm->isSubmitted())
    {
      $em->merge($wholePerson);
      $em->persist($wholePerson);
      $em->flush();
    }

    return $this->render('DatabaseBundle:person:editperson.html.twig', array(
                'wholePersonForm' => $wholePersonForm->createView(),
                'personalData' => $wholePerson->getPersonalData(),
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
