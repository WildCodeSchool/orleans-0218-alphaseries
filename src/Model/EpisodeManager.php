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

        // On récupère l'id de la saison associée à la série

        $query = "SELECT id FROM season WHERE number_season = :nb AND idserie = :IdSerie";
        $statement = $this->pdoConnection->prepare($query);
        $statement->setFetchMode(\PDO::FETCH_CLASS, $this->className);
        $statement->bindValue('nb', $nb);
        $statement->bindValue('IdSerie', $idSerie);
        $statement->execute();
        $idSeason = $statement->fetch()->getId();

        //On vérifie que l'épisode n'existe pas déjà

        $verif = "SELECT count(number) as count FROM $this->table WHERE idseason = :idSeason AND idserie = :idSerie AND number = :number";
        $result = $this->pdoConnection->prepare($verif);
        $result->setFetchMode(\PDO::FETCH_ASSOC);
        $result->bindValue('idSeason', $idSeason, \PDO::PARAM_INT);
        $result->bindValue('idSerie', $idSerie, \PDO::PARAM_INT);
        $result->bindValue('number', $data[ 'numeroEpisode' ], \PDO::PARAM_INT);
        $result->execute();
        $res = $result->fetchAll();
        $count = $res[0]['count'];

        if ($count !== '0') {
            throw new \Exception('L\' épisode existe déjà');
        } else {
            //Si Ok on ajoute en base de donnée

            $query = "INSERT INTO $this->table (number, title, broadcasting_date, idseason, idserie) VALUES (:nb, :title, :dateDiff, :idSeason, :idSerie)";
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