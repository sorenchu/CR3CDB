<?php

namespace DatabaseBundle\Entity;

/**
 * CoachData
 */
class CoachData
{
    /**
     * @var integer
     */
    private $id;

    /**
     * @var float
     */
    private $salary;

    /**
     * @var string
     */
    private $category;

    /**
     * @var integer
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
     * Set salary
     *
     * @param float $salary
     *
     * @return CoachData
     */
    public function setSalary($salary)
    {
        $this->salary = $salary;

        return $this;
    }

    /**
     * Get salary
     *
     * @return float
     */
    public function getSalary()
    {
        return $this->salary;
    }

    /**
     * Set category
     *
     * @param string $category
     *
     * @return CoachData
     */
    public function setCategory($category)
    {
        $this->category = $category;

        return $this;
    }

    /**
     * Get category
     *
     * @return string
     */
    public function getCategory()
    {
        return $this->category;
    }

    /**
     * Set season
     *
     * @param integer $season
     *
     * @return CoachData
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
     *
     * @return CoachData
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
     * @var integer
     */
    private $number;


    /**
     * Set number
     *
     * @param integer $number
     *
     * @return CoachData
     */
    public function setNumber($number)
    {
        $this->number = $number;

        return $this;
    }

    /**
     * Get number
     *
     * @return integer
     */
    public function getNumber()
    {
        return $this->number;
    }
}
