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
    private $status;

    /**
     * @var \DatabaseBundle\Entity\Pay
     */
    private $pay;

    /**
     * @var float
     */
    private $amountPayed;

    /**
     * @var \DateTime
     */
    private $paymentDate;

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
     * Set status
     *
     * @param string $status
     *
     * @return Payment
     */
    public function setStatus($status)
    {
        $this->status = $status;

        return $this;
    }

    /**
     * Get status
     *
     * @return string
     */
    public function getStatus()
    {
        return $this->status;
    }

    /**
     * Set pay
     *
     * @param \DatabaseBundle\Entity\Pay $pay
     *
     * @return Payment
     */
    public function setPay(\DatabaseBundle\Entity\Pay $pay = null)
    {
        $this->pay = $pay;

        return $this;
    }

    /**
     * Get pay
     *
     * @return \DatabaseBundle\Entity\Pay
     */
    public function getPay()
    {
        return $this->pay;
    }
}
