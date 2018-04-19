<?php
/**
 * Created by PhpStorm.
 * User: aragorn
 * Date: 19/04/18
 * Time: 15:41
 */

namespace Controller;


use Model\EpisodeManager;

class EpisodeController extends AbstractController
{
    public function addEpisode()
    {
        if (!empty($_POST)) {
            $data = $this->cleanPost($_POST);
            $idSerie = $data[ 'idSerie' ];
            if (isset($data[ 'numeroEpisode' ])) {
                $episodeManager = new EpisodeManager();
                $episodeManager->insert($data);
                header('Location: /pageSerie/admin/' . $idSerie);
                exit();
            }
        }
    }

}