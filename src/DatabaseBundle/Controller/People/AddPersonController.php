<?php
# src/DatabaseBundle/Controller/People/AddPersonController.php

namespace DatabaseBundle\Controller\People;

use DatabaseBundle\Entity\PersonalData;
use DatabaseBundle\Form\Person\PersonalDataType;

use DatabaseBundle\Controller\DBQuery\GetEditionQueries;
use DatabaseBundle\Controller\DBQuery\ShowTeamQueries;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

class AddPersonController extends Controller
{
  private $peopleQueries;

  public function __construct()
  {
    $this->peopleQueries = new GetEditionQueries($this);
  }

  public function newAction(Request $request)
  {
    $personalData = new PersonalData();
    $personalDataForm = $this->createForm(new PersonalDataType(), $personalData);
    $personalDataForm->handleRequest($request);

    if($personalDataForm->isSubmitted()) 
    {
      $this->peopleQueries->savePerson($personalData, false);
      return $this->redirectToRoute('edit_person', 
                    array('id' => $this->peopleQueries
                                        ->getNewPerson($personalData)->getId()));
    }

    return $this->render('DatabaseBundle:person:new.html.twig', array(
                'personalDataForm' => $personalDataForm->createView(),
    ));
  }

  public function deletePersonAction($id)
  {
    $this->peopleQueries->deletePerson($id);
    $showAllQuery = new ShowTeamQueries($this);
    $personalData = $showAllQuery->getAllMembers();
    return $this->render('DatabaseBundle:people:showall.html.twig', array(
                'personalData' => $personalData));
  }
}
?>
