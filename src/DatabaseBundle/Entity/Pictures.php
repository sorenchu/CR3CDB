<?php

use Symfony\Component\HttpFoundation\File\File;

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
     * @var File
     */
    private $frontDni;

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
     * Get id
     *
     * @return integer
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * Set frontDni
     *
     * @param \File $frontDni
     *
     * @return Pictures
     */
    public function setFrontDni(\Symfony\Component\HttpFoundation\File\UploadedFile $frontDni)
    {
        $this->frontDni = $frontDni;

        return $this;
    }

    /**
     * Get frontDni
     *
     * @return \File
     */
    public function getFrontDni()
    {
        return $this->frontDni;
    }

    public function getFrontDniName()
    {
        return '/'.$this->getName($this->frontDni);
    }

    public function getBackDniName()
    {
        return '/'.$this->getName($this->backDni);
    }

    public function getHealthCareCardName()
    {
        return '/'.$this->getName($this->healthCareCard);
    }

    public function getFamilyBookName()
    {
        return '/'.$this->getName($this->familyBook);
    }

    private function getName($name)
    {
        $split = explode('/', $name);
        $lastElement = sizeof($split)-1;
        return $split[$lastElement];
    }

    /**
     * Set backDni
     *
     * @param string $backDni
     *
     * @return Pictures
     */
    public function setBackDni(\Symfony\Component\HttpFoundation\File\UploadedFile $backDni)
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
    public function setHealthCareCard(\Symfony\Component\HttpFoundation\File\UploadedFile $healthCareCard)
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
    public function setFamilyBook(\Symfony\Component\HttpFoundation\File\UploadedFile $familyBook)
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
