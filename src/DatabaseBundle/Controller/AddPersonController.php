<?php
# src/DatabaseBundle/Controller/AddPersonController.php

namespace DatabaseBundle\Controller;

use DatabaseBundle\Entity\PersonalData;
use DatabaseBundle\Form\Type\PersonalDataType;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

class AddPersonController extends Controller
{
  public function newAction(Request $request)
  {
    $personalData = new PersonalData();
    $personalDataForm = $this->createForm(new PersonalDataType(), $personalData);
    $personalDataForm->handleRequest($request);

    if($personalDataForm->isSubmitted()) 
    {
      $em = $this->getDoctrine()->getManager();
      $em->persist($personalData);
      $em->flush();
      return $this->redirectToRoute('edit_person', 
                    array('id' => $this->getNewPerson($personalData)->getId()));
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

  private function getNewPerson($personalData) {
    $em = $this->getDoctrine()->getManager();
    $query = $em->createQuery(
        'SELECT personaldata
        FROM DatabaseBundle:PersonalData personaldata
        WHERE personaldata.name LIKE :name
        AND personaldata.surname LIKE :surname
        AND personaldata.isPlayer = :isPlayer
        AND personaldata.isCoach = :isCoach
        AND personaldata.isMember = :isMember
        AND personaldata.isParent = :isParent
        AND personaldata.sex = :sex')
        ->setParameter('name', $personalData->getName())
        ->setParameter('surname', $personalData->getSurname())
        ->setParameter('isPlayer', $personalData->getIsPlayer())
        ->setParameter('isCoach', $personalData->getIsCoach())
        ->setParameter('isMember', $personalData->getIsMember())
        ->setParameter('isParent', $personalData->getIsParent())
        ->setParameter('sex', $personalData->getSex());

    return $query->getResult()[0];
  }
}
?>
