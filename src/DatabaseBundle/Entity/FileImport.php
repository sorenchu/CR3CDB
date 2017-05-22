<?php

namespace DatabaseBundle\Entity;

/**
 * FileImport
 */
class FileImport
{
    /**
     * @var integer
     */
    private $id;

    /**
     * @var \DateTime
     */
    private $importedDate;

    /**
     * @var \DatabaseBundle\Entity\User
     */
    private $user;


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
     * Set importedDate
     *
     * @param \DateTime $importedDate
     *
     * @return FileImport
     */
    public function setImportedDate($importedDate)
    {
        $this->importedDate = $importedDate;

        return $this;
    }

    /**
     * Get importedDate
     *
     * @return \DateTime
     */
    public function getImportedDate()
    {
        return $this->importedDate;
    }

    /**
     * Set user
     *
     * @param \DatabaseBundle\Entity\User $user
     *
     * @return FileImport
     */
    public function setUser(\DatabaseBundle\Entity\User $user = null)
    {
        $this->user = $user;

        return $this;
    }

    /**
     * Get user
     *
     * @return \DatabaseBundle\Entity\User
     */
    public function getUser()
    {
        return $this->user;
    }
}
