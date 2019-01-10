<?php

namespace DatabaseBundle\Entity;

/**
 * Journal
 */
class Journal
{
    /**
     * @var int
     */
    private $id;

    /**
     * @var string|null
     */
    private $title;

    /**
     * @var string|null
     */
    private $text;

    /**
     * @var \DatabaseBundle\Entity\PersonalData
     */
    private $personalData;

    /**
     * @var \DatabaseBundle\Entity\Season
     */
    private $season;


    /**
     * Get id.
     *
     * @return int
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * Set title.
     *
     * @param string|null $title
     *
     * @return Journal
     */
    public function setTitle($title = null)
    {
        $this->title = $title;

        return $this;
    }

    /**
     * Get title.
     *
     * @return string|null
     */
    public function getTitle()
    {
        return $this->title;
    }

    /**
     * Set text.
     *
     * @param string|null $text
     *
     * @return Journal
     */
    public function setText($text = null)
    {
        $this->text = $text;

        return $this;
    }

    /**
     * Get text.
     *
     * @return string|null
     */
    public function getText()
    {
        return $this->text;
    }

    /**
     * Set personalData.
     *
     * @param \DatabaseBundle\Entity\PersonalData|null $personalData
     *
     * @return Journal
     */
    public function setPersonalData(\DatabaseBundle\Entity\PersonalData $personalData = null)
    {
        $this->personalData = $personalData;

        return $this;
    }

    /**
     * Get personalData.
     *
     * @return \DatabaseBundle\Entity\PersonalData|null
     */
    public function getPersonalData()
    {
        return $this->personalData;
    }

    /**
     * Set season.
     *
     * @param \DatabaseBundle\Entity\Season|null $season
     *
     * @return Journal
     */
    public function setSeason(\DatabaseBundle\Entity\Season $season = null)
    {
        $this->season = $season;

        return $this;
    }

    /**
     * Get season.
     *
     * @return \DatabaseBundle\Entity\Season|null
     */
    public function getSeason()
    {
        return $this->season;
    }
    /**
     * @var dateTime
     */
    private $date;


    /**
     * Set date.
     *
     * @param \dateTime $date
     *
     * @return Journal
     */
    public function setDate(\dateTime $date)
    {
        $this->date = $date;

        return $this;
    }

    /**
     * Get date.
     *
     * @return \dateTime
     */
    public function getDate()
    {
        return $this->date;
    }
}
