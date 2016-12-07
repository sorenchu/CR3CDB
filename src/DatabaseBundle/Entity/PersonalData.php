<?php

namespace DatabaseBundle\Entity;

use Symfony\Component\Validator\Constraints as Assert;

use Doctrine\ORM\Mapping as ORM;

/**
 * PersonalData
 */
class PersonalData
{
    /**
     * @var int
     */
    private $id;

    /**
     * @var string
     * @Assert\NotBlank()
     */
    private $name;

    /**
     * @var string
     * @Assert\NotBlank()
     */
    private $surname;

    /**
     * @var string
     */
    private $nickname;

    /**
     * @var string
     * @Assert\Email()
     */
    private $email;

    /**
     * @var int
     */
    private $phone;

    /**
     * @var string
     */
    private $dni;

    /**
     * @var bool
     */
    private $sex;

    /**
     * @var \DateTime
     * @Assert\Type("\DateTime")
     */
    private $birthday;


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
     * Set sex
     *
     * @param string $sex
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
     * Set birthday
     *
     * @param \DateTime $birthday
     * @return PersonalData
     */
    public function setBirthday(\DateTime $birthday)
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
     * @var \DatabaseBundle\Entity\PlayerData
     */
    private $playerData;


    /**
     * Set playerData
     *
     * @param \DatabaseBundle\Entity\PlayerData $playerData
     * @return PersonalData
     */
    public function setPlayerData(\DatabaseBundle\Entity\PlayerData $playerData = null)
    {
        $this->playerData = $playerData;

        return $this;
    }

    /**
     * Get playerData
     *
     * @return \DatabaseBundle\Entity\PlayerData 
     */
    public function getPlayerData()
    {
        return $this->playerData;
    }
    /**
     * @var \DatabaseBundle\Entity\CoachData
     */
    private $coachData;


    /**
     * Set coachData
     *
     * @param \DatabaseBundle\Entity\CoachData $coachData
     * @return PersonalData
     */
    public function setCoachData(\DatabaseBundle\Entity\CoachData $coachData = null)
    {
        $this->coachData = $coachData;

        return $this;
    }

    /**
     * Get coachData
     *
     * @return \DatabaseBundle\Entity\CoachData 
     */
    public function getCoachData()
    {
        return $this->coachData;
    }
    /**
     * Constructor
     */
    public function __construct()
    {
        $this->playerData = new \Doctrine\Common\Collections\ArrayCollection();
        $this->coachData = new \Doctrine\Common\Collections\ArrayCollection();
    }

    /**
     * Add playerData
     *
     * @param \DatabaseBundle\Entity\PlayerData $playerData
     * @return PersonalData
     */
    public function addPlayerDatum(\DatabaseBundle\Entity\PlayerData $playerData)
    {
        $this->playerData[] = $playerData;

        return $this;
    }

    /**
     * Remove playerData
     *
     * @param \DatabaseBundle\Entity\PlayerData $playerData
     */
    public function removePlayerDatum(\DatabaseBundle\Entity\PlayerData $playerData)
    {
        $this->playerData->removeElement($playerData);
    }

    /**
     * Add coachData
     *
     * @param \DatabaseBundle\Entity\CoachData $coachData
     * @return PersonalData
     */
    public function addCoachDatum(\DatabaseBundle\Entity\CoachData $coachData)
    {
        $this->coachData[] = $coachData;

        return $this;
    }

    /**
     * Remove coachData
     *
     * @param \DatabaseBundle\Entity\CoachData $coachData
     */
    public function removeCoachDatum(\DatabaseBundle\Entity\CoachData $coachData)
    {
        $this->coachData->removeElement($coachData);
    }
    /**
     * @var \Doctrine\Common\Collections\Collection
     */
    private $memberData;

    /**
     * @var \Doctrine\Common\Collections\Collection
     */
    private $parentData;


    /**
     * Add memberData
     *
     * @param \DatabaseBundle\Entity\MemberData $memberData
     * @return PersonalData
     */
    public function addMemberDatum(\DatabaseBundle\Entity\MemberData $memberData)
    {
        $this->memberData[] = $memberData;

        return $this;
    }

    /**
     * Remove memberData
     *
     * @param \DatabaseBundle\Entity\MemberData $memberData
     */
    public function removeMemberDatum(\DatabaseBundle\Entity\MemberData $memberData)
    {
        $this->memberData->removeElement($memberData);
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
     * Add parentData
     *
     * @param \DatabaseBundle\Entity\ParentData $parentData
     * @return PersonalData
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
     * @var boolean
     */
    private $isPlayer;


    /**
     * Set isPlayer
     *
     * @param boolean $isPlayer
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
     * Set isCoach
     *
     * @param boolean $isCoach
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
}
