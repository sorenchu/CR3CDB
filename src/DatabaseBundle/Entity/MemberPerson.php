<?php

namespace DatabaseBundle\Entity;

/**
 * MemberPerson
 */
class MemberPerson
{
    /**
     * @var integer
     */
    private $id;

    /**
     * @var boolean
     */
    private $isMember;

    /**
     * @var \DatabaseBundle\Entity\MemberData
     */
    private $memberData;

    /**
     * @var \DatabaseBundle\Entity\PersonalData
     */
    private $personalData;


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
     * Set isMember
     *
     * @param boolean $isMember
     *
     * @return MemberPerson
     */
    public function setIsMember($isMember)
    {
        $this->isMember = $isMember;

        return $this;
    }

    /**
     * Get isMember
     *
     * @return boolean
     */
    public function getIsMember()
    {
        return $this->isMember;
    }

    /**
     * Set memberData
     *
     * @param \DatabaseBundle\Entity\MemberData $memberData
     *
     * @return MemberPerson
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
     * Set personalData
     *
     * @param \DatabaseBundle\Entity\PersonalData $personalData
     *
     * @return MemberPerson
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
}
