<?php
# src/DatabaseBundle/Controller/AddPersonController.php

namespace DatabaseBundle\Controller;

use DatabaseBundle\Entity\PersonalData;
use DatabaseBundle\Form\PersonalDataType;

use DatabaseBundle\Controller\DBQuery\GetEditionQueries;
use DatabaseBundle\Controller\DBQuery\ShowTeamQueries;
use DatabaseBundle\Controller\DataFormFactory\DataFormFactoryController;

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
    $dataFormFactory = new DataFormFactoryController($this);
    $personalData = new PersonalData();
    $personalDataForm = $dataFormFactory->getCreatedForm("personal", $personalData);
    $personalDataForm->handleRequest($request);

    if($personalDataForm->isSubmitted()) 
    {
      $this->peopleQueries->savePerson($personalData);
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
