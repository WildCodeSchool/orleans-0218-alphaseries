<?php
/**
 * Created by PhpStorm.
 * User: aragorn
 * Date: 19/04/18
 * Time: 09:50
 */

namespace Controller;

use Model\SeasonManager;

class SeasonController extends AbstractController
{
    public function addSeason ()
    {
        if (!empty($_POST)) {
            $data = $this->cleanPost($_POST);
            $idSerie = $data[ 'idSerie' ];
            if (isset($data[ 'nbSeasons' ]) AND preg_match('/^\d+$/', $data[ 'nbSeasons' ]) AND $data[ 'nbSeasons' ] >= 0) {
                $saisonManager = new SeasonManager();
                $saisonManager->insert($data);
                header('Location: /pageSerie/admin/' . $idSerie);
                exit();
            }
        }
    }

    /**
     * @return string
     * @throws \Twig_Error_Loader
     * @throws \Twig_Error_Runtime
     * @throws \Twig_Error_Syntax
     */
    public function allSeasons ()
    {
        $saisonManager = new SeasonManager();

        $data = $this->cleanPost($_POST);
        $idSerie = $data[ 'idSerie' ];
        var_dump($idSerie);
        exit();
        $seasons = $saisonManager->selectAllByFk('idserie', $idSerie);


        return $this->twig->render('Serie/adminSerie.html.twig', ['seasons' => $seasons]);
    }

}