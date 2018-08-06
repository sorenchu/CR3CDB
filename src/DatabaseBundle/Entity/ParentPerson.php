<?php

namespace DatabaseBundle\Entity;

/**
 * ParentPerson
 */
class ParentPerson
{
    /**
     * @var integer
     */
    private $id;

    /**
     * @var boolean
     */
    private $isParent;

    /**
     * @var \DatabaseBundle\Entity\ParentData
     */
    private $parentData;

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
     * Set isParent
     *
     * @param boolean $isParent
     *
     * @return ParentPerson
     */
    public function setIsParent($isParent)
    {
        $this->isParent = $isParent;

        return $this;
    }

    /**
     * Get isParent
     *
     * @return boolean
     */
    public function getIsParent()
    {
        return $this->isParent;
    }

    /**
     * Set parentData
     *
     * @param \DatabaseBundle\Entity\ParentData $parentData
     *
     * @return ParentPerson
     */
    public function setParentData(\DatabaseBundle\Entity\ParentData $parentData = null)
    {
        $this->parentData = $parentData;

        return $this;
    }

    /**
     * Get parentData
     *
     * @return \DatabaseBundle\Entity\ParentData
     */
    public function getParentData()
    {
        return $this->parentData;
    }

    /**
     * Set personalData
     *
     * @param \DatabaseBundle\Entity\PersonalData $personalData
     *
     * @return ParentPerson
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

