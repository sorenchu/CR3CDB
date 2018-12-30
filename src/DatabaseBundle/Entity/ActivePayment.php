<?php

namespace DatabaseBundle\Entity;

/**
 * ActivePayment
 */
class ActivePayment
{
    /**
     * @var int
     */
    private $id;

    /**
     * @var \DatabaseBundle\Entity\Payment
     */
    private $payment;

    /**
     * @var \DatabaseBundle\Entity\Pay
     */
    private $pay;


    /**
     * Get id.
     *
     * @return int
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * Set payment.
     *
     * @param \DatabaseBundle\Entity\Payment|null $payment
     *
     * @return ActivePayment
     */
    public function setPayment(\DatabaseBundle\Entity\Payment $payment = null)
    {
        $this->payment = $payment;

        return $this;
    }

    /**
     * Get payment.
     *
     * @return \DatabaseBundle\Entity\Payment|null
     */
    public function getPayment()
    {
        return $this->payment;
    }

    /**
     * Set pay.
     *
     * @param \DatabaseBundle\Entity\Pay|null $pay
     *
     * @return ActivePayment
     */
    public function setPay(\DatabaseBundle\Entity\Pay $pay = null)
    {
        $this->pay = $pay;

        return $this;
    }

    /**
     * Get pay.
     *
     * @return \DatabaseBundle\Entity\Pay|null
     */
    public function getPay()
    {
        return $this->pay;
    }
}
