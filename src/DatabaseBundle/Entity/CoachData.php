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
     * @var \DatabaseBundle\Entity\WholePerson
     */
    private $wholePerson;


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
     * Set wholePerson
     *
     * @param \DatabaseBundle\Entity\WholePerson $wholePerson
     *
     * @return CoachData
     */
    public function setWholePerson(\DatabaseBundle\Entity\WholePerson $wholePerson = null)
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
}
