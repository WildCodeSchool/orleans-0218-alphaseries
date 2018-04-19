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
        $verif = "SELECT numero_season FROM $this->table WHERE idserie = $idSerie";
        $seasonInDb = $this->pdoConnection->query($verif, \PDO::FETCH_CLASS, $this->className)->fetchAll();
        $errorMsg = '';
        for ($i = 0; $i < count($seasonInDb); $i++) {
            if ($nb == $seasonInDb[$i]->numero_season) {
                $errorMsg = 'La saison existe déjà';
            }
        }
        if ($errorMsg == '') {
            $query = "INSERT INTO $this->table (numero_season, idserie) VALUES (:numb, :idSerie)";
            $statement = $this->pdoConnection->prepare($query);
            $statement->bindValue('numb', $nb);
            $statement->bindValue('idSerie', $idSerie);
            $statement->execute();
        }else {
            throw new \Exception($errorMsg);
        }


    }
}