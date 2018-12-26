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

    public function getPeopleByType($id, $table, $season)
    {
        if (0 == strcmp("playerdata", $table)) {
            $tableName = 'DatabaseBundle:Playerdata';
            $alias = 'playerdata';
        } else if (0 == strcmp("coachdata", $table)) {
            $tableName = 'DatabaseBundle:Coachdata';
            $alias = 'coachdata';
        } else if (0 == strcmp("memberdata", $table)) {
            $tableName = 'DatabaseBundle:Memberdata';
            $alias = 'memberdata';
        } else if (0 == strcmp("parentdata", $table)) {
            $tableName = 'DatabaseBundle:Parentdata';
            $alias = 'parentdata';
        } else {
            return null;
        }

        $repository = $this->personController->
            getDoctrine()->getRepository($tableName);
        $query = $repository->createQueryBuilder($alias)
            ->from($tableName, 'data')
            ->join($alias.'.personalData', 'person')
            ->join($alias.'.season', 'season')
            ->where('person.id = :id')
            ->andWhere('season.id = :season')
            ->setParameter('id', $id)
            ->setParameter('season', $season)
            ->getQuery();

        return $query->getOneOrNullResult();
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

    public function deleteFromTeam($id, $seasonId, $table)
    {
        $em = $this->personController->getDoctrine()->getManager();
        if (0 == $table) {
            $teamMember = $em->getRepository('DatabaseBundle:PlayerData')
                ->createQueryBuilder('players')
                ->join('players.season', 'season')
                ->join('players.personalData', 'person')
                ->where('season.id = :seasonId')
                ->andWhere('person.id = :id')
                ->setParameter('seasonId', $seasonId)
                ->setParameter('id', $id)
                ->getQuery()
                ->getResult()[0];
            $em->remove($teamMember);
            $em->flush();
        } else {
            $teamMember = $em->getRepository('DatabaseBundle:CoachData')
                ->createQueryBuilder('coaches')
                ->join('coaches.personalData', 'person')
                ->join('coaches.season', 'season')
                ->where('season.id = :seasonId')
                ->andWhere('person.id = :id')
                ->setParameter('seasonId', $seasonId)
                ->setParameter('id', $id)
                ->getQuery()
                ->getResult()[0];
            $em->remove($teamMember);
            $em->flush();
        }
        $person = $em->getRepository('DatabaseBundle:PersonalData')
            ->find($id);
        $this->savePerson($person, true);
    }

    public function deleteFromMember($id, $seasonId)
    {
        $em = $this->personController->getDoctrine()->getManager();
        $member = $em->getRepository('DatabaseBundle:MemberData')
            ->createQueryBuilder('members')
            ->join('members.season', 'season')
            ->join('members.personalData', 'person')
            ->where('season.id = :seasonId')
            ->andWhere('person.id = :id')
            ->setParameter('seasonId', $seasonId)
            ->setParameter('id', $id)
            ->getQuery()
            ->getResult()[0];
        $em->remove($member);
        $em->flush();

        // Check if it is still member. Either way, set to non member 
        $member = $em->getRepository('DatabaseBundle:MemberData')
            ->createQueryBuilder('members')
            ->join('members.personalData', 'person')
            ->where('person.id = :id')
            ->setParameter('id', $id)
            ->getQuery()
            ->getOneOrNullResult();

        if ($member == NULL) {
            $person = $em->getRepository('DatabaseBundle:PersonalData')
                ->find($id);
            $person->setIsMember(0);
            $this->savePerson($person, true);
        }
        
    }

    public function deleteFromParent($id, $seasonId)
    {
        $em = $this->personController->getDoctrine()->getManager();
        $parent = $em->getRepository('DatabaseBundle:ParentData')
            ->createQueryBuilder('parents')
            ->join('parents.season', 'season')
            ->where('season.id = :seasonId')
            ->andWhere('parents.id = :id')
            ->setParameter('seasonId', $seasonId)
            ->setParameter('id', $id)
            ->getQuery()
            ->getResult()[0];
        $em->remove($parent);
        $em->flush();

        // Check if it is still parent. Either way, set to non parent
        $parent = $em->getRepository('DatabaseBundle:ParentData')
            ->createQueryBuilder('parents')
            ->join('parents.personalData', 'person')
            ->where('person.id = :id')
            ->setParameter('id', $id)
            ->getQuery()
            ->getOneOrNullResult();

        if ($parent == NULL) {
            $person = $em->getRepository('DatabaseBundle:PersonalData')
                ->find($id);
            $person->setIsParent(0);
            $this->savePerson($person, true);
        }
    }

    public function getPay($id)
    {
        $em = $this->personController->getDoctrine()->getManager();
        $pay = $em->getRepository('DatabaseBundle:Pay')
            ->createQueryBuilder('pay')
            ->join('pay.playerData', 'playerData')
            ->where('playerData.id = :id')
            ->setParameter('id', $id)
            ->getQuery()
            ->getResult();
        return $pay;    
    }
}
?>
