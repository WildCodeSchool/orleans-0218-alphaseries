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

    public function showThreeSeries()
    {
        $resultShowThreeSeries = $this->pdoConnection->query('SELECT * FROM serie ORDER BY idserie DESC LIMIT 3');
        return $resultShowThreeSeries->fetchAll(\PDO::FETCH_ASSOC);
    }
}