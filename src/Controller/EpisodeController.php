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
        if ( !empty($_POST) ) {
            $data = $this->cleanPost($_POST);
            $idSerie = $data['idSerie'];
            if ( isset($data['numeroEpisode']) ) {
                try {
                    $episodeManager = new EpisodeManager();
                    $episodeManager->insert($data);
                    header('Location: /pageSerie/admin/' . $idSerie);
                    exit();
                } catch (\Exception $e) {
                    $msg = 'Erreur: ' . $e->getMessage() . "\n";

                }
                $serieManager = new SerieManager();
                $serie = $serieManager->selectOneById($idSerie);
                $season = new SeasonManager();
                $seasons = $season->selectSeason($idSerie);
                $episodeManager = new episodeManager();
                $episodes = $episodeManager->selectAllEpisodesOfOneSerie($idSerie);
                return $this->twig->render('Serie/adminSerie.html.twig', ['serie' => $serie, 'idSerie' => $idSerie, 'seasons' => $seasons, 'msg' => $msg, 'episodes' => $episodes]);
            }
        }
    }

    public function updateEpisode(int $id)
    {
        $episodeManager = new EpisodeManager();
        $episode = $episodeManager->selectOneById($id);
        $idserie = $episode->getIdSerie();
        $idSeason = $episode->getIdSeason();
        $date = $episode->getBroadcastingDate();
        $serieManager = new SerieManager();
        $serie = $serieManager->selectOneById($idserie);
        $seasonManager = new SeasonManager();
        $season = $seasonManager->selectOneById($idSeason);
        $seasons = $seasonManager->selectAllByFk( 'idserie', 'id', $idserie, 'serie', 'numberSeason');
        $episodes = $episodeManager->listSpecsEpisodes($idserie);

        return $this->twig->render('Serie/adminSerie.html.twig', ['serie' => $serie, 'idSerie' => $id, 'seasons' => $seasons, 'episodes' => $episodes, 'date' => $date, 'episode' => $episode, 'season' => $season]);

    }

    public function viewAfterUpdateEpisode()
    {
        if (!empty($_POST)) {
            $data = $this->cleanPost($_POST);
            $id = $data['id'];
            $episodeManager = new EpisodeManager();
            $episodeManager->update($id, $data);
            $idserie = $episodeManager->selectOneById($id)->getIdSerie();
            header('Location: /pageSerie/admin/' .$idserie);
        }
    }
    public function deleteEpisode()
    {
        if(!empty($_POST)) {
            $id = $_POST['idEp'];
            $episodeManager = new EpisodeManager();
            $idSerie = $episodeManager->selectOneById($id)->getIdSerie();
            $episodeManager->delete($id);
            header( 'Location: /pageSerie/admin/' .$idSerie);
            exit();
        }
    }

}

