<?php

namespace DatabaseBundle\Entity;

/**
 * ParentData
 */
class ParentData
{
    /**
     * @var integer
     */
    private $id;

    /**
     * @var integer
     */
    private $season;

    /**
     * @var \DatabaseBundle\Entity\WholePerson
     */
    private $wholePerson;

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
     *
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
     * Set wholePerson
     *
     * @param \DatabaseBundle\Entity\WholePerson $wholePerson
     *
     * @return ParentData
     */
    public function setWholePerson(\DatabaseBundle\Entity\WholePerson $wholePerson)
    {
        $this->wholePerson = $wholePerson;

        return $this;
    }

    /**
     * Get wholePerson
     *
     * @return \DatabaseBundle\Entity\WholePerson
     */
    public function getWholePerson()
    {
        return $this->wholePerson;
    }

    /**
     * Add playerDatum
     *
     * @param \DatabaseBundle\Entity\PlayerData $playerDatum
     *
     * @return ParentData
     */
    public function addPlayerDatum(\DatabaseBundle\Entity\PlayerData $playerDatum)
    {
        $this->playerData[] = $playerDatum;

        return $this;
    }

    /**
     * Remove playerDatum
     *
     * @param \DatabaseBundle\Entity\PlayerData $playerDatum
     */
    public function removePlayerDatum(\DatabaseBundle\Entity\PlayerData $playerDatum)
    {
        $this->playerData->removeElement($playerDatum);
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

