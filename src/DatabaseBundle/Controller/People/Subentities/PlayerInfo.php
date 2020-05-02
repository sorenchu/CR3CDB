<?php

# src/DatabaseBundle/Controller/People/Subentities/PlayerInfo.php

namespace DatabaseBundle\Controller\People\Subentities;

use DatabaseBundle\Controller\People\HandlingData;

use DatabaseBundle\Entity\PlayerPerson;
use DatabaseBundle\Entity\Pay;
use DatabaseBundle\Entity\Payment;

class PlayerInfo {

    private $playerPerson;
    private $entityManager;
    private $playerData;

    function __construct(
        $personalData,
        $playerPerson,
        $season,
        $entityManager
    ) {
        $this->entityManager = $entityManager;
        if (!$playerPerson) {
            $this->playerPerson = new PlayerPerson();
            $this->playerPerson->setIsPlayer(false);
            $this->playerPerson->setPersonalData($personalData);
            $personalData->addPlayerPerson($this->playerPerson);
            $this->playerData = $this->creatingPlayerData($this->playerPerson, $season);
        } else {
            $this->playerPerson = $playerPerson;
            $this->playerData = $this->playerPerson->getPlayerData();
            $pay = $this->entityManager->getRepository(Pay::class)->getPay($this->playerData->getId());
            if ($pay == NULL) {
                $pay = new Pay();
                $this->playerData->setPay($pay);
                $pay->setPlayerData($this->playerData);
            }
            $this->playerData->setCategoryBySeason($season);
            $playerPayments = $this->entityManager->getRepository(Payment::class)
                                ->getPaymentsByPay($this->playerData->getPay()->getId());
        }
    }

    function getPay() {
        return $this->playerData->getPay();
    }

    private function creatingPlayerData($playerPerson, $season) {
        $handlingData = new HandlingData($this, "player");
        $this->playerData = $handlingData->getChildData();
        $this->playerData->setSeason($season);
        $this->playerData->setPlayerPerson($playerPerson);
        $this->playerData->setCategoryBySeason($season);
        $pay = $this->entityManager->getRepository(Pay::class)->getPay($this->playerData->getId());
        if ($pay == NULL) {
            $pay = new Pay();
        }
        $this->playerData->setPay($pay);
        $pay->setPlayerData($this->playerData);

        $playerPerson->setPlayerData($this->playerData);
        return $this->playerData;
    }
}
