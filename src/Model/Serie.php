<?php
/**
 * Created by PhpStorm.
 * User: aragorn
 * Date: 03/04/18
 * Time: 17:14
 */

namespace Model;


class Serie
{
    /**
     * @var int
     */
    private $id;

    /**
     * @var string
     */
    private $title;

    /**
     * @var string
     */
    private $synopsis;

    /**
     * @var string
     */
    private $gender;

    /**
     * @var string
     */
    private $creationDate;

    /**
     * @var float
     */
    private $globalNote;

    /**
     * @var string
     */
    private $linkPicture;

    /**
     * @return int
     */
    public function getId(): int
    {
        return $this->id;
    }

    /**
     * @param int $id
     * @return Serie
     */
    public function setId(int $id): Serie
    {
        $this->id = $id;

        return $this;
    }

    /**
     * @return string
     */
    public function getTitle(): string
    {
        return $this->title;
    }

    /**
     * @param string $title
     * @return Serie
     */
    public function setTitle(string $title): Serie
    {
        $this->title = $title;

        return $this;
    }

    /**
     * @return string
     */
    public function getSynopsis(): string
    {
        return $this->synopsis;
    }

    /**
     * @param string $synopsis
     * @return Serie
     */
    public function setSynopsis(string $synopsis): Serie
    {
        $this->synopsis = $synopsis;

        return $this;
    }

    /**
     * @return string
     */
    public function getGender(): string
    {
        return $this->gender;
    }

    /**
     * @param string $gender
     * @return Serie
     */
    public function setGender(string $gender): Serie
    {
        $this->gender = $gender;

        return $this;
    }

    /**
     * @return string
     */
    public function getCreationDate(): string
    {
        return $this->creationDate;
    }

    /**
     * @param string $creationDate
     * @return Serie
     */
    public function setCreationDate(string $creationDate): Serie
    {
        $this->creationDate = $creationDate;

        return $this;
    }

    /**
     * @return float
     */
    public function getGlobalNote(): float
    {
        return $this->globalNote;
    }

    /**
     * @param float $globalNote
     * @return Serie
     */
    public function setGlobalNote(float $globalNote): Serie
    {
        $this->globalNote = $globalNote;

        return $this;
    }

    /**
     * @return string
     */
    public function getLinkPicture(): string
    {
        return $this->linkPicture;
    }

    /**
     * @param string $linkPicture
     * @return Serie
     */
    public function setLinkPicture(string $linkPicture): Serie
    {
        $this->linkPicture = $linkPicture;

        return $this;
    }
}
