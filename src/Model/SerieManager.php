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


    public function selectByPage(int $page, int $limit)
    {
        return $this->pdoConnection->query('SELECT * FROM ' . $this->table . ' LIMIT ' . $limit . ' OFFSET ' . ($page - 1) * $limit,
            \PDO::FETCH_CLASS, $this->className
        )->fetchAll();

    }

    public function recupPageMax()
    {
        $limit = 12;

        $data = $this->pdoConnection->query('SELECT COUNT(*) AS total FROM ' . $this->table)->fetch(\PDO::FETCH_ASSOC);
        $total = $data['total'];

        $pageMax = ceil($total / $limit);

        return $pageMax;
    }

    /**
     * @param $searchterm
     * @return array
     */
    public function searchbar($searchterm)
    {

        if(!empty($searchterm)) {
            $req = $this->pdoConnection->prepare("SELECT * FROM serie WHERE title LIKE :searchterm");
            $req->bindValue(':searchterm', $searchterm, \PDO::PARAM_STR);
            $req->execute(array('searchterm' => $searchterm . '%'));
            $result = $req->fetchAll(\PDO::FETCH_ASSOC);
        }
        return $result;
    }

}