<?php
/**
 * Created by PhpStorm.
 * User: aragorn
 * Date: 19/04/18
 * Time: 09:50
 */

namespace Controller;

use Model\SeasonManager;
use Model\SerieManager;
use Model\EpisodeManager;

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
            $serieManager = new SerieManager();
            $serie = $serieManager->selectOneById($idSerie);
            $season = new SeasonManager();
            $seasons = $season->selectSeason($idSerie);
            $episodeManager = new episodeManager();
            $episodes = $episodeManager->selectAllEpisodesOfOneSerie($idSerie);
            try {
                $this->validationForm($data);
                $season->insert($data);
                header('Location: /pageSerie/admin/'.$idSerie);
                exit();
            } catch (\Exception $e) {
                $msg = 'Erreur: '. $e->getMessage(). "\n";
            }

            return $this->twig->render('Serie/adminSerie.html.twig', ['serie' => $serie, 'idSerie' => $idSerie, 'seasons' => $seasons, 'msg' => $msg, 'episodes' => $episodes]);
        }
    }

    /**
     * @param $data
     * @throws \Exception
     */
    public function validationForm(array $data)
    {
        if ($data['nbSeasons'] === '') {
            throw new \Exception('Le champ est vide');
        } elseif (!preg_match('/^\d+$/', $data['nbSeasons'])) {
            throw new \Exception('Ceci n\' est pas un nombre');
        } elseif ($data['nbSeasons'] < 0) {
            throw new \Exception('le nombre doit être positif ou nul');
        }
    }
}
