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
    private $numberSeason;

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
    public function getNumberSeason (): int
    {
        return $this->numberSeason;
    }

    /**
     * @param int $nbSeason
     */
    public function setNumberSeason (int $nbSeason): void
    {
        $this->numberSeason = $nbSeason;
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