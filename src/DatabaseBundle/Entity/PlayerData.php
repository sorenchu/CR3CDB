<?php

namespace DatabaseBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * PlayerData
 */
class PlayerData
{
    /**
     * @var int
     */
    private $id;

    /**
     * @var int
     */
    private $season;

    /**
     * @var float
     */
    private $payment;

    /**
     * @var string
     */
    private $category;


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
     * @return PlayerData
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
     * @return PlayerData
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
     * Set category
     *
     * @param string $category
     * @return PlayerData
     */
    public function setCategory($category)
    {
        $this->category = $category;

        return $this;
    }

    /**
     * Get category
     *
     * @return string 
     */
    public function getCategory()
    {
        return $this->category;
    }
    /**
     * @var \DatabaseBundle\Entity\PersonalData
     */
    private $personalData;


    /**
     * Set personalData
     *
     * @param \DatabaseBundle\Entity\PersonalData $personalData
     * @return PlayerData
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
    /**
     * @var boolean
     */
    private $isPlayer;


    /**
     * Set isPlayer
     *
     * @param boolean $isPlayer
     * @return PlayerData
     */
    public function setIsPlayer($isPlayer)
    {
        $this->isPlayer = $isPlayer;

        return $this;
    }

    /**
     * Get isPlayer
     *
     * @return boolean 
     */
    public function getIsPlayer()
    {
        return $this->isPlayer;
    }
    /**
     * @var \Doctrine\Common\Collections\Collection
     */
    private $parentData;

    /**
     * Constructor
     */
    public function __construct()
    {
        $this->parentData = new \Doctrine\Common\Collections\ArrayCollection();
    }

    /**
     * Add parentData
     *
     * @param \DatabaseBundle\Entity\ParentData $parentData
     * @return PlayerData
     */
    public function addParentDatum(\DatabaseBundle\Entity\ParentData $parentData)
    {
        $this->parentData[] = $parentData;

        return $this;
    }

    /**
     * Remove parentData
     *
     * @param \DatabaseBundle\Entity\ParentData $parentData
     */
    public function removeParentDatum(\DatabaseBundle\Entity\ParentData $parentData)
    {
        $this->parentData->removeElement($parentData);
    }

    /**
     * Get parentData
     *
     * @return \Doctrine\Common\Collections\Collection 
     */
    public function getParentData()
    {
        return $this->parentData;
    }
    /**
     * @var \Doctrine\Common\Collections\Collection
     */
    private $childrenParentData;


    /**
     * Add childrenParentData
     *
     * @param \DatabaseBundle\Entity\ParentData $childrenParentData
     * @return PlayerData
     */
    public function addChildrenParentDatum(\DatabaseBundle\Entity\ParentData $childrenParentData)
    {
        $this->childrenParentData[] = $childrenParentData;

        return $this;
    }

    /**
     * Remove childrenParentData
     *
     * @param \DatabaseBundle\Entity\ParentData $childrenParentData
     */
    public function removeChildrenParentDatum(\DatabaseBundle\Entity\ParentData $childrenParentData)
    {
        $this->childrenParentData->removeElement($childrenParentData);
    }

    /**
     * Get childrenParentData
     *
     * @return \Doctrine\Common\Collections\Collection 
     */
    public function getChildrenParentData()
    {
        return $this->childrenParentData;
    }
}
