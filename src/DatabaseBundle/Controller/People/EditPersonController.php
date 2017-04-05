<?php
# src/DatabaseBundle/Controller/People/EditPersonController.php

namespace DatabaseBundle\Controller\People;

use DatabaseBundle\Form\Person\WholePersonType;
use DatabaseBundle\Form\SeasonType;

use DatabaseBundle\Controller\DBQuery\GetEditionQueries;
use DatabaseBundle\Controller\DBQuery\SeasonQueries;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class EditPersonController extends Controller
{
  public function editPersonAction($id, Request $request)
  {
    $peopleQueries = new GetEditionQueries($this);
    $seasonQueries = new SeasonQueries($this);

    $seasonForm = $this->createForm(new SeasonType);
    $seasonForm->handleRequest($request);
    $season = $seasonForm->get('season')->getData();
    if ($season == null)
      $season = $seasonQueries->getDefaultSeason();

    $wholePerson = $peopleQueries->getPerson($id);
    $wholePersonForm = $this->createForm(new WholePersonType(), $wholePerson);
    $wholePersonForm->handleRequest($request);

    if ($wholePersonForm->isSubmitted())
    {
      $peopleQueries->savePerson($wholePerson, true);
      $wholePersonForm = $this->createForm(new WholePersonType(), $wholePerson);
    }
  
    return $this->render('DatabaseBundle:person:editperson.html.twig', array(
                'personalData' => $wholePerson->getPersonalData(),
                'wholePersonForm' => $wholePersonForm->createView(),
                'seasonForm' => $seasonForm->createView(),
    ));
  }
}
?>
