<?php
# src/DatabaseBundle/Controller/DBQuery/GetEditionQueries.php

namespace DatabaseBundle\Controller\DBQuery;

use DatabaseBundle\Entity\PersonalData;
use DatabaseBundle\Entity\PlayerData;
use DatabaseBundle\Entity\CoachData;
use DatabaseBundle\Entity\MemberData;
use DatabaseBundle\Entity\ParentData;
use DatabaseBundle\Entity\Pay;
use DatabaseBundle\Entity\Payment;
use DatabaseBundle\Entity\ContactData;
use DatabaseBundle\Entity\CoachPerson;
use DatabaseBundle\Entity\Pictures;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class GetEditionQueries extends Controller
{
    private $personController;

    public function __construct($personController)
    {
        $this->personController = $personController;
    }

    public function savePerson($personalData, $edit)
    {
        $em = $this->personController->getDoctrine()->getManager();
        if ($edit)
            $em->merge($personalData);
        $em->persist($personalData);
        $em->flush();
    }

    public function deletePerson($id)
    {
        $em = $this->personController->getDoctrine()->getManager();
        $personalData = $em->getRepository('DatabaseBundle:PersonalData')
            ->find($id);
        $em->remove($personalData);
        $em->flush();
    }
}
?>
