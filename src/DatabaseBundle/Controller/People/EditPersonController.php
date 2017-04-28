<?php
# src/DatabaseBundle/Controller/People/EditPersonController.php

namespace DatabaseBundle\Controller\People;

use DatabaseBundle\Form\Person\WholePersonType;
use DatabaseBundle\Form\SeasonType;
use DatabaseBundle\Entity\PlayerData;

use DatabaseBundle\Controller\DBQuery\GetEditionQueries;
use DatabaseBundle\Controller\DBQuery\SeasonQueries;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class EditPersonController extends Controller
{
  public function editPersonAction($id, $seasonId=null, Request $request)
  {
    $peopleQueries = new GetEditionQueries($this);
    $seasonQueries = new SeasonQueries($this);

    $season = $seasonQueries->getSeason($seasonId);
    $seasonForm = $this->createForm(new SeasonType(), $season);
    $seasonForm->handleRequest($request);

    $wholePerson = $peopleQueries->getPerson($id);
    if ($wholePerson->getPersonalData()->getIsPlayer())
    {
      $playerData = new PlayerData();
      $playerData->setWholePerson($wholePerson);
      $playerData->setSeason($season);
      if (null == $wholePerson->isInCurrentSeason($season))
      {
        $wholePerson->getPlayerData()->add($playerData);
      }
    }

    $wholePersonForm = $this->createForm(new WholePersonType(), $wholePerson);
    $wholePersonForm->handleRequest($request);
    if ($wholePersonForm->isSubmitted())
    {
      $seasonForm = $this->createForm(new SeasonType(), $season);
      $peopleQueries->savePerson($wholePerson, true);
      $wholePersonForm = $this->createForm(new WholePersonType(), $wholePerson);
    }
    return $this->render('DatabaseBundle:person:editperson.html.twig', array(
                'wholePersonForm' => $wholePersonForm->createView(),
                'seasonForm' => $seasonForm->createView(),
                'wholePerson' => $wholePerson,
                'personalData' => $wholePerson->getPersonalData(),
                'curSeason' => $season,
    ));
  }
}
?>
