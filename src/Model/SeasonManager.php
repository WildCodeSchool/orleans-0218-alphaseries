<?php
/**
 * Created by PhpStorm.
 * User: aragorn
 * Date: 18/04/18
 * Time: 13:23
 */

namespace Model;


class SeasonManager extends AbstractManager
{
    const TABLE = 'season';

    /**
     *  Initializes this class.
     */
    public function __construct ()
    {
        parent::__construct(self::TABLE);
    }

    /**
     * @param array $data
     * @return string|void
     * @throws \Exception
     */
    public function insert (array $data)
    {
        $idSerie = $data[ 'idSerie' ];
        $nb = $data[ 'nbSeasons' ];
        $verif = "SELECT numero_season FROM $this->table WHERE numero_season = :numero_season AND idserie = :idSerie";
        $result = $this->pdoConnection->prepare($verif);
        $result->setFetchMode(\PDO::FETCH_CLASS, $this->className);
        $result->bindValue('numero_season', $nb, \PDO::PARAM_INT);
        $result->bindValue('idSerie', $idSerie, \PDO::PARAM_INT);
        $result->execute();
        $res = $result->fetchAll();
        if (count($res) !== 0) {
            throw new \Exception('La saison existe déjà');
        }else {
            $query = "INSERT INTO $this->table (numero_season, idserie) VALUES (:numb, :idSerie)";
            $statement = $this->pdoConnection->prepare($query);
            $statement->bindValue('numb', $nb);
            $statement->bindValue('idSerie', $idSerie);
            $statement->execute();
        }

    }
}