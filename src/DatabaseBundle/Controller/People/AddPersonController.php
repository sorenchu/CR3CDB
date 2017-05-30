<?php
# src/DatabaseBundle/Controller/People/AddPersonController.php

namespace DatabaseBundle\Controller\People;

use DatabaseBundle\Entity\PersonalData;
use DatabaseBundle\Form\Person\PersonalDataType;

use DatabaseBundle\Entity\FileImport;
use DatabaseBundle\Form\Import\FileImportType;

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
    $personalData = new PersonalData();
    $personalDataForm = $this->createForm(new PersonalDataType(), $personalData);
    $personalDataForm->handleRequest($request);

    $fileImport = new FileImport();
    $fileImportForm = $this->createForm(new FileImportType(), $fileImport);
    $fileImportForm->handleRequest($request);

    if($personalDataForm->isSubmitted()) 
    {
      $this->peopleQueries->savePerson($personalData, false);
      return $this->redirectToRoute('edit_person', 
                    array('id' => $this->peopleQueries
                                        ->getNewPerson($personalData)->getId()));
    }

    if($fileImportForm->isSubmitted())
    {
      $this->mapCsvToTables($fileImport);
    }

    return $this->render('DatabaseBundle:person:new.html.twig', array(
                'personalDataForm' => $personalDataForm->createView(),
                'fileImportForm' => $fileImportForm->createView(),
    ));
  }

  public function deletePersonAction($id)
  {
    $this->peopleQueries->deletePerson($id);
    $showAllQuery = new ShowTeamQueries($this);
    $personalData = $showAllQuery->getAllMembers();
    $seasonQueries = new SeasonQueries($this);
    
    return $this->render('DatabaseBundle:people:showall.html.twig', array(
                'personalData' => $personalData,
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

      case 'femenino':
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

      default:
        return $this->redirectToRoute('show_all',
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

  public function deleteFromParentAction($id, $season)
  {
    $this->peopleQueries->deleteFromParent($id, $season);
    return $this->redirectToRoute('show_parents',
              array()
            );
  }

  private function uploadFile($fileImport)
  {
    $file = $fileImport->getPathToFile();
    $fileName = md5(uniqid().'.'.$file->guessExtension());

    $file->move($this->getParameter('imported_directory'),
                  $fileName);
    $fileImport->setPathToFile($this->getParameter('imported_directory').'/'.$fileName);
  }

  private function mapCsvToTables($fileImport)
  {
    $this->uploadFile($fileImport);
    // TODO: handle file
  }
}
?>
