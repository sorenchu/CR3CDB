<?php

# src/DatabaseBundle/Controller/People/Subentities/CoachInfo.php

namespace DatabaseBundle\Controller\People\Subentities;

use DatabaseBundle\Controller\People\HandlingData;

use DatabaseBundle\Entity\CoachPerson;
use DatabaseBundle\Entity\Pay;

class CoachInfo {

    function __construct(
        \DatabaseBundle\Entity\PersonalData $personalData,
        \DatabaseBundle\Entity\CoachPerson $coachPerson = null,
        \DatabaseBundle\Entity\Season $season
    ) {
        if (!$coachPerson) {
            $coachPerson = new CoachPerson();
            $coachPerson->setIsCoach(false);
            $handlingData = new HandlingData($this, "coach");
            $coachData = $handlingData->getChildData();
            $coachData->setCoachperson($coachPerson);
            $coachData->setSeason($season);
            $coachPerson->setCoachData($coachData);
            $coachPerson->setPersonalData($personalData);
            $personalData->addCoachPerson($coachPerson);
        }
    }

}
