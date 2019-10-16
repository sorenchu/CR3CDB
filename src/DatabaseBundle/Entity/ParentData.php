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

    public function __toString()
    {
        return $this->getParentPerson()->getPersonalData()->getName().' '
                .$this->getParentPerson()->getPersonalData()->getSurname();
    }
    /**
     * @var \DatabaseBundle\Entity\ParentPerson
     */
    private $parentPerson;


    /**
     * Set parentPerson
     *
     * @param \DatabaseBundle\Entity\ParentPerson $parentPerson
     *
     * @return ParentData
     */
    public function setParentPerson(\DatabaseBundle\Entity\ParentPerson $parentPerson = null)
    {
        $this->parentPerson = $parentPerson;

        return $this;
    }

    /**
     * Get parentPerson
     *
     * @return \DatabaseBundle\Entity\ParentPerson
     */
    public function getParentPerson()
    {
        return $this->parentPerson;
    }
}
