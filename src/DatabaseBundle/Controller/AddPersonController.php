<?php
# src/DatabaseBundle/Controller/AddPersonController.php

namespace DatabaseBundle\Controller;

use DatabaseBundle\Entity\PersonalData;
use DatabaseBundle\Form\Type\PersonalDataType;

use DatabaseBundle\Entity\PlayerData;
use DatabaseBundle\Form\Type\PlayerDataType;

use DatabaseBundle\Entity\CoachData;
use DatabaseBundle\Form\Type\CoachDataType;

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
    $playerDataForm = $this->createForm(new PlayerDataType(), new PlayerData());
    $coachDataForm = $this->createForm(new CoachDataType(), new CoachData());

    if($personalDataForm->isSubmitted()) 
    {
      $em = $this->getDoctrine()->getManager();
      $em->persist($personalData);
      $em->flush();
      return $this->render('DatabaseBundle:Default:editperson.html.twig', array(
                  'personalDataForm' => $personalDataForm->createView(),
                  'playerDataForm' => $playerDataForm->createView(),
                  'coachDataForm' => $coachDataForm->createView(),
      ));
    }

    return $this->render('DatabaseBundle:Default:new.html.twig', array(
                'personalDataForm' => $personalDataForm->createView(),
    ));
  }

  public function editPersonAction($id, Request $request)
  {
    $em = $this->getDoctrine()->getManager();
    $personalData = $em->getRepository('DatabaseBundle:PersonalData')->find($id);

    $query = $em->createQuery(
        'SELECT playerdata
         FROM DatabaseBundle:Playerdata playerdata
         JOIN playerdata.personalData person
         WHERE person.id = :id')
       ->setParameter('id', $id); 
    if (NULL != $query->getOneOrNullResult())
    {
      $playerData = $query->getOneOrNullResult();
    }
    else
    {
      $playerData = new PlayerData();
    }

    $query = $em->createQuery(
        'SELECT coachdata
         FROM DatabaseBundle:CoachData coachdata
         JOIN coachdata.personalData person
         WHERE person.id = :id')
        ->setParameter('id', $id);
    if (NULL != $query->getOneOrNullResult())
    {
      $coachData = $personalData->getCoachData();
    }
    else
    {
      $coachData = new CoachData();
    }

    if (!$personalData) 
    {
      throw $this->createNotFoundException(
          'No hay miembro asociado a la identificación '.$id);
    }

    $personalDataForm = $this->createForm(new PersonalDataType(), $personalData);
    $personalDataForm->handleRequest($request);

    $playerDataForm = $this->createForm(new PlayerDataType(), $playerData);
    $playerDataForm->handleRequest($request);

    $coachDataForm = $this->createForm(new CoachDataType(), $coachData);
    $coachDataForm->handleRequest($request);

    if($personalDataForm->isSubmitted()) 
    {
      $em->persist($personalData);
      $em->flush();
    }

    if($playerDataForm->isSubmitted())
    {
      $playerData->setPersonalData($personalData);
      $em->merge($playerData);
      $em->flush();
    }

    if($coachDataForm->isSubmitted())
    {
      $coachData->setCoachData($personalData);
      $em->merge($coachData);
      $em->flush();
    }

    return $this->render('DatabaseBundle:Default:editperson.html.twig', array(
                'personalDataForm' => $personalDataForm->createView(),
                'playerDataForm' => $playerDataForm->createView(),
                'coachDataForm' => $coachDataForm->createView(),
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
}
?>

