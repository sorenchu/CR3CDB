<?php

# src/DatabaseBundle/Controller/People/Subentities/MemberInfo.php

namespace DatabaseBundle\Controller\People\Subentities;

use DatabaseBundle\Controller\People\HandlingData;

use DatabaseBundle\Entity\MemberPerson;
use DatabaseBundle\Entity\Pay;
use DatabaseBundle\Entity\Payment;

class MemberInfo {

    private $memberPerson;
    private $entityManager;
    private $memberData;

    function __construct(
        \DatabaseBundle\Entity\PersonalData $personalData,
        \DatabaseBundle\Entity\MemberPerson $memberPerson = null,
        \DatabaseBundle\Entity\Season $season,
        \Doctrine\ORM\EntityManagerInterface $entityManager
    ) {
        $this->entityManager = $entityManager;
        if (!$memberPerson) {
            $this->memberPerson = new MemberPerson();
            $this->memberPerson->setIsMember(false);
            $this->memberPerson->setPersonalData($personalData);
            $personalData->addMemberPerson($this->memberPerson);
            $this->memberData = $this->creatingMemberData($this->memberPerson, $season);

        } else {
            $this->memberPerson = $memberPerson;
            $this->memberData = $this->memberPerson->getMemberData();
        }
    }

    function getPay() {
        return $this->memberData->getPay();
    }

    private function creatingMemberData(
        \DatabaseBundle\Entity\MemberPerson $memberPerson,
        \DatabaseBundle\Entity\Season $season
    ) {
        $handlingData = new HandlingData($this, "member");
        $this->memberData = $handlingData->getChildData();
        $this->memberData->setSeason($season);
        $this->memberData->setMemberPerson($memberPerson);
        $pay = $this->entityManager->getRepository(Pay::class)->getPay($this->memberData->getId());
        if (!$pay) {
            $pay = new Pay();
        }
        $this->memberData->setPay($pay);
        $pay->setMemberData($this->memberData);
        $this->memberPerson->setMemberData($this->memberData);
        return $this->memberData;

    }
}
