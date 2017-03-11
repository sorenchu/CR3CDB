<?php
# src/DatabaseBundle/Controller/AddPersonController.php

namespace DatabaseBundle\Controller;

use DatabaseBundle\Entity\WholePerson;
use DatabaseBundle\Form\WholePersonType;

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
    $wholePerson = new WholePerson();
    $wholePersonForm = $this->createForm(new WholePersonType(), $wholePerson);
    $wholePersonForm->handleRequest($request);

    if($wholePersonForm->isSubmitted()) 
    {
      $this->peopleQueries->savePerson($wholePerson);
      //return $this->redirectToRoute('edit_person', 
      //              array('id' => $this->peopleQueries
      //                                  ->getNewPerson($wholePerson)->getId()));
    }

    return $this->render('DatabaseBundle:person:new.html.twig', array(
                'wholePersonForm' => $wholePersonForm->createView(),
    ));
  }

  public function deletePersonAction($id)
  {
    $this->peopleQueries->deletePerson($id);
    $showAllQuery = new ShowTeamQueries($this);
    $wholePerson = $showAllQuery->getAllMembers();
    return $this->render('DatabaseBundle:people:showall.html.twig', array(
                'wholePerson' => $wholePerson));
  }
}
?>
