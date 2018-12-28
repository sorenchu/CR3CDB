<?php

namespace DatabaseBundle\Entity;

/**
 * PaymentHistory
 */
class PaymentHistory
{
    /**
     * @var int
     */
    private $id;

    /**
     * @var bool
     */
    private $active;

    /**
     * @var \DatabaseBundle\Entity\Payment
     */
    private $payment;


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
     * Set active.
     *
     * @param bool $active
     *
     * @return PaymentHistory
     */
    public function setActive($active)
    {
        $this->active = $active;

        return $this;
    }

    /**
     * Get active.
     *
     * @return bool
     */
    public function getActive()
    {
        return $this->active;
    }

    /**
     * Set payment.
     *
     * @param \DatabaseBundle\Entity\Payment|null $payment
     *
     * @return PaymentHistory
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
     * Constructor
     */
    public function __construct()
    {
        $this->payment = new \Doctrine\Common\Collections\ArrayCollection();
    }

    /**
     * Add payment.
     *
     * @param \DatabaseBundle\Entity\Payment $payment
     *
     * @return PaymentHistory
     */
    public function addPayment(\DatabaseBundle\Entity\Payment $payment)
    {
        $this->payment[] = $payment;

        return $this;
    }

    /**
     * Remove payment.
     *
     * @param \DatabaseBundle\Entity\Payment $payment
     *
     * @return boolean TRUE if this collection contained the specified element, FALSE otherwise.
     */
    public function removePayment(\DatabaseBundle\Entity\Payment $payment)
    {
        return $this->payment->removeElement($payment);
    }
}
