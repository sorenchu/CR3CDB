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
     * @var string
     */
    private $category;

    /**
     * @var \Doctrine\Common\Collections\Collection
     */
    private $parentData;

    private $payment;

    /**
     * Constructor
     */
    public function __construct()
    {
        $this->parentData = new \Doctrine\Common\Collections\ArrayCollection();
        $this->payment = new \Doctrine\Common\Collections\ArrayCollection();
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
    /**
     * @var integer
     */
    private $number;


    /**
     * Set number
     *
     * @param integer $number
     *
     * @return PlayerData
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
     * Add payment
     *
     * @param \DatabaseBundle\Entity\Payment $payment
     *
     * @return PlayerData
     */
    public function addPayment(\DatabaseBundle\Entity\Payment $payment)
    {
        $this->payment[] = $payment;

        return $this;
    }

    /**
     * Remove payment
     *
     * @param \DatabaseBundle\Entity\Payment $payment
     */
    public function removePayment(\DatabaseBundle\Entity\Payment $payment)
    {
        $this->payment->removeElement($payment);
    }


    /**
     * Get payment
     *
     * @return Integer
     */
    public function getPayment() 
    {
        return $this->payment;
    }

    /**
     * Set payment
     *
     * @param \DatabaseBundle\Entity\Payment $payment
     */
    public function setPayment(\DatabaseBundle\Entity\Payment $payment = null)
    {
      $this->payment = $payment;

      return $this;
    }

    public function getAmountPayed()
    {
        $amountPayed = 0;
        foreach($this->payment as $payment) {
            $amountPayed += $payment->getAmountPayed();
        }
        return $amountPayed;
    }
}
