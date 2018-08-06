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
     * Get playerData by season
     * 
     * @return PlayerData
     */
    public function getPlayerDataBySeason($season)
    {
        foreach($this->playerData as $pd) {
          if ($pd->getSeason() == $season) {
              return $pd;
          } 
        }
        return NULL;
    }

    /**
     * Set playerData
     *
     * @param \DatabaseBundle\Entity\PlayerData $playerData
     *
     * @return PersonalData
     */
    public function setPlayerData(\DatabaseBundle\Entity\PlayerData $playerData = NULL)
    {
        $this->playerData = $playerData;

        return $this;
    }

    /**
     * Ask if player is present in the season
     *
     * @param $season
     *
     * @return boolean
     */
    public function playerIsInCurrentSeason($season) 
    {
      foreach ($this->playerData as $pd)
      {
        if ($pd->getSeason() == $season)
          return $pd;
      }
      return NULL;
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
     * Set coachData
     *
     * @param \DatabaseBundle\Entity\CoachData $coachData
     *
     * @return WholePerson
     */
    public function setCoachData(\DatabaseBundle\Entity\CoachData $coachData = NULL)
    {
        $this->coachData = $coachData;

        return $this;
    }

    /**
     * Ask if coach is present in the season
     *
     * @param $season
     *
     * @return boolean
     */
    public function coachIsInCurrentSeason($season)
    {
      foreach ($this->coachData as $pd)
      {
        if ($pd->getSeason() == $season)
          return $pd;
      }
      return NULL;
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
     * Set memberData
     *
     * @param \DatabaseBundle\Entity\MemberData $memberData
     *
     * @return WholePerson
     */
    public function setMemberData(\DatabaseBundle\Entity\MemberData $memberData = NULL)
    {
        $this->memberData = $memberData;

        return $this;
    }

    /**
     * Ask if member is present in the season
     *
     * @param $season
     *
     * @return boolean
     */
    public function memberIsInCurrentSeason($season)
    {
      foreach ($this->memberData as $pd)
      {
        if ($pd->getSeason() == $season)
          return $pd;
      }
      return NULL;
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

    /**
     * Set parentData
     *
     * @param \DatabaseBundle\Entity\ParentData $parentData
     *
     * @return WholePerson
     */
    public function setParentData(\DatabaseBundle\Entity\ParentData $parentData = NULL)
    {
        $this->parentData = $parentData;

        return $this;
    }

    /**
     * Ask if parent is present in the season
     *
     * @param $season
     *
     * @return boolean
     */
    public function parentIsInCurrentSeason($season)
    {
      foreach ($this->parentData as $pd)
      {
        if ($pd->getSeason() == $season)
          return $pd;
      }
      return NULL;
    }
    /**
     * @var \DatabaseBundle\Entity\Authorization
     */
    private $authorization;

    /**
     * @var \DatabaseBundle\Entity\ContactData
     */
    private $contactData;


    /**
     * Set authorization
     *
     * @param \DatabaseBundle\Entity\Authorization $authorization
     *
     * @return PersonalData
     */
    public function setAuthorization(\DatabaseBundle\Entity\Authorization $authorization = NULL)
    {
        $this->authorization = $authorization;

        return $this;
    }

    /**
     * Get authorization
     *
     * @return \DatabaseBundle\Entity\Authorization
     */
    public function getAuthorization()
    {
        return $this->authorization;
    }

    /**
     * Set contactData
     *
     * @param \DatabaseBundle\Entity\ContactData $contactData
     *
     * @return PersonalData
     */
    public function setContactData(\DatabaseBundle\Entity\ContactData $contactData = NULL)
    {
        $this->contactData = $contactData;

        return $this;
    }

    /**
     * Get contactData
     *
     * @return \DatabaseBundle\Entity\ContactData
     */
    public function getContactData()
    {
        return $this->contactData;
    }

    /**
     * @var \DatabaseBundle\Entity\CoachPerson
     */
    private $coachPerson;


    /**
     * Set coachPerson
     *
     * @param \DatabaseBundle\Entity\CoachPerson $coachPerson
     *
     * @return PersonalData
     */
    public function setCoachPerson(\DatabaseBundle\Entity\CoachPerson $coachPerson = null)
    {
        $this->coachPerson = $coachPerson;

        return $this;
    }

    /**
     * Get coachPerson
     *
     * @return \DatabaseBundle\Entity\CoachPerson
     */
    public function getCoachPerson()
    {
        return $this->coachPerson;
    }

    /**
     * Add coachPerson
     *
     * @param \DatabaseBundle\Entity\CoachPerson $coachPerson
     *
     * @return PersonalData
     */
    public function addCoachPerson(\DatabaseBundle\Entity\CoachPerson $coachPerson)
    {
        $this->coachPerson[] = $coachPerson;

        return $this;
    }

    /**
     * Remove coachPerson
     *
     * @param \DatabaseBundle\Entity\CoachPerson $coachPerson
     */
    public function removeCoachPerson(\DatabaseBundle\Entity\CoachPerson $coachPerson)
    {
        $this->coachPerson->removeElement($coachPerson);
    }
    /**
     * @var \Doctrine\Common\Collections\Collection
     */
    private $playerPerson;


    /**
     * Add playerPerson
     *
     * @param \DatabaseBundle\Entity\PlayerPerson $playerPerson
     *
     * @return PersonalData
     */
    public function addPlayerPerson(\DatabaseBundle\Entity\PlayerPerson $playerPerson)
    {
        $this->playerPerson[] = $playerPerson;

        return $this;
    }

    /**
     * Remove playerPerson
     *
     * @param \DatabaseBundle\Entity\PlayerPerson $playerPerson
     */
    public function removePlayerPerson(\DatabaseBundle\Entity\PlayerPerson $playerPerson)
    {
        $this->playerPerson->removeElement($playerPerson);
    }

    /**
     * Get playerPerson
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getPlayerPerson()
    {
        return $this->playerPerson;
    }
    /**
     * @var \Doctrine\Common\Collections\Collection
     */
    private $memberPerson;


    /**
     * Add memberPerson
     *
     * @param \DatabaseBundle\Entity\MemberPerson $memberPerson
     *
     * @return PersonalData
     */
    public function addMemberPerson(\DatabaseBundle\Entity\MemberPerson $memberPerson)
    {
        $this->memberPerson[] = $memberPerson;

        return $this;
    }

    /**
     * Remove memberPerson
     *
     * @param \DatabaseBundle\Entity\MemberPerson $memberPerson
     */
    public function removeMemberPerson(\DatabaseBundle\Entity\MemberPerson $memberPerson)
    {
        $this->memberPerson->removeElement($memberPerson);
    }

    /**
     * Get memberPerson
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getMemberPerson()
    {
        return $this->memberPerson;
    }
}
