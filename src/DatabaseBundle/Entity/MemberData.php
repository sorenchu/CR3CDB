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
     * @var \DatabaseBundle\Entity\MemberPerson
     */
    private $memberPerson;


    /**
     * Set memberPerson
     *
     * @param \DatabaseBundle\Entity\MemberPerson $memberPerson
     *
     * @return MemberData
     */
    public function setMemberPerson(\DatabaseBundle\Entity\MemberPerson $memberPerson = null)
    {
        $this->memberPerson = $memberPerson;

        return $this;
    }

    /**
     * Get memberPerson
     *
     * @return \DatabaseBundle\Entity\MemberPerson
     */
    public function getMemberPerson()
    {
        return $this->memberPerson;
    }
    /**
     * @var \DatabaseBundle\Entity\Pay
     */
    private $pay;

    /**
     * @var \DatabaseBundle\Entity\Date
     */
    private $dateData;


    /**
     * Set pay
     *
     * @param \DatabaseBundle\Entity\Pay $pay
     *
     * @return MemberData
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
     * Set dateData
     *
     * @param \DatabaseBundle\Entity\DateData $dateData
     *
     * @return MemberData
     */
    public function setDateData(\DatabaseBundle\Entity\DateData $dateData = null)
    {
        $this->dateData = $dateData;

        return $this;
    }

    /**
     * Get dateData
     *
     * @return \DatabaseBundle\Entity\Date
     */
    public function getDateData()
    {
        return $this->dateData;
    }
}
