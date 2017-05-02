<?php

namespace DatabaseBundle\Entity;

/**
 * WholePerson
 */
class WholePerson
{
    /**
     * @var integer
     */
    private $id;

    /**
     * @var \DatabaseBundle\Entity\PersonalData
     */
    private $personalData;

    /**
     * @var \DatabaseBundle\Entity\PlayerData
     */
    private $playerData;

    /**
     * @var \DatabaseBundle\Entity\CoachData
     */
    private $coachData;

    /**
     * @var \DatabaseBundle\Entity\MemberData
     */
    private $memberData;

    /**
     * @var \DatabaseBundle\Entity\ParentData
     */
    private $parentData;


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
     * Set personalData
     *
     * @param \DatabaseBundle\Entity\PersonalData $personalData
     *
     * @return WholePerson
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
     * Set memberData
     *
     * @param \DatabaseBundle\Entity\MemberData $memberData
     *
     * @return WholePerson
     */
    public function setMemberData(\DatabaseBundle\Entity\MemberData $memberData = null)
    {
        $this->memberData = $memberData;

        return $this;
    }

    /**
     * Get memberData
     *
     * @return \DatabaseBundle\Entity\MemberData
     */
    public function getMemberData()
    {
        return $this->memberData;
    }

    /**
     * Set parentData
     *
     * @param \DatabaseBundle\Entity\ParentData $parentData
     *
     * @return WholePerson
     */
    public function setParentData(\DatabaseBundle\Entity\ParentData $parentData = null)
    {
        $this->parentData = $parentData;

        return $this;
    }

    /**
     * Get parentData
     *
     * @return \DatabaseBundle\Entity\ParentData
     */
    public function getParentData()
    {
        return $this->parentData;
    }
    /**
     * Constructor
     */
    public function __construct()
    {
        $this->playerData = new \Doctrine\Common\Collections\ArrayCollection();
        $this->coachData = new \Doctrine\Common\Collections\ArrayCollection();
    }

    /**
     * Add playerDatum
     *
     * @param \DatabaseBundle\Entity\PlayerData $playerDatum
     *
     * @return WholePerson
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

    /**
     * Set playerData
     *
     * @param \DatabaseBundle\Entity\PlayerData $playerData
     *
     * @return WholePerson
     */
    public function setPlayerData(\DatabaseBundle\Entity\PlayerData $playerData = null)
    {
        $this->playerData = $playerData;

        return $this;
    }

    /**
     * Ask if player is present in the season
     *
     * @param $season
     *
     * @return boolean
     */
    public function playerIsInCurrentSeason($season) 
    {
      foreach ($this->playerData as $pd)
      {
        if ($pd->getSeason() == $season)
          return $pd;
      }
      return null;
    }

    /**
     * Add coachDatum
     *
     * @param \DatabaseBundle\Entity\CoachData $coachDatum
     *
     * @return WholePerson
     */
    public function addCoachDatum(\DatabaseBundle\Entity\CoachData $coachDatum)
    {
        $this->coachData[] = $coachDatum;

        return $this;
    }

    /**
     * Remove coachDatum
     *
     * @param \DatabaseBundle\Entity\CoachData $coachDatum
     */
    public function removeCoachDatum(\DatabaseBundle\Entity\CoachData $coachDatum)
    {
        $this->coachData->removeElement($coachDatum);
    }

    /**
     * Get coachData
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getCoachData()
    {
        return $this->coachData;
    }

    /**
     * Set coachData
     *
     * @param \DatabaseBundle\Entity\CoachData $coachData
     *
     * @return WholePerson
     */
    public function setCoachData(\DatabaseBundle\Entity\CoachData $coachData = null)
    {
        $this->coachData = $coachData;

        return $this;
    }

    /**
     * Ask if coach is present in the season
     *
     * @param $season
     *
     * @return boolean
     */
    public function coachIsInCurrentSeason($season)
    {
      foreach ($this->coachData as $pd)
      {
        if ($pd->getSeason() == $season)
          return $pd;
      }
      return null;
    }
}
