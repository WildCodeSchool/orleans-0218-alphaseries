<?php
/**
 * Created by PhpStorm.
 * User: sylvain
 * Date: 07/03/18
 * Time: 18:20
 * PHP version 7
 */

namespace Model;

/**
 *
 */
class HomeManager extends AbstractManager
{
    const TABLE = 'serie';

    /**
     *  Initializes this class.
     */
    public function __construct()
    {
        parent::__construct(self::TABLE);
    }

    public function showLimitedSeries(int $limit)
    {
        $statement = $this->pdoConnection->prepare('SELECT * FROM serie ORDER BY id DESC LIMIT :limit');
        $statement->setFetchMode(\PDO::FETCH_ASSOC);
        $statement->bindValue('limit', $limit, \PDO::PARAM_INT);
        $statement->execute();
        return $statement->fetchAll();
    }
}
