<?php

namespace DatabaseBundle\Entity;

/**
 * PlayerData
 */
class PlayerData
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
     * @var float
     */
    private $payment;

    /**
     * @var string
     */
    private $category;

    /**
     * @var \DatabaseBundle\Entity\WholePerson
     */
    private $wholePerson;

    /**
     * @var \Doctrine\Common\Collections\Collection
     */
    private $parentData;

    /**
     * Constructor
     */
    public function __construct()
    {
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
     * Set season
     *
     * @param integer $season
     *
     * @return PlayerData
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
     * Set payment
     *
     * @param float $payment
     *
     * @return PlayerData
     */
    public function setPayment($payment)
    {
        $this->payment = $payment;

        return $this;
    }

    /**
     * Get payment
     *
     * @return float
     */
    public function getPayment()
    {
        return $this->payment;
    }

    /**
     * Set category
     *
     * @param string $category
     *
     * @return PlayerData
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
     * Set wholePerson
     *
     * @param \DatabaseBundle\Entity\WholePerson $wholePerson
     *
     * @return PlayerData
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

    /**
     * Add parentDatum
     *
     * @param \DatabaseBundle\Entity\ParentData $parentDatum
     *
     * @return PlayerData
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
        return $this->getPersonalData()->getName().' '
                  .$this->getPersonalData()->getSurname();
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
     * @return PlayerData
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
}
