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
     */
    public function checkPicture()
    {
        $uploadDir = 'assets/images/';
        $errors = [];
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
                    $uploadFile = $uploadDir . $uniqueSaveName . '.' . $extension_upload;
                    $filePath = $uniqueSaveName . '.' . $extension_upload;

                    if (($_FILES['fichier']['size'][$i] >= $maxsize) || ($_FILES['fichier']['size'][$i] == 0)) {
                        $errors[] = 'File too large. File must be less than 1 megabytes.';
                    }

                    if (!in_array($extension_upload, $acceptable) && !empty($_FILES['fichier']['type'][$i])) {
                        $errors[] = 'Invalid file type. Only JPG, JPEG, GIF and PNG types are accepted.';
                    }
                    if (count($errors) === 0) {
                        move_uploaded_file($fileName, $uploadFile);
                    } else {
                        foreach ($errors as $error) {
                            echo '<script>alert("' . $error . '");</script>';
                        }
                    }
                }
            }
        }
        return $filePath;
    }

    /**
     * @param array $data
     */
    public function addSerie(array $data)
    {
        $manage = new SerieManager();
        $data['picture'] = $manage->checkPicture();
        $serie = new Serie();
        $serie->setTitle($data['title']);
        $serie->setGenre($data['genre']);
        $serie->setSynopsis($data['synopsis']);
        $serie->setCreationDate($data['creation_date']);
        $serie->setPicture($data['picture']);
        $title = $serie->getTitle();
        $syno = $serie->getSynopsis();
        $genre = $serie->getGenre();
        $date = $serie->getCreationDate();
        $picture = $serie->getPicture();

        $statement = $this->pdoConnection->prepare("INSERT INTO serie (title, synopsis, genre, creation_date, link_picture) VALUES (:title, :synopsis, :genre, :creation_date, :picture)");
        $statement->bindValue('title', $title);
        $statement->bindValue('synopsis', $syno);
        $statement->bindValue('genre', $genre);
        $statement->bindValue('creation_date', $date);
        $statement->bindValue('picture', $picture);
        $statement->execute();

    }


}