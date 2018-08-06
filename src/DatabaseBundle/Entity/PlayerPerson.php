<?php

namespace DatabaseBundle\Entity;

/**
 * PlayerPerson
 */
class PlayerPerson
{
    /**
     * @var integer
     */
    private $id;

    /**
     * @var boolean
     */
    private $isPlayer;

    /**
     * @var \DatabaseBundle\Entity\PlayerData
     */
    private $playerData;

    /**
     * @var \DatabaseBundle\Entity\PersonalData
     */
    private $personalData;


    /**
     * Get id
     *
     * @return integer
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * Set isPlayer
     *
     * @param boolean $isPlayer
     *
     * @return PlayerPerson
     */
    public function setIsPlayer($isPlayer)
    {
        $this->isPlayer = $isPlayer;

        return $this;
    }

    /**
     * Get isPlayer
     *
     * @return boolean
     */
    public function getIsPlayer()
    {
        return $this->isPlayer;
    }

    /**
     * Set playerData
     *
     * @param \DatabaseBundle\Entity\PlayerData $playerData
     *
     * @return PlayerPerson
     */
    public function setPlayerData(\DatabaseBundle\Entity\PlayerData $playerData = null)
    {
        $this->playerData = $playerData;

        return $this;
    }

    /**
     * Get playerData
     *
     * @return \DatabaseBundle\Entity\PlayerData
     */
    public function getPlayerData()
    {
        return $this->playerData;
    }

    /**
     * Set personalData
     *
     * @param \DatabaseBundle\Entity\PersonalData $personalData
     *
     * @return PlayerPerson
     */
    public function setPersonalData(\DatabaseBundle\Entity\PersonalData $personalData = null)
    {
        $this->personalData = $personalData;

        return $this;
    }

    /**
     * Get personalData
     *
     * @return \DatabaseBundle\Entity\PersonalData
     */
    public function getPersonalData()
    {
        return $this->personalData;
    }
}

