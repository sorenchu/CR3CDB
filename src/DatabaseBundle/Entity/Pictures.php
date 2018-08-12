<?php

namespace DatabaseBundle\Entity;

/**
 * Pictures
 */
class Pictures
{
    /**
     * @var integer
     */
    private $id;


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
     * @var file
     */
    private $frontDni;


    /**
     * Set frontDni
     *
     * @param \file $frontDni
     *
     * @return Pictures
     */
    public function setFrontDni(\file $frontDni)
    {
        $this->frontDni = $frontDni;

        return $this;
    }

    /**
     * Get frontDni
     *
     * @return \file
     */
    public function getFrontDni()
    {
        return $this->frontDni;
    }
    /**
     * @var string
     */
    private $backDni;

    /**
     * @var string
     */
    private $healthCareCard;

    /**
     * @var string
     */
    private $familyBook;

    /**
     * @var \DatabaseBundle\Entity\PersonalData
     */
    private $personalData;


    /**
     * Set backDni
     *
     * @param string $backDni
     *
     * @return Pictures
     */
    public function setBackDni($backDni)
    {
        $this->backDni = $backDni;

        return $this;
    }

    /**
     * Get backDni
     *
     * @return string
     */
    public function getBackDni()
    {
        return $this->backDni;
    }

    /**
     * Set healthCareCard
     *
     * @param string $healthCareCard
     *
     * @return Pictures
     */
    public function setHealthCareCard($healthCareCard)
    {
        $this->healthCareCard = $healthCareCard;

        return $this;
    }

    /**
     * Get healthCareCard
     *
     * @return string
     */
    public function getHealthCareCard()
    {
        return $this->healthCareCard;
    }

    /**
     * Set familyBook
     *
     * @param string $familyBook
     *
     * @return Pictures
     */
    public function setFamilyBook($familyBook)
    {
        $this->familyBook = $familyBook;

        return $this;
    }

    /**
     * Get familyBook
     *
     * @return string
     */
    public function getFamilyBook()
    {
        return $this->familyBook;
    }

    /**
     * Set personalData
     *
     * @param \DatabaseBundle\Entity\PersonalData $personalData
     *
     * @return Pictures
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
