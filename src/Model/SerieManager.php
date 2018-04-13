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
     * @return string
     * @throws \Exception
     */
    public function upload()
    {
        $uploadDir = 'assets/upload/';
        $maxsize  = 1048576;
        $acceptable = [
            'jpg',
            'jpeg',
            'gif',
            'png'
        ];

        if (!empty($_POST)){
            for ($i = 0; $i < count($_FILES["fichier"]["name"]); $i++) {

                if ($_FILES["fichier"]["name"][0] === ""){
                    $filePath = null;

                }else {
                    $fileName = $_FILES["fichier"]["tmp_name"][$i];
                    $extension_upload = pathinfo($_FILES['fichier']['name'][$i], PATHINFO_EXTENSION);
                    $uniqueSaveName = uniqid();
                    $filePath = $uniqueSaveName . '.' . $extension_upload;

                    if (($_FILES['fichier']['size'][$i] >= $maxsize) || ($_FILES['fichier']['size'][$i] == 0)) {
                        throw new \Exception('File too large. File must be less than '.$maxsize .' bytes.');
                    }

                    if (!in_array($extension_upload, $acceptable) && !empty($_FILES['fichier']['type'][$i])) {
                        throw new \Exception('Invalid file type. Only '.implode(',',$acceptable).' types are accepted.');
                    }
                    move_uploaded_file($fileName, $uploadDir.$filePath);

                }
            }
        }
        return $filePath;
    }

    public function insert(array $data)
    {
        try{
            $data['link_picture'] = $this->upload();
            parent::insert($data);
        }catch (\Exception $e){
            echo 'Exception reçue : ',  $e->getMessage(), "\n";
        }

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