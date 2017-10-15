<?php

namespace DatabaseBundle\Entity;

/**
 * ContactData
 */
class ContactData
{
    /**
     * @var integer
     */
    private $id;

    /**
     * @var string
     */
    private $address;

    /**
     * @var string
     */
    private $city;

    /**
     * @var integer
     */
    private $zipcode;

    /**
     * @var string
     */
    private $province;

    /**
     * @var integer
     */
    private $phone;

    /**
     * @var string
     */
    private $email;

    /**
     * @var \Doctrine\Common\Collections\Collection
     */
    private $personalData;

    /**
     * Constructor
     */
    public function __construct()
    {
        $this->personalData = new \Doctrine\Common\Collections\ArrayCollection();
    }

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
     * Set address
     *
     * @param string $address
     *
     * @return ContactData
     */
    public function setAddress($address)
    {
        $this->address = $address;

        return $this;
    }

    /**
     * Get address
     *
     * @return string
     */
    public function getAddress()
    {
        return $this->address;
    }

    /**
     * Set city
     *
     * @param string $city
     *
     * @return ContactData
     */
    public function setCity($city)
    {
        $this->city = $city;

        return $this;
    }

    /**
     * Get city
     *
     * @return string
     */
    public function getCity()
    {
        return $this->city;
    }

    /**
     * Set zipcode
     *
     * @param integer $zipcode
     *
     * @return ContactData
     */
    public function setZipcode($zipcode)
    {
        $this->zipcode = $zipcode;

        return $this;
    }

    /**
     * Get zipcode
     *
     * @return integer
     */
    public function getZipcode()
    {
        return $this->zipcode;
    }

    /**
     * Set province
     *
     * @param string $province
     *
     * @return ContactData
     */
    public function setProvince($province)
    {
        $this->province = $province;

        return $this;
    }

    /**
     * Get province
     *
     * @return string
     */
    public function getProvince()
    {
        return $this->province;
    }

    /**
     * Set phone
     *
     * @param integer $phone
     *
     * @return ContactData
     */
    public function setPhone($phone)
    {
        $this->phone = $phone;

        return $this;
    }

    /**
     * Get phone
     *
     * @return integer
     */
    public function getPhone()
    {
        return $this->phone;
    }

    /**
     * Set email
     *
     * @param string $email
     *
     * @return ContactData
     */
    public function setEmail($email)
    {
        $this->email = $email;

        return $this;
    }

    /**
     * Get email
     *
     * @return string
     */
    public function getEmail()
    {
        return $this->email;
    }

    /**
     * Add personalDatum
     *
     * @param \DatabaseBundle\Entity\PersonalData $personalDatum
     *
     * @return ContactData
     */
    public function addPersonalDatum(\DatabaseBundle\Entity\PersonalData $personalDatum)
    {
        $this->personalData[] = $personalDatum;

        return $this;
    }

    /**
     * Remove personalDatum
     *
     * @param \DatabaseBundle\Entity\PersonalData $personalDatum
     */
    public function removePersonalDatum(\DatabaseBundle\Entity\PersonalData $personalDatum)
    {
        $this->personalData->removeElement($personalDatum);
    }

    /**
     * Get personalData
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getPersonalData()
    {
        return $this->personalData;
    }
}
