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
    public function __construct()
    {
        parent::__construct(self::TABLE);
    }

    public function insert (array $data)
    {
        $idSerie = $data['idSerie'];
        $nbSeason = $data['numeroSeason'];
        $query = "SELECT id FROM season WHERE numero_season = $nbSeason";
        $result = $this->pdoConnection->query($query, \PDO::FETCH_ASSOC)->fetch();
        $idSeason = $result['id'];
        $query = "INSERT INTO $this->table (numero, title, broadcasting_date, idseason, idserie) VALUES (:nb, :title, :dateDiff, :idSeason, :idSerie)";
        $statement = $this->pdoConnection->prepare($query);
        $statement->bindValue('nb', $data['numeroEpisode']);
        $statement->bindValue('title', $data['titleEpisode']);
        $statement->bindValue('dateDiff', $data['date_diff']);
        $statement->bindValue('idSerie', $idSerie);
        $statement->bindValue('idSeason', $idSeason);
        $statement->execute();

    }

}