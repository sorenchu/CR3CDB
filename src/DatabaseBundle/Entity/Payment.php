<?php

namespace DatabaseBundle\Entity;

/**
 * Payment
 */
class Payment
{
    /**
     * @var integer
     */
    private $id;

    /**
     * @var string
     */
    private $wayOfPay;

    /**
     * @var float
     */
    private $amountOwned;

    /**
     * @var float
     */
    private $amountPayed;

    /**
     * @var \DateTime
     */
    private $paymentDate;

    /**
     * @var \DatabaseBundle\Entity\PlayerData
     */
    private $playerData;


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
     * Set wayOfPay
     *
     * @param string $wayOfPay
     *
     * @return Payment
     */
    public function setWayOfPay($wayOfPay)
    {
        $this->wayOfPay = $wayOfPay;

        return $this;
    }

    /**
     * Get wayOfPay
     *
     * @return string
     */
    public function getWayOfPay()
    {
        return $this->wayOfPay;
    }

    /**
     * Set amountOwned
     *
     * @param float $amountOwned
     *
     * @return Payment
     */
    public function setAmountOwned($amountOwned)
    {
        $this->amountOwned = $amountOwned;

        return $this;
    }

    /**
     * Get amountOwned
     *
     * @return float
     */
    public function getAmountOwned()
    {
        return $this->amountOwned;
    }

    /**
     * Set amountPayed
     *
     * @param float $amountPayed
     *
     * @return Payment
     */
    public function setAmountPayed($amountPayed)
    {
        $this->amountPayed = $amountPayed;

        return $this;
    }

    /**
     * Get amountPayed
     *
     * @return float
     */
    public function getAmountPayed()
    {
        return $this->amountPayed;
    }

    /**
     * Set paymentDate
     *
     * @param \DateTime $paymentDate
     *
     * @return Payment
     */
    public function setPaymentDate($paymentDate)
    {
        $this->paymentDate = $paymentDate;

        return $this;
    }

    /**
     * Get paymentDate
     *
     * @return \DateTime
     */
    public function getPaymentDate()
    {
        return $this->paymentDate;
    }

    /**
     * Set playerData
     *
     * @param \DatabaseBundle\Entity\PlayerData $playerData
     *
     * @return Payment
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
}

