<?php

namespace DatabaseBundle\Entity;

use Symfony\Component\Security\Core\User\UserInterface;
use Doctrine\ORM\Mapping as ORM;

/**
 * User
 */
class User implements UserInterface
{
    /**
     * @var integer
     */
    private $id;

    /**
     * @var string
     */
    private $username;

    /**
     * @var string
     */
    private $password;

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
     * @var string
     */
    private $oldpassword;

    /**
     * Set username
     *
     * @param string $username
     *
     * @return User
     */
    public function setUsername($username)
    {
        $this->username = $username;

        return $this;
    }

    /**
     * Get username
     *
     * @return string
     */
    public function getUsername()
    {
        return $this->username;
    }

    /**
     * Set password
     *
     * @param string $password
     *
     * @return User
     */
    public function setPassword($password)
    {
        $this->password = $password;

        return $this;
    }

    /**
     * Get password
     *
     * @return string
     */
    public function getPassword()
    {
        return $this->password;
    }

    /**
     * Get roles
     *
     * @return string
     */
    public function getRoles()
    {
        return array($this->role);
    }

    /**
     * Get salt
     *
     * @return null
     */
    public function getSalt()
    {
      return null;
    }

    /**
     * Erase credentials
     *
     * Do nothing
     */
    public function eraseCredentials()
    {
    }
    /**
     * @var string
     */
    private $role;


    /**
     * Set role
     *
     * @param string $role
     *
     * @return User
     */
    public function setRole($role)
    {
        $this->role = $role;

        return $this;
    }

    /**
     * Get role
     *
     * @return string
     */
    public function getRole()
    {
        return $this->role;
    }
    /**
     * @var \DatabaseBundle\Entity\FileImport
     */
    private $fileImport;


    /**
     * Set fileImport
     *
     * @param \DatabaseBundle\Entity\FileImport $fileImport
     *
     * @return User
     */
    public function setFileImport(\DatabaseBundle\Entity\FileImport $fileImport = null)
    {
        $this->fileImport = $fileImport;

        return $this;
    }

    /**
     * Get fileImport
     *
     * @return \DatabaseBundle\Entity\FileImport
     */
    public function getFileImport()
    {
        return $this->fileImport;
    }
    /**
     * Constructor
     */
    public function __construct()
    {
        $this->fileImport = new \Doctrine\Common\Collections\ArrayCollection();
    }

    /**
     * Add fileImport
     *
     * @param \DatabaseBundle\Entity\FileImport $fileImport
     *
     * @return User
     */
    public function addFileImport(\DatabaseBundle\Entity\FileImport $fileImport)
    {
        $this->fileImport[] = $fileImport;

        return $this;
    }

    /**
     * Remove fileImport
     *
     * @param \DatabaseBundle\Entity\FileImport $fileImport
     */
    public function removeFileImport(\DatabaseBundle\Entity\FileImport $fileImport)
    {
        $this->fileImport->removeElement($fileImport);
    }

    /**
     * Set oldpassword
     *
     * @param string $oldpassword
     *
     * @return User
     */
    public function setOldpassword($oldpassword)
    {
        $this->oldpassword = $oldpassword;

        return $this;
    }

    /**
     * Get oldpassword
     *
     * @return string
     */
    public function getOldpassword()
    {
        return $this->oldpassword;
    }
}
