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
    private $startingYear;

    /**
     * @var string
     */
    private $seasonText;

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
     * Set startingYear
     *
     * @param integer $startingYear
     *
     * @return Season
     */
    public function setStartingYear($startingYear)
    {
        $this->startingYear = $startingYear;

        return $this;
    }

    /**
     * Get startingYear
     *
     * @return integer
     */
    public function getStartingYear()
    {
        return $this->startingYear;
    }

    /**
     * Set seasonText
     *
     * @param string $seasonText
     *
     * @return Season
     */
    public function setSeasonText($seasonText)
    {
        $this->seasonText = $seasonText;

        return $this;
    }

    /**
     * Get seasonText
     *
     * @return string
     */
    public function getSeasonText()
    {
        return $this->seasonText;
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
        return $this->seasonText;
    }
}
