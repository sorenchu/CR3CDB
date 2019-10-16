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
     * @var \DatabaseBundle\Entity\Pictures
     */
    private $pictures;

    /**
     * Constructor
     */
    public function __construct()
    {
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
     * Get playerData by season
     * 
     * @return PlayerData
     */
    public function getPlayerDataBySeason($season)
    {
        foreach($this->getPlayerPerson() as $pd) {
          if ($pd->getPlayerData()->getSeason() == $season) {
              return $pd->getPlayerData();
          } 
        }
        return NULL;
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
      foreach ($this->getPlayerPerson() as $pd)
      {
        if ($pd->getPlayerData()->getSeason() == $season)
          return $pd->getPlayerData();
      }
      return NULL;
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
      foreach ($this->getCoachPerson() as $pd)
      {
        if ($pd->getCoachData()->getSeason() == $season)
          return $pd;
      }
      return NULL;
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
      foreach ($this->getMemberPerson as $pd)
      {
        if ($pd->getMemberData()->getSeason() == $season)
          return $pd;
      }
      return NULL;
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
      foreach ($this->getParentPerson() as $pd)
      {
        if ($pd->getParentData()->getSeason() == $season)
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
    /**
     * @var \Doctrine\Common\Collections\Collection
     */
    private $parentPerson;


    /**
     * Add parentPerson
     *
     * @param \DatabaseBundle\Entity\ParentPerson $parentPerson
     *
     * @return PersonalData
     */
    public function addParentPerson(\DatabaseBundle\Entity\ParentPerson $parentPerson)
    {
        $this->parentPerson[] = $parentPerson;

        return $this;
    }

    /**
     * Remove parentPerson
     *
     * @param \DatabaseBundle\Entity\ParentPerson $parentPerson
     */
    public function removeParentPerson(\DatabaseBundle\Entity\ParentPerson $parentPerson)
    {
        $this->parentPerson->removeElement($parentPerson);
    }

    /**
     * Get parentPerson
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getParentPerson()
    {
        return $this->parentPerson;
    }

    /**
     * Set pictures
     *
     * @param \DatabaseBundle\Entity\Pictures $pictures
     *
     * @return PersonalData
     */
    public function setPictures(\DatabaseBundle\Entity\Pictures $pictures = null)
    {
        $this->pictures = $pictures;

        return $this;
    }

    /**
     * Get pictures
     *
     * @return \DatabaseBundle\Entity\Pictures
     */
    public function getPictures()
    {
        return $this->pictures;
    }
    /**
     * @var \Doctrine\Common\Collections\Collection
     */
    private $journal;


    /**
     * Add journal.
     *
     * @param \DatabaseBundle\Entity\Journal $journal
     *
     * @return PersonalData
     */
    public function addJournal(\DatabaseBundle\Entity\Journal $journal)
    {
        $this->journal[] = $journal;

        return $this;
    }

    /**
     * Remove journal.
     *
     * @param \DatabaseBundle\Entity\Journal $journal
     *
     * @return boolean TRUE if this collection contained the specified element, FALSE otherwise.
     */
    public function removeJournal(\DatabaseBundle\Entity\Journal $journal)
    {
        return $this->journal->removeElement($journal);
    }

    /**
     * Get journal.
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getJournal()
    {
        return $this->journal;
    }

    public function getInitialJournal($season)
    {
	$entries = $this->getJournalEntriesBySeason($season);
        $initialEntries = array();
        
        $init = sizeof($entries) > 4 ?
                    sizeof($entries)-4
                    : 0;
        $end = sizeof($entries);
        while ($end > $init) {
            $end--;
            $initialEntries[] = $entries[$end];
        }
        return $initialEntries;
    }

    public function hasJournal($journal)
    {
        foreach ($this->journal as $j) {
            if ($journal == $j)
                return true;
        }
        return false;
    }

    public function getJournalEntriesBySeason($season)
    {
        $entries = array();
        foreach ($this->journal as $j) {
            if ($j->getSeason() == $season) {
                $entries[] = $j;
            }
        }
        return $entries;
    }

    public function getJournalEntryByPosition($position, $season) {
        $entries = $this->getJournalEntriesBySeason($season);
        foreach ($entries as $entry) {
            if ($entry->getPosition() == $position) {
                return $entry;
            }
        }
        return null;
    }
}
