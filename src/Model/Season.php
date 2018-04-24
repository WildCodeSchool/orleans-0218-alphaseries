<?php
/**
 * Created by PhpStorm.
 * User: aragorn
 * Date: 18/04/18
 * Time: 13:21
 */

namespace Model;


class Season
{
    /**
     * @var int
     */
    private $id;

    /**
     * @var int
     */
    private $number_season;

    /**
     * @var int
     */
    private $idSerie;

    /**
     * @return int
     */
    public function getId (): int
    {
        return $this->id;
    }

    /**
     * @param int $id
     */
    public function setId (int $id): void
    {
        $this->id = $id;
    }

    /**
     * @return int
     */
    public function getNumber_Season (): int
    {
        return $this->number_season;
    }

    /**
     * @param int $nbSeason
     */
    public function setNumber_Season (int $nbSeason): void
    {
        $this->number_season = $nbSeason;
    }

    /**
     * @return int
     */
    public function getIdSerie (): int
    {
        return $this->idSerie;
    }

    /**
     * @param int $idSerie
     */
    public function setIdSerie (int $idSerie): void
    {
        $this->idSerie = $idSerie;
    }


}