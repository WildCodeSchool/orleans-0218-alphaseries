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
                    $filePath = 'defaultPicture.jpg';

                }else {
                    $fileName = $_FILES["fichier"]["tmp_name"][$i];
                    $extension_upload = strtolower(substr(strrchr($_FILES['fichier']['name'][$i], '.'), 1));
                    $uniqueSaveName = time() . uniqid();
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

}