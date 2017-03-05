<?php
# src/DatabaseBundle/Controller/DataFormFactory/DataFormFactoryController.php

namespace DatabaseBundle\Controller\DataFormFactory;

use DatabaseBundle\Form\PersonalDataType;
use DatabaseBundle\Form\PlayerDataType;
use DatabaseBundle\Form\CoachDataType;
use DatabaseBundle\Form\MemberDataType;
use DatabaseBundle\Form\ParentDataType;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class DataFormFactoryController extends Controller
{
  private $editPersonController;

  public function __construct(Controller $editPerson)
  {
    $this->editPersonController = $editPerson;
  }

  public function getCreatedForm($typeData, $data) 
  {
    if (0 == strcmp("personal", $typeData))
    {
      return $this->editPersonController->
                createForm(new PersonalDataType(), $data);
    }
    else if (0 == strcmp("player", $typeData))
    {
      return $this->editPersonController->
                createForm(new PlayerDataType(), $data);
    }
    else if (0 == strcmp("coach", $typeData))
    {
      return $this->editPersonController->
                createForm(new CoachDataType(), $data);
    }
    else if (0 == strcmp("member", $typeData))
    {
      return $this->editPersonController->
                createForm(new MemberDataType(), $data);
    }
    else if (0 == strcmp("parent", $typeData))
    {
      return $this->editPersonController->
                createForm(new ParentDataType(
                      $this->allChildren(), 
                      $data->getPlayerData()),
                     $data);
    }
    return null;
  }

  private function allChildren()
  {
    $em = $this->editPersonController->
             getDoctrine()->getManager(); 
    $query = $em->createQuery(
        'SELECT playerdata
        FROM DatabaseBundle:PlayerData playerdata
        WHERE playerdata.category NOT LIKE :senior
        AND playerdata.category NOT LIKE :femenino')
        ->setParameter('senior', 'Senior')
        ->setParameter('femenino', 'Femenino');

    return $query->getResult();
  }
}

?>
