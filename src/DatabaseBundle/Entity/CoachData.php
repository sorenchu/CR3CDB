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

    /**
     * @var \DatabaseBundle\Entity\CoachPerson
     */
    private $coachPerson;


    /**
     * Set coachPerson
     *
     * @param \DatabaseBundle\Entity\CoachPerson $coachPerson
     *
     * @return CoachData
     */
    public function setCoachPerson(\DatabaseBundle\Entity\CoachPerson $coachPerson = null)
    {
        $this->coachPerson = $coachPerson;

        return $this;
    }

    /**
     * Get coachPerson
     *
     * @return \DatabaseBundle\Entity\CoachPerson
     */
    public function getCoachPerson()
    {
        return $this->coachPerson;
    }
    /**
     * @var \DatabaseBundle\Entity\Date
     */
    private $dateData;


    /**
     * Set dateData
     *
     * @param \DatabaseBundle\Entity\DateData $dateData
     *
     * @return CoachData
     */
    public function setDateData(\DatabaseBundle\Entity\DateData $dateData = null)
    {
        $this->dateData = $dateData;

        return $this;
    }

    /**
     * Get dateData
     *
     * @return \DatabaseBundle\Entity\Date
     */
    public function getDateData()
    {
        return $this->dateData;
    }
}
