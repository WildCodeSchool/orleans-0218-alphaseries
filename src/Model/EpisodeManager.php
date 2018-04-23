<?php
/**
 * Created by PhpStorm.
 * User: aragorn
 * Date: 19/04/18
 * Time: 15:41
 */

namespace Model;


class EpisodeManager extends AbstractManager
{
    const TABLE = 'episode';

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
        $nb = $data[ 'numeroSeason' ];
        $query = "SELECT id FROM season WHERE numero_season = $nb AND idserie = $idSerie";
        $objRes = $this->pdoConnection->query($query, \PDO::FETCH_CLASS, $this->className)->fetch();
        $idSeason = $objRes->getId();
        $verif = "SELECT numero FROM $this->table WHERE idseason = :numero_season AND idserie = :idSerie";
        $result = $this->pdoConnection->prepare($verif);
        $result->setFetchMode(\PDO::FETCH_ASSOC);
        $result->bindValue('numero_season', $idSeason, \PDO::PARAM_INT);
        $result->bindValue('idSerie', $idSerie, \PDO::PARAM_INT);
        $result->execute();
        $res = $result->fetchAll();
        if (count($res) !== 0) {
            throw new \Exception('L\' épisode existe déjà');
        } else {
            $query = "INSERT INTO $this->table (numero, title, broadcasting_date, idseason, idserie) VALUES (:nb, :title, :dateDiff, :idSeason, :idSerie)";
            $statement = $this->pdoConnection->prepare($query);
            $statement->bindValue('nb', $data[ 'numeroEpisode' ]);
            $statement->bindValue('title', $data[ 'titleEpisode' ]);
            $statement->bindValue('dateDiff', $data[ 'date_diff' ]);
            $statement->bindValue('idSerie', $idSerie);
            $statement->bindValue('idSeason', $idSeason);
            $statement->execute();

        }

    }
}