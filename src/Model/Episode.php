<?php
/**
 * Created by PhpStorm.
 * User: aragorn
 * Date: 19/04/18
 * Time: 15:41
 */

namespace Model;

class Episode
{
    /**
     * @var int
     */
    private $id;

    /**
     * @var int
     */
    private $number;

    /**
     * @var string
     */
    private $title;

    /**
     * @var boolean
     */
    private $hasSeen;

    /**
     * @var int
     */
    private $note;

    /**
     * @var string
     */
    private $broadcastingDate;

    /**
     * @var int
     */
    private $idSeason;

    /**
     * @var int
     */
    private $idSerie;

    /**
     * @return int
     */
    public function getId(): int
    {
        return $this->id;
    }

    /**
     * @param int $id
     */
    public function setId(int $id): void
    {
        $this->id = $id;
    }

    /**
     * @return int
     */
    public function getNumber(): int
    {
        return $this->number;
    }

    /**
     * @param int $numero
     */
    public function setNumber(int $number): void
    {
        $this->number = $number;
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
     */
    public function setTitle(string $title): void
    {
        $this->title = $title;
    }

    /**
     * @return bool
     */
    public function getHasSeen(): ?bool
    {
        return $this->hasSeen;
    }

    /**
     * @param bool $hasSeen
     */
    public function setHasSeen(bool $hasSeen): void
    {
        $this->hasSeen = $hasSeen;
    }

    /**
     * @return int
     */
    public function getNote(): ?int
    {
        return $this->note;
    }

    /**
     * @param int $note
     */
    public function setNote(int $note): void
    {
        $this->note = $note;
    }

    /**
     * @return string
     */
    public function getBroadcastingDate(): string
    {
        return $this->broadcastingDate;
    }

    /**
     * @param string $broadcastingDate
     */
    public function setBroadcastingDate(string $broadcastingDate): void
    {
        $this->broadcastingDate = $broadcastingDate;
    }

    /**
     * @return int
     */
    public function getIdSeason(): int
    {
        return $this->idSeason;
    }

    /**
     * @param int $idSeason
     */
    public function setIdSeason(int $idSeason): void
    {
        $this->idSeason = $idSeason;
    }

    /**
     * @return int
     */
    public function getIdSerie(): int
    {
        return $this->idSerie;
    }

    /**
     * @param int $idSerie
     */
    public function setIdSerie(int $idSerie): void
    {
        $this->idSerie = $idSerie;
    }
}
