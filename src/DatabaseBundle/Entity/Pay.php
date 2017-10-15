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
}
