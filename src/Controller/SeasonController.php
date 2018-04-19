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

    /**
     * @throws \Exception
     */
    public function addSeason()
    {
        if (!empty($_POST)) {
            $data = $this->cleanPost($_POST);
            $idSerie = $data['idSerie'];
            if (empty($data['nbSeasons'])) {
                throw new \Exception('Le champ est vide');
            }elseif (!preg_match('/^\d+$/', $data['nbSeasons'])) {
                throw new \Exception('Ceci n\' est pas un nombre');
            }elseif ($data['nbSeasons'] < 0) {
                throw new \Exception('le nombre doit être positif ou nul');
            }else {
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
        $seasons = $saisonManager->selectAllByFk('idserie', $idSerie);

        return $this->twig->render('Serie/adminSerie.html.twig', ['seasons' => $seasons]);
    }

}