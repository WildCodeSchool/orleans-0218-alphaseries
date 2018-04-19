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

    public function insert (array $data)
    {
        $idSerie = $data[ 'idSerie' ];
        $nb = $data[ 'nbSeasons' ];
        $query = "INSERT INTO $this->table (numero_season, idserie) VALUES (:numb, :idSerie)";
        $statement = $this->pdoConnection->prepare($query);
        $statement->bindValue('numb', $nb);
        $statement->bindValue('idSerie', $idSerie);
        $statement->execute();

    }
}