<?php

# src/DatabaseBundle/Controller/People/Subentities/ParentInfo.php

namespace DatabaseBundle\Controller\People\Subentities;

use DatabaseBundle\Controller\People\HandlingData;

use DatabaseBundle\Entity\ParentPerson;
use DatabaseBundle\Entity\Pay;

class ParentInfo {

    function __construct(
        \DatabaseBundle\Entity\PersonalData $personalData,
        \DatabaseBundle\Entity\ParentPerson $parentPerson = null,
        \DatabaseBundle\Entity\Season $season
    ) {
        if (!$parentPerson) {
            $parentPerson = new ParentPerson();
            $parentPerson->setIsParent(false);
            $handlingData = new HandlingData($this, "parent");
            $parentData = $handlingData->getChildData();
            $parentData->setParentperson($parentPerson);
            $parentData->setSeason($season);
            $parentPerson->setParentData($parentData);
            $parentPerson->setPersonalData($personalData);
            $personalData->addParentPerson($parentPerson);
        }
    }

}
