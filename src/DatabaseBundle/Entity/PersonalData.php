<?php

namespace DatabaseBundle\Entity;

/**
 * PersonalData
 */
class PersonalData
{
    /**
     * @var integer
     */
    private $id;

    /**
     * @var string
     */
    private $name;

    /**
     * @var string
     */
    private $surname;

    /**
     * @var string
     */
    private $nickname;

    /**
     * @var string
     */
    private $email;

    /**
     * @var integer
     */
    private $phone;

    /**
     * @var string
     */
    private $dni;

    /**
     * @var \DateTime
     */
    private $birthday;

    /**
     * @var string
     */
    private $sex;

    /**
     * @var boolean
     */
    private $isPlayer;

    /**
     * @var boolean
     */
    private $isCoach;

    /**
     * @var boolean
     */
    private $isMember;

    /**
     * @var boolean
     */
    private $isParent;

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
     * Set name
     *
     * @param string $name
     *
     * @return PersonalData
     */
    public function setName($name)
    {
        $this->name = $name;

        return $this;
    }

    /**
     * Get name
     *
     * @return string
     */
    public function getName()
    {
        return $this->name;
    }

    /**
     * Set surname
     *
     * @param string $surname
     *
     * @return PersonalData
     */
    public function setSurname($surname)
    {
        $this->surname = $surname;

        return $this;
    }

    /**
     * Get surname
     *
     * @return string
     */
    public function getSurname()
    {
        return $this->surname;
    }

    /**
     * Set nickname
     *
     * @param string $nickname
     *
     * @return PersonalData
     */
    public function setNickname($nickname)
    {
        $this->nickname = $nickname;

        return $this;
    }

    /**
     * Get nickname
     *
     * @return string
     */
    public function getNickname()
    {
        return $this->nickname;
    }

    /**
     * Set email
     *
     * @param string $email
     *
     * @return PersonalData
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
     * Set phone
     *
     * @param integer $phone
     *
     * @return PersonalData
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
     * Set dni
     *
     * @param string $dni
     *
     * @return PersonalData
     */
    public function setDni($dni)
    {
        $this->dni = $dni;

        return $this;
    }

    /**
     * Get dni
     *
     * @return string
     */
    public function getDni()
    {
        return $this->dni;
    }

    /**
     * Set birthday
     *
     * @param \DateTime $birthday
     *
     * @return PersonalData
     */
    public function setBirthday($birthday)
    {
        $this->birthday = $birthday;

        return $this;
    }

    /**
     * Get birthday
     *
     * @return \DateTime
     */
    public function getBirthday()
    {
        return $this->birthday;
    }

    /**
     * Set sex
     *
     * @param string $sex
     *
     * @return PersonalData
     */
    public function setSex($sex)
    {
        $this->sex = $sex;

        return $this;
    }

    /**
     * Get sex
     *
     * @return string
     */
    public function getSex()
    {
        return $this->sex;
    }

    /**
     * Set isPlayer
     *
     * @param boolean $isPlayer
     *
     * @return PersonalData
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
     * Set isCoach
     *
     * @param boolean $isCoach
     *
     * @return PersonalData
     */
    public function setIsCoach($isCoach)
    {
        $this->isCoach = $isCoach;

        return $this;
    }

    /**
     * Get isCoach
     *
     * @return boolean
     */
    public function getIsCoach()
    {
        return $this->isCoach;
    }

    /**
     * Set isMember
     *
     * @param boolean $isMember
     *
     * @return PersonalData
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
     * Set isParent
     *
     * @param boolean $isParent
     *
     * @return PersonalData
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
     * Set wholePerson
     *
     * @param \DatabaseBundle\Entity\WholePerson $wholePerson
     *
     * @return PersonalData
     */
    public function setWholePerson(\DatabaseBundle\Entity\WholePerson $wholePerson = null)
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
    /**
     * @var \Doctrine\Common\Collections\Collection
     */
    private $playerData;

    /**
     * @var \Doctrine\Common\Collections\Collection
     */
    private $coachData;

    /**
     * @var \Doctrine\Common\Collections\Collection
     */
    private $memberData;

    /**
     * @var \Doctrine\Common\Collections\Collection
     */
    private $parentData;

    /**
     * Constructor
     */
    public function __construct()
    {
        $this->playerData = new \Doctrine\Common\Collections\ArrayCollection();
        $this->coachData = new \Doctrine\Common\Collections\ArrayCollection();
        $this->memberData = new \Doctrine\Common\Collections\ArrayCollection();
        $this->parentData = new \Doctrine\Common\Collections\ArrayCollection();
    }

    /**
     * Add playerDatum
     *
     * @param \DatabaseBundle\Entity\PlayerData $playerDatum
     *
     * @return PersonalData
     */
    public function addPlayerDatum(\DatabaseBundle\Entity\PlayerData $playerDatum)
    {
        $this->playerData[] = $playerDatum;

        return $this;
    }

    /**
     * Remove playerDatum
     *
     * @param \DatabaseBundle\Entity\PlayerData $playerDatum
     */
    public function removePlayerDatum(\DatabaseBundle\Entity\PlayerData $playerDatum)
    {
        $this->playerData->removeElement($playerDatum);
    }

    /**
     * Get playerData
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getPlayerData()
    {
        return $this->playerData;
    }

    /**
     * Add coachDatum
     *
     * @param \DatabaseBundle\Entity\CoachData $coachDatum
     *
     * @return PersonalData
     */
    public function addCoachDatum(\DatabaseBundle\Entity\CoachData $coachDatum)
    {
        $this->coachData[] = $coachDatum;

        return $this;
    }

    /**
     * Remove coachDatum
     *
     * @param \DatabaseBundle\Entity\CoachData $coachDatum
     */
    public function removeCoachDatum(\DatabaseBundle\Entity\CoachData $coachDatum)
    {
        $this->coachData->removeElement($coachDatum);
    }

    /**
     * Get coachData
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getCoachData()
    {
        return $this->coachData;
    }

    /**
     * Add memberDatum
     *
     * @param \DatabaseBundle\Entity\MemberData $memberDatum
     *
     * @return PersonalData
     */
    public function addMemberDatum(\DatabaseBundle\Entity\MemberData $memberDatum)
    {
        $this->memberData[] = $memberDatum;

        return $this;
    }

    /**
     * Remove memberDatum
     *
     * @param \DatabaseBundle\Entity\MemberData $memberDatum
     */
    public function removeMemberDatum(\DatabaseBundle\Entity\MemberData $memberDatum)
    {
        $this->memberData->removeElement($memberDatum);
    }

    /**
     * Get memberData
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getMemberData()
    {
        return $this->memberData;
    }

    /**
     * Add parentDatum
     *
     * @param \DatabaseBundle\Entity\ParentData $parentDatum
     *
     * @return PersonalData
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
}
