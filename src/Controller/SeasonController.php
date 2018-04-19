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
            if (isset($data['nbSeasons']) AND preg_match('/^\d+$/', $data['nbSeasons']) AND $data['nbSeasons'] >= 0) {
                $saisonManager = new SeasonManager();
                $saisonManager->insert($data);
                header('Location: /pageSerie/admin/'.$idSerie);
                exit();
            }elseif (!preg_match('/^\d+$/', $data['nbSeasons'])) {
                throw new \Exception('Ceci n\' est pas un nombre');
            }elseif ($data['nbSeasons'] < 0) {
                throw new \Exception('le nombre doit être positif ou nul');
            }
        }
    }

}