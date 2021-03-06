<?php

namespace DatabaseBundle\Entity;

/**
 * PlayerData
 */
class PlayerData
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
     * @var string
     */
    private $category;

    /**
     * @var integer
     */
    private $number;

    /**
     * @var \Doctrine\Common\Collections\Collection
     */
    private $parentData;

    /**
     * @var \DatabaseBundle\Entity\Pay
     */
    private $pay;

    /**
     * Constructor
     */
    public function __construct()
    {
        $this->parentData = new \Doctrine\Common\Collections\ArrayCollection();
        $this->category = 'senior';
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
     * Set season
     *
     * @param integer $season
     *
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
     * Set category
     *
     * @param string $category
     *
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
     * Add parentDatum
     *
     * @param \DatabaseBundle\Entity\ParentData $parentDatum
     *
     * @return PlayerData
     */
    public function addParentDatum(\DatabaseBundle\Entity\ParentData $parentDatum)
    {
        $this->parentData[] = $parentDatum;

        return $this;
    }

    /**
     * Remove parentDatum
     *
     * @param \DatabaseBundle\Entity\ParentData $parentDatum
     */
    public function removeParentDatum(\DatabaseBundle\Entity\ParentData $parentDatum)
    {
        $this->parentData->removeElement($parentDatum);
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


    public function __toString()
    {
        return $this->getPlayerPerson()->getPersonalData()->getName().' '
                  .$this->getPlayerPerson()->getPersonalData()->getSurname();
    }


    /**
     * Set number
     *
     * @param integer $number
     *
     * @return PlayerData
     */
    public function setNumber($number)
    {
        $this->number = $number;

        return $this;
    }

    /**
     * Get number
     *
     * @return integer
     */
    public function getNumber()
    {
        return $this->number;
    }

    /**
     * Set pay
     *
     * @param \DatabaseBundle\Entity\Pay $pay
     *
     * @return PlayerData
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
     * @var \DatabaseBundle\Entity\PlayerPerson
     */
    private $playerPerson;


    /**
     * Set playerPerson
     *
     * @param \DatabaseBundle\Entity\PlayerPerson $playerPerson
     *
     * @return PlayerData
     */
    public function setPlayerPerson(\DatabaseBundle\Entity\PlayerPerson $playerPerson = null)
    {
        $this->playerPerson = $playerPerson;

        return $this;
    }

    /**
     * Get playerPerson
     *
     * @return \DatabaseBundle\Entity\PlayerPerson
     */
    public function getPlayerPerson()
    {
        return $this->playerPerson;
    }
    /**
     * @var \DatabaseBundle\Entity\Date
     */
    private $dateData;


    /**
     * Set dateData
     *
     * @param \DatabaseBundle\Entity\DateData $dateData
     *
     * @return PlayerData
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

    /**
     * Set category by season
     *
     * @return PlayerData
     */
    public function setCategoryBySeason($season)
    {
        $birthDate = $this->getPlayerPerson()->getPersonalData()->getBirthday();
        $seasonDate = new \DateTime($season->getStartingyear()."-12-31");
        $diff = abs(strtotime($seasonDate->format('Y-m-d')) -
                    strtotime($birthDate->format('Y-m-d')));
        $years = floor($diff / (365*24*60*60));
        if ($years >= 18)
            $this->setCategory('senior');
        elseif ($years >= 16)
            $this->setCategory('sub18');
        elseif ($years >= 14)
            $this->setCategory('sub16');
        elseif ($years >= 12)
            $this->setCategory('sub14');
        elseif ($years >= 10)
            $this->setCategory('sub12');
        elseif ($years >= 8)
            $this->setCategory('sub10');
        elseif ($years >= 6)
            $this->setCategory('sub8');
        else 
            $this->setCategory('sub6');

        return $this;
    }
}
