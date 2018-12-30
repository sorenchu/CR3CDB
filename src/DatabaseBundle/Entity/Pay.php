<?php

namespace DatabaseBundle\Entity;

/**
 * Pay
 */
class Pay
{
    /**
     * @var integer
     */
    private $id;

    /**
     * @var string
     */
    private $wayOfPayment;

    /**
     * @var integer
     */
    private $totalAmount;

    /**
     * @var \DatabaseBundle\Entity\PlayerData
     */
    private $playerData;

    /**
     * @var \Doctrine\Common\Collections\Collection
     */
    private $payment;

    /**
     * @var string
     */
    private $person;

    /**
     * @var integer
     */
    private $accountNumber;

    /**
     * Constructor
     */
    public function __construct()
    {
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
     * Set wayOfPayment
     *
     * @param string $wayOfPayment
     *
     * @return Pay
     */
    public function setWayOfPayment($wayOfPayment)
    {
        $this->wayOfPayment = $wayOfPayment;

        return $this;
    }

    /**
     * Get wayOfPayment
     *
     * @return string
     */
    public function getWayOfPayment()
    {
        return $this->wayOfPayment;
    }

    /**
     * Set totalAmount
     *
     * @param integer $totalAmount
     *
     * @return Pay
     */
    public function setTotalAmount($totalAmount)
    {
        $this->totalAmount = $totalAmount;

        return $this;
    }

    /**
     * Get totalAmount
     *
     * @return integer
     */
    public function getTotalAmount()
    {
        return $this->totalAmount;
    }

    /**
     * Set playerData
     *
     * @param \DatabaseBundle\Entity\PlayerData $playerData
     *
     * @return Pay
     */
    public function setPlayerData(\DatabaseBundle\Entity\PlayerData $playerData = null)
    {
        $this->playerData = $playerData;

        return $this;
    }

    /**
     * Get playerData
     *
     * @return \DatabaseBundle\Entity\PlayerData
     */
    public function getPlayerData()
    {
        return $this->playerData;
    }

    /**
     * Add payment
     *
     * @param \DatabaseBundle\Entity\Payment $payment
     *
     * @return Pay
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
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getPayment()
    {
        return $this->payment;
    }

    /**
     * Set person
     *
     * @param string $person
     *
     * @return Pay
     */
    public function setPerson($person)
    {
        $this->person = $person;

        return $this;
    }

    /**
     * Get person
     *
     * @return string
     */
    public function getPerson()
    {
        return $this->person;
    }

    /**
     * Set accountNumber
     *
     * @param integer $accountNumber
     *
     * @return Pay
     */
    public function setAccountNumber($accountNumber)
    {
        $this->accountNumber = $accountNumber;

        return $this;
    }

    /**
     * Get accountNumber
     *
     * @return integer
     */
    public function getAccountNumber()
    {
        return $this->accountNumber;
    }
    /**
     * @var \DatabaseBundle\Entity\MemberData
     */
    private $memberData;


    /**
     * Set memberData
     *
     * @param \DatabaseBundle\Entity\MemberData $memberData
     *
     * @return Pay
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
     * @var \Doctrine\Common\Collections\Collection
     */
    private $activePayment;


    /**
     * Add activePayment.
     *
     * @param \DatabaseBundle\Entity\ActivePayment $activePayment
     *
     * @return Pay
     */
    public function addActivePayment(\DatabaseBundle\Entity\ActivePayment $activePayment)
    {
        $this->activePayment[] = $activePayment;

        return $this;
    }

    /**
     * Remove activePayment.
     *
     * @param \DatabaseBundle\Entity\ActivePayment $activePayment
     *
     * @return boolean TRUE if this collection contained the specified element, FALSE otherwise.
     */
    public function removeActivePayment(\DatabaseBundle\Entity\ActivePayment $activePayment)
    {
        return $this->activePayment->removeElement($activePayment);
    }

    /**
     * Get activePayment.
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getActivePayment()
    {
        return $this->activePayment;
    }
}
