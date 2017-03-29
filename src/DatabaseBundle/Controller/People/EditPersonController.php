<?php
# src/DatabaseBundle/Controller/People/EditPersonController.php

namespace DatabaseBundle\Controller\People;

use DatabaseBundle\Form\Person\WholePersonType;

use DatabaseBundle\Controller\DBQuery\GetEditionQueries;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class EditPersonController extends Controller
{
  public function editPersonAction($id, Request $request)
  {
    $peopleQueries = new GetEditionQueries($this);

    // TODO: refactor this. It's a query
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
