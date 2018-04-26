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
    private $genre;

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
    private $link_picture;

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
    public function getGenre(): string
    {
        return $this->genre;
    }

    /**
     * @param string $gender
     * @return Serie
     */
    public function setGenre(string $genre): Serie
    {
        $this->genre = $genre;

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
     * @return string|null
     */
    public function getLink_Picture(): ?string
    {
        return $this->link_picture;
    }

    /**
     * @param string $picture
     * @return Serie
     */
    public function setLink_Picture(string $picture): Serie
    {
        $this->link_picture = $picture;

        return $this;
    }

    /**
     * @return float
     */
    public function getGlobalNote (): float
    {
        return $this->globalNote;
    }

    /**
     * @param float $globalNote
     */
    public function setGlobalNote (float $globalNote): void
    {
        $this->globalNote = $globalNote;
    }

}
