<?php

namespace DatabaseBundle\Entity;

/**
 * Authorization
 */
class Authorization
{
    /**
     * @var integer
     */
    private $id;

    /**
     * @var boolean
     */
    private $authorized;

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
     * Set authorized
     *
     * @param boolean $authorized
     *
     * @return Authorization
     */
    public function setAuthorized($authorized)
    {
        $this->authorized = $authorized;

        return $this;
    }

    /**
     * Get authorized
     *
     * @return boolean
     */
    public function getAuthorized()
    {
        return $this->authorized;
    }

    /**
     * Set personalData
     *
     * @param \DatabaseBundle\Entity\PersonalData $personalData
     *
     * @return Authorization
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
