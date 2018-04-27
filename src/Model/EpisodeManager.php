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

    /**
     * @param array $data
     * @return string|void
     * @throws \Exception
     */
    public function insert(array $data)
    {
        $idSerie = $data['idSerie'];
        $nb = $data['numeroSeason'];
        $numberEpisode = $data['numeroEpisode'];
        $idSeason = $this->recupIdSeason($nb, $idSerie)->getId();

        if ($this->checkEpisodeExist($idSeason, $idSerie, $numberEpisode)) {
            throw new \Exception('L\' épisode existe déjà');
        } else {
            //Si Ok on ajoute en base de donnée

            $query = "INSERT INTO $this->table (number, title, broadcastingDate, idSeason, idSerie) VALUES (:nb, :title, :dateDiff, :idSeason, :idSerie)";
            $statement = $this->pdoConnection->prepare($query);
            $statement->bindValue('nb', $numberEpisode);
            $statement->bindValue('title', $data['titleEpisode']);
            $statement->bindValue('dateDiff', $data['date_diff']);
            $statement->bindValue('idSerie', $idSerie);
            $statement->bindValue('idSeason', $idSeason);
            $statement->execute();

        }

    }

    /**
     * @param int $idSeason
     * @param int $idSerie
     * @param int $numberEpisode
     * @return bool
     * @throws \Exception
     */
    public function checkEpisodeExist(int $idSeason, int $idSerie, int $numberEpisode): bool
    {
        //On vérifie que l'épisode n'existe pas déjà

        $verif = "SELECT count(number) as count FROM $this->table WHERE idseason = :idSeason AND idserie = :idSerie AND number = :number";
        $result = $this->pdoConnection->prepare($verif);
        $result->setFetchMode(\PDO::FETCH_ASSOC);
        $result->bindValue('idSeason', $idSeason, \PDO::PARAM_INT);
        $result->bindValue('idSerie', $idSerie, \PDO::PARAM_INT);
        $result->bindValue('number', $numberEpisode, \PDO::PARAM_INT);
        $result->execute();
        $res = $result->fetch();
        $count = $res['count'];

        return $count;
    }

    /**
     * @param int $nb
     * @param int $idSerie
     * @return mixed
     */
    public function recupIdSeason(int $nb, int $idSerie)
    {
        // On récupère l'id de la saison associée à la série

        $query = "SELECT id FROM season WHERE numberSeason = :nb AND idserie = :idSerie";
        $statement = $this->pdoConnection->prepare($query);
        $statement->setFetchMode(\PDO::FETCH_CLASS, $this->className);
        $statement->bindValue('nb', $nb);
        $statement->bindValue('idSerie', $idSerie);
        $statement->execute();
        return $statement->fetch();

    }

    /**
     * @param $id
     * @return array
     */
    public function selectAllEpisodesOfOneSerie($id)
    {
        $query = "SELECT * FROM episode WHERE idserie = $id";
        $res = $this->pdoConnection->query($query);
        $resAll = $res->fetchAll(\PDO::FETCH_CLASS);
        return $resAll;
    }

    /**
     * @param $id
     * @return array
     */
    public function listSpecsEpisodes($id)
    {
        $query = "SELECT episode.id, episode.number, episode.title, season.numberSeason 
                  FROM episode 
                  JOIN season ON season.id = episode.idseason
                  WHERE episode.idserie = :id
                  ORDER BY season.numberSeason, episode.number;";
        $res = $this->pdoConnection->prepare($query);
        $res->setFetchMode(\PDO::FETCH_CLASS, $this->className);
        $res->bindValue('id', $id);
        $res->execute();
        $resAll = $res->fetchAll(\PDO::FETCH_CLASS);
        return $resAll;
    }

    /**
     * @param int $idSerie
     * @param int $idSeason
     * @return array
     */
    public function selectEpisodeBySeason(int $idSerie, int $idSeason)
    {
        $query = "SELECT number, title FROM $this->table WHERE idserie = :idSerie AND idseason = :idSeason ORDER BY number";
        $result = $this->pdoConnection->prepare($query);
        $result->setFetchMode(\PDO::FETCH_CLASS, $this->className);
        $result->bindValue('idSerie', $idSerie);
        $result->bindValue('idSeason', $idSeason);
        $result->execute();
        $res = $result->fetchAll();
        return $res;
    }

}