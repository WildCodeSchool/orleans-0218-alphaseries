<?php
/**
 * Created by PhpStorm.
 * User: aragorn
 * Date: 19/04/18
 * Time: 15:41
 */

namespace Controller;

use Model\EpisodeManager;
use Model\SeasonManager;
use Model\SerieManager;

class EpisodeController extends AbstractController
{
    /**
     * @return string
     * @throws \Twig_Error_Loader
     * @throws \Twig_Error_Runtime
     * @throws \Twig_Error_Syntax
     */
    public function addEpisode()
    {
        if (!empty($_POST)) {
            $data = $this->cleanPost($_POST);
            $idSerie = $data[ 'idSerie' ];
            if (isset($data[ 'numeroEpisode' ])) {
                try {
                    $episodeManager = new EpisodeManager();
                    $episodeManager->insert($data);
                    header('Location: /pageSerie/admin/' . $idSerie);
                    exit();
                }catch (\Exception $e) {
                    $msg = 'Erreur: '. $e->getMessage(). "\n";

                }
                $serieManager = new SerieManager();
                $serie = $serieManager->selectOneById($idSerie);
                $season = new SeasonManager();
                $seasons = $season->selectSeason($idSerie);
                $episodeManager = new episodeManager();
                $episodes = $episodeManager->selectAllEpisodesOfOneSerie($idSerie);
                return $this->twig->render('Serie/adminSerie.html.twig', ['serie' => $serie, 'idSerie' => $idSerie,  'seasons' => $seasons, 'msg' => $msg, 'episodes' => $episodes]);
            }
        }
    }

}