<?php

namespace DatabaseBundle\Entity;

/**
 * MemberData
 */
class MemberData
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
     * @var integer
     */
    private $memberId;

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
     * Set season
     *
     * @param integer $season
     *
     * @return MemberData
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
     * @return MemberData
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
     * Set memberId
     *
     * @param integer $memberId
     *
     * @return MemberData
     */
    public function setMemberId($memberId)
    {
        $this->memberId = $memberId;

        return $this;
    }

    /**
     * Get memberId
     *
     * @return integer
     */
    public function getMemberId()
    {
        return $this->memberId;
    }

    /**
     * Set wholePerson
     *
     * @param \DatabaseBundle\Entity\WholePerson $wholePerson
     *
     * @return MemberData
     */
    public function setWholePerson(\DatabaseBundle\Entity\WholePerson $wholePerson)
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

