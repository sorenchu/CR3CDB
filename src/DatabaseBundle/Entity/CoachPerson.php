<?php

namespace DatabaseBundle\Entity;

/**
 * CoachPerson
 */
class CoachPerson
{
    /**
     * @var integer
     */
    private $id;

    /**
     * @var boolean
     */
    private $isCoach;

    /**
     * @var \DatabaseBundle\Entity\PersonalData
     */
    private $personalData;

    /**
     * @var \DatabaseBundle\Entity\CoachData
     */
    private $coachData;


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
     * Set isCoach
     *
     * @param boolean $isCoach
     *
     * @return CoachPerson
     */
    public function setIsCoach($isCoach)
    {
        $this->isCoach = $isCoach;

        return $this;
    }

    /**
     * Get isCoach
     *
     * @return boolean
     */
    public function getIsCoach()
    {
        return $this->isCoach;
    }

    /**
     * Set personalData
     *
     * @param \DatabaseBundle\Entity\PersonalData $personalData
     *
     * @return CoachPerson
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
     * Set coachData
     *
     * @param \DatabaseBundle\Entity\CoachData $coachData
     *
     * @return CoachPerson
     */
    public function setCoachData(\DatabaseBundle\Entity\CoachData $coachData = null)
    {
        $this->coachData = $coachData;

        return $this;
    }

    /**
     * Get coachData
     *
     * @return \DatabaseBundle\Entity\CoachData
     */
    public function getCoachData()
    {
        return $this->coachData;
    }
}
