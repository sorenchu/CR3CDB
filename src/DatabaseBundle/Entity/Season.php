<?php

namespace DatabaseBundle\Entity;

/**
 * Season
 */
class Season
{
    /**
     * @var integer
     */
    private $id;

    /**
     * @var integer
     */
    private $startingyear;

    /**
     * @var string
     */
    private $seasontext;

    /**
     * @var \Doctrine\Common\Collections\Collection
     */
    private $playerData;

    /**
     * @var \Doctrine\Common\Collections\Collection
     */
    private $coachData;

    /**
     * @var \Doctrine\Common\Collections\Collection
     */
    private $memberData;

    /**
     * @var \Doctrine\Common\Collections\Collection
     */
    private $parentData;

    /**
     * Constructor
     */
    public function __construct()
    {
        $this->playerData = new \Doctrine\Common\Collections\ArrayCollection();
        $this->coachData = new \Doctrine\Common\Collections\ArrayCollection();
        $this->memberData = new \Doctrine\Common\Collections\ArrayCollection();
        $this->parentData = new \Doctrine\Common\Collections\ArrayCollection();
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
     * Set startingyear
     *
     * @param integer $startingyear
     *
     * @return Season
     */
    public function setStartingyear($startingyear)
    {
        $this->startingyear = $startingyear;

        return $this;
    }

    /**
     * Get startingyear
     *
     * @return integer
     */
    public function getStartingyear()
    {
        return $this->startingyear;
    }

    /**
     * Set seasontext
     *
     * @param string $seasontext
     *
     * @return Season
     */
    public function setSeasontext($seasontext)
    {
        $this->seasontext = $seasontext;

        return $this;
    }

    /**
     * Get seasontext
     *
     * @return string
     */
    public function getSeasontext()
    {
        return $this->seasontext;
    }

    /**
     * Add playerDatum
     *
     * @param \DatabaseBundle\Entity\PlayerData $playerDatum
     *
     * @return Season
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
     * Add coachDatum
     *
     * @param \DatabaseBundle\Entity\CoachData $coachDatum
     *
     * @return Season
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
     * Add memberDatum
     *
     * @param \DatabaseBundle\Entity\MemberData $memberDatum
     *
     * @return Season
     */
    public function addMemberDatum(\DatabaseBundle\Entity\MemberData $memberDatum)
    {
        $this->memberData[] = $memberDatum;

        return $this;
    }

    /**
     * Remove memberDatum
     *
     * @param \DatabaseBundle\Entity\MemberData $memberDatum
     */
    public function removeMemberDatum(\DatabaseBundle\Entity\MemberData $memberDatum)
    {
        $this->memberData->removeElement($memberDatum);
    }

    /**
     * Get memberData
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getMemberData()
    {
        return $this->memberData;
    }

    /**
     * Add parentDatum
     *
     * @param \DatabaseBundle\Entity\ParentData $parentDatum
     *
     * @return Season
     */
    public function addParentDatum(\DatabaseBundle\Entity\ParentData $parentDatum)
    {
        $this->parentData[] = $parentDatum;

        return $this;
    }

    /**
     * Remove parentDatum
     *
     * @param \DatabaseBundle\Entity\ParentData $parentDatum
     */
    public function removeParentDatum(\DatabaseBundle\Entity\ParentData $parentDatum)
    {
        $this->parentData->removeElement($parentDatum);
    }

    /**
     * Get parentData
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getParentData()
    {
        return $this->parentData;
    }

    public function __toString()
    {
        return $this->seasontext;
    }
    /**
     * @var boolean
     */
    private $default;


    /**
     * Set default
     *
     * @param boolean $default
     *
     * @return Season
     */
    public function setDefault($default)
    {
        $this->default = $default;

        return $this;
    }

    /**
     * Get default
     *
     * @return boolean
     */
    public function getDefault()
    {
        return $this->default;
    }
    /**
     * @var boolean
     */
    private $defaultseason;


    /**
     * Set defaultseason
     *
     * @param boolean $defaultseason
     *
     * @return Season
     */
    public function setDefaultseason($defaultseason)
    {
        $this->defaultseason = $defaultseason;

        return $this;
    }

    /**
     * Get defaultseason
     *
     * @return boolean
     */
    public function getDefaultseason()
    {
        return $this->defaultseason;
    }

    /**
     * Get season
     *
     * @return this
     */ 
    public function getSeason()
    {
        return $this;
    }

    /**
     * Set season
     *
     * @param Season $season
     *
     * @return this
     */
    public function setSeason($season)
    {
        $this->id = $season->getId();
    }
    /**
     * @var \Doctrine\Common\Collections\Collection
     */
    private $journal;


    /**
     * Add journal.
     *
     * @param \DatabaseBundle\Entity\Journal $journal
     *
     * @return Season
     */
    public function addJournal(\DatabaseBundle\Entity\Journal $journal)
    {
        $this->journal[] = $journal;

        return $this;
    }

    /**
     * Remove journal.
     *
     * @param \DatabaseBundle\Entity\Journal $journal
     *
     * @return boolean TRUE if this collection contained the specified element, FALSE otherwise.
     */
    public function removeJournal(\DatabaseBundle\Entity\Journal $journal)
    {
        return $this->journal->removeElement($journal);
    }

    /**
     * Get journal.
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getJournal()
    {
        return $this->journal;
    }
}
