<?php

namespace DatabaseBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * ParentData
 */
class ParentData
{
    /**
     * @var int
     */
    private $id;

    /**
     * @var int
     */
    private $season;


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
     * Set season
     *
     * @param integer $season
     * @return ParentData
     */
    public function setSeason($season)
    {
        $this->season = $season;

        return $this;
    }

    /**
     * Get season
     *
     * @return integer 
     */
    public function getSeason()
    {
        return $this->season;
    }
    /**
     * @var \DatabaseBundle\Entity\PersonalData
     */
    private $personalData;


    /**
     * Set personalData
     *
     * @param \DatabaseBundle\Entity\PersonalData $personalData
     * @return ParentData
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
    /**
     * @var \Doctrine\Common\Collections\Collection
     */
    private $playerData;

    /**
     * Constructor
     */
    public function __construct()
    {
        $this->playerData = new \Doctrine\Common\Collections\ArrayCollection();
    }

    /**
     * Add playerData
     *
     * @param \DatabaseBundle\Entity\PlayerData $playerData
     * @return ParentData
     */
    public function addPlayerDatum(\DatabaseBundle\Entity\PlayerData $playerData)
    {
        $this->playerData[] = $playerData;

        return $this;
    }

    /**
     * Remove playerData
     *
     * @param \DatabaseBundle\Entity\PlayerData $playerData
     */
    public function removePlayerDatum(\DatabaseBundle\Entity\PlayerData $playerData)
    {
        $this->playerData->removeElement($playerData);
    }

    /**
     * Get playerData
     *
     * @return \Doctrine\Common\Collections\Collection 
     */
    public function getPlayerData()
    {
        return $this->playerData;
    }
}
