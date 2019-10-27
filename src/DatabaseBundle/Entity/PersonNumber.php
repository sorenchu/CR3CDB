<?php

namespace DatabaseBundle\Entity;

/**
 * PersonNumber
 */
class PersonNumber
{
    /**
     * @var int
     */
    private $id;


    /**
     * Get id.
     *
     * @return int
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * @var int
     */
    private $number;

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
     * Set number.
     *
     * @param int $number
     *
     * @return PersonNumber
     */
    public function setNumber($number)
    {
        $this->number = $number;

        return $this;
    }

    /**
     * Get number.
     *
     * @return int
     */
    public function getNumber()
    {
        return $this->number;
    }

    /**
     * Add playerDatum.
     *
     * @param \DatabaseBundle\Entity\PlayerData $playerDatum
     *
     * @return PersonNumber
     */
    public function addPlayerDatum(\DatabaseBundle\Entity\PlayerData $playerDatum)
    {
        $this->playerData[] = $playerDatum;

        return $this;
    }

    /**
     * Remove playerDatum.
     *
     * @param \DatabaseBundle\Entity\PlayerData $playerDatum
     *
     * @return boolean TRUE if this collection contained the specified element, FALSE otherwise.
     */
    public function removePlayerDatum(\DatabaseBundle\Entity\PlayerData $playerDatum)
    {
        return $this->playerData->removeElement($playerDatum);
    }

    /**
     * Get playerData.
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getPlayerData()
    {
        return $this->playerData;
    }

    public function __tostring() {
        return strval($this->number);
    }
}
