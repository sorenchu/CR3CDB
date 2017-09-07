<?php
# src/DatabaseBundle/Controller/People/HandlingData.php

namespace DatabaseBundle\Controller\People;

use DatabaseBundle\Entity\PlayerData;
use DatabaseBundle\Entity\CoachData;
use DatabaseBundle\Entity\MemberData;
use DatabaseBundle\Entity\ParentData;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class HandlingData extends Controller
{
    private $personController;
    private $childData;

    public function __construct($personController, $type)
    {
        $this->personController = $personController;
        switch($type) {
          case "player":
            $this->childData = new PlayerData();
            break;
          case "coach":
            $this->childData = new CoachData();
            break;
          case "member":
            $this->childData = new MemberData();
            break;
          case "parent":
            $this->childData = new ParentData();
            break;
        }
    }

    public function setPersonalData($personalData)
    {
        $this->childData->setPersonalData($personalData);
    }

    public function setSeason($season)
    {
        $this->childData->setSeason($season);
    }

    public function getChildData()
    {
        return $this->childData;
    }
}
?>
