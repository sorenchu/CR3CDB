<?php
# src/DatabaseBundle/Controller/People/AddPersonController.php

namespace DatabaseBundle\Controller\People;

use DatabaseBundle\Entity\WholePerson;
use DatabaseBundle\Form\Person\WholePersonType;

use DatabaseBundle\Controller\DBQuery\GetEditionQueries;
use DatabaseBundle\Controller\DBQuery\ShowTeamQueries;
use DatabaseBundle\Controller\DBQuery\SeasonQueries;

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
      $this->peopleQueries->savePerson($wholePerson, false);
      return $this->redirectToRoute('edit_person', 
                    array('id' => $this->peopleQueries
                                        ->getNewPerson($wholePerson)->getId()));
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
    $seasonQueries = new SeasonQueries($this);
    
    return $this->render('DatabaseBundle:people:showall.html.twig', array(
                'personalData' => $wholePerson,
                'season' => $seasonQueries->getDefaultSeason(),
                )
          );
  }

  public function deleteFromTeamAction($id, $season, $table)
  {
    $category = $this->peopleQueries->getCategoryFromPerson($id, $table);
    $this->peopleQueries->deleteFromTeam($id, $season, $table);
    return $this->redirectToTeam($category, $season);
  }

  private function redirectToTeam($category)
  {
    switch($category)
    {
      case 'senior':
        return $this->redirectToRoute('show_senior',
                  array()
               );
        break;

      case 'female':
        return $this->redirectToRoute('show_female',
                  array()
               );
        break;

      case 'cadete':
        return $this->redirectToRoute('show_cadete',
                  array()
               );
        break;

      case 'alevin':
        return $this->redirectToRoute('show_alevin',
                  array()
               );
        break;

      case 'benjamin':
        return $this->redirectToRoute('show_benjamin',
                  array()
               );
        break;

      case 'prebenjamin':
        return $this->redirectToRoute('show_prebenjamin',
                  array()
               );
        break;
    }
  }

  public function deleteFromMemberAction($id, $season)
  {
    $this->peopleQueries->deleteFromMember($id, $season);
    return $this->redirectToRoute('show_members',
              array()
            );
  }
}
?>
