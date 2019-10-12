<?php
# src/DatabaseBundle/Controller/DBQuery/ShowTeamQueries.php

namespace DatabaseBundle\Controller\DBQuery;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class ShowTeamQueries extends Controller
{
    private $personController;

    public function __construct($personController)
    {
        $this->personController = $personController;
    }

    public function getParents($seasonId)
    {
        return $this->personController
            ->getDoctrine()
            ->getRepository('DatabaseBundle:ParentData')
            ->createQueryBuilder('parents')
            ->join('parents.personalData', 'personaldata')
            ->join('parents.season', 'season')
            ->where('season.id = :seasonId')
            ->setParameter('seasonId', $seasonId)
            ->orderBy('personaldata.surname')
            ->getQuery()
            ->getResult();
    }

    public function getMembers($seasonId)
    {
        return $this->personController
            ->getDoctrine()
            ->getRepository('DatabaseBundle:MemberData')
            ->createQueryBuilder('members')
            ->join('members.personalData', 'personaldata')
            ->join('members.season', 'season')
            ->where('season.id = :seasonId')
            ->setParameter('seasonId', $seasonId)
            ->orderBy('personaldata.surname')
            ->getQuery()
            ->getResult();
    }
}
?>
