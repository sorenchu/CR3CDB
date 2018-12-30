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
    /**
     * @var \DatabaseBundle\Entity\PaymentHistory
     */
    private $paymentHistory;


    /**
     * Set paymentHistory.
     *
     * @param \DatabaseBundle\Entity\PaymentHistory|null $paymentHistory
     *
     * @return Payment
     */
    public function setPaymentHistory(\DatabaseBundle\Entity\PaymentHistory $paymentHistory = null)
    {
        $this->paymentHistory = $paymentHistory;

        return $this;
    }

    /**
     * Get paymentHistory.
     *
     * @return \DatabaseBundle\Entity\PaymentHistory|null
     */
    public function getPaymentHistory()
    {
        return $this->paymentHistory;
    }

    public function compareWithArray($compared)
    {
        if ($compared['id'] != $this->id 
            or $compared['pay_id'] != $this->pay->getId()
            or $compared['paymentHistory_id'] != $this->paymentHistory->getId()
            or $compared['paymentDate'] != $this->paymentDate
            or $compared['amountPayed'] != $this->amountPayed
            or $compared['status'] != $this->status)
            return false;
        return true;
    }
    /**
     * @var \DatabaseBundle\Entity\ActivePayment
     */
    private $activePayment;


    /**
     * Set activePayment.
     *
     * @param \DatabaseBundle\Entity\ActivePayment|null $activePayment
     *
     * @return Payment
     */
    public function setActivePayment(\DatabaseBundle\Entity\ActivePayment $activePayment = null)
    {
        $this->activePayment = $activePayment;

        return $this;
    }

    /**
     * Get activePayment.
     *
     * @return \DatabaseBundle\Entity\ActivePayment|null
     */
    public function getActivePayment()
    {
        return $this->activePayment;
    }
}
