<?php
/**
 * Created by PhpStorm.
 * User: aragorn
 * Date: 03/04/18
 * Time: 17:14
 */

namespace Model;


class SerieManager extends AbstractManager
{
    const TABLE = 'serie';

    /**
     * SerieManager constructor.
     */
    public function __construct()
    {
        parent::__construct(self::TABLE);
    }

    /**
     * @return array
     */
    public function searchbar() 
    {

        if(!empty($_GET['search'])) {
            $searchterm = $_GET['search'];
            $req = $this->pdoConnection->prepare("SELECT * FROM serie WHERE title LIKE :searchterm");
            $req->bindValue(':searchterm', $searchterm, \PDO::PARAM_STR);
            $req->execute(array('searchterm' => $searchterm . '%'));
            $result = $req->fetchAll(\PDO::FETCH_ASSOC);

        }
        return $result;
    }
}