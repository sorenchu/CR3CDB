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
