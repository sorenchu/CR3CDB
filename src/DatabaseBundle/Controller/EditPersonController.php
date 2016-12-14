<?php
# src/DatabaseBundle/Controller/EditPersonController.php

namespace DatabaseBundle\Controller;

use DatabaseBundle\Entity\PersonalData;
use DatabaseBundle\Form\Type\PersonalDataType;

use DatabaseBundle\Entity\PlayerData;
use DatabaseBundle\Form\Type\PlayerDataType;

use DatabaseBundle\Entity\CoachData;
use DatabaseBundle\Form\Type\CoachDataType;

use DatabaseBundle\Entity\MemberData;
use DatabaseBundle\Form\Type\MemberDataType;

use DatabaseBundle\Entity\ParentData;
use DatabaseBundle\Form\Type\ParentDataType;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

class EditPersonController extends Controller
{
  public function editPersonAction($id, Request $request)
  {
    $em = $this->getDoctrine()->getManager();
    $personalData = $em->getRepository('DatabaseBundle:PersonalData')->find($id);

    $query = $this->processQuery($id, 0);
    $playerData = $this->getQueryResult($query, 0);

    $query = $this->processQuery($id, 1);
    $coachData = $this->getQueryResult($query, 1);

    $query = $this->processQuery($id, 2);
    $memberData = $this->getQueryResult($query, 2);

    $query = $this->processQuery($id, 3);
    $parentData = $this->getQueryResult($query, 3);
    // TODO: new query for getting children
    
    $personalDataForm = $this->createForm(new PersonalDataType(), $personalData);
    $personalDataForm->handleRequest($request);

    $playerDataForm = $this->createForm(new PlayerDataType(), $playerData);
    $playerDataForm->handleRequest($request);

    $coachDataForm = $this->createForm(new CoachDataType(), $coachData);
    $coachDataForm->handleRequest($request);

    $memberDataForm = $this->createForm(new MemberDataType(), $memberData);
    $memberDataForm->handleRequest($request);

    $parentDataForm = $this->createForm(new ParentDataType($this->allChildren()), $parentData);
    $parentDataForm->handleRequest($request);

    if($personalDataForm->isSubmitted()) 
    {
      $em->persist($personalData);
      $em->flush();
    }

    $this->submittingForm($playerDataForm, $playerData, $personalData);
    $this->submittingForm($coachDataForm, $coachData, $personalData);
    $this->submittingForm($memberDataForm, $memberData, $personalData);

    if($parentDataForm->isSubmitted())
    {
      $test = $parentDataForm["playerdata"]->getData()[0];
      $parentData->setPersonalData($personalData);
      $parentData->addParentToChild($test);
      $em->merge($parentData);
      $em->flush();
    }

    return $this->render('DatabaseBundle:Default:editperson.html.twig', array(
                'personalDataForm' => $personalDataForm->createView(),
                'playerDataForm' => $playerDataForm->createView(),
                'coachDataForm' => $coachDataForm->createView(),
                'memberDataForm' => $memberDataForm->createView(),
                'parentDataForm' => $parentDataForm->createView(),
                'personalData' => $personalData,
    ));
  }

  private function processQuery($id, $table)
  {
    switch($table)
    {
      case 0:
          $tableName = 'DatabaseBundle:Playerdata';
          $alias = 'playerdata';
          break;
      case 1:
          $tableName = 'DatabaseBundle:Coachdata';
          $alias = 'coachdata';
          break;
      case 2:
          $tableName = 'DatabaseBundle:Memberdata';
          $alias = 'memberdata';
          break;
      case 3:
          $tableName = 'DatabaseBundle:Parentdata';
          $alias = 'parentdata';
          break;
    }

    $repository = $this->getDoctrine()->getRepository($tableName);
    $query = $repository->createQueryBuilder($alias)
        ->from($tableName, 'data')
        ->join($alias.'.personalData', 'person')
        ->where('person.id = :id')
        ->setParameter('id', $id)
        ->getQuery();
    return $query;
  }

  private function getQueryResult($query, $table)
  {
    if (NULL != $query->getOneOrNullResult())
    {
      $data = $query->getOneOrNullResult();
    }
    else
    {
      switch($table)
      {
        case 0:
          $data = new PlayerData();
          break;

        case 1:
          $data = new CoachData();
          break;

        case 2:
          $data = new MemberData();
          break; 

        case 3:
          $data = new ParentData(); 
          break;
      }
    }
    return $data;
  }

  private function submittingForm($dataForm, $data, $personalData) {
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

  private function allChildren() {
    $em = $this->getDoctrine()->getManager(); 
    $query = $em->createQuery(
        'SELECT playerdata
        FROM DatabaseBundle:PlayerData playerdata
        WHERE playerdata.category NOT LIKE :senior')
        ->setParameter('senior', 'Senior');

    return $query->getResult();
  }
}
?>
