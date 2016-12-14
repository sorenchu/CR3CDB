<?php
# src/DatabaseBundle/Controller/ShowPlayer.php

namespace DatabaseBundle\Controller;

use DatabaseBundle\Entity\PersonalData;
use DatabaseBundle\Entity\PlayerData;
use DatabaseBundle\Form\Type\PersonalDataType;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

class ShowPeopleController extends Controller
{
  public function showAllAction()
  {
    $personalData = $this->getDoctrine()
              ->getRepository('DatabaseBundle:PersonalData')   
              ->findAll();
    return $this->render('DatabaseBundle:Default:showall.html.twig', array(
                'personalData' => $personalData));
  }

  public function showPlayersAction()
  {
    $em = $this->getDoctrine()->getManager();
    $query = $em->createQuery(
        'SELECT playerdata
         FROM DatabaseBundle:PlayerData playerdata
         JOIN playerdata.personalData c
         WHERE c.id <> :null
         ORDER BY c.surname ASC')
        ->setParameter('null', 'NULL');

    $playerData = $query->getResult();
    return $this->render('DatabaseBundle:Default:showplayers.html.twig', array(
                'playerData' => $playerData));
  }

  public function showParentsAction()
  {
    $parentData = $this->getDoctrine()
            ->getRepository('DatabaseBundle:ParentData')
            ->findAll();
    return $this->render('DatabaseBundle:Default:showparents.html.twig', array(
                'parentData' => $parentData));
  }
}
?>
