<?php
/**
 * Created by PhpStorm.
 * User: aragorn
 * Date: 29/03/18
 * Time: 11:49
 */

namespace Controller;

use Model\Serie;
use Model\SerieManager;

class SerieController extends AbstractController
{
    /**
     * Display serie listing
     *
     * @return string
     */
    public function list()
    {
        $serieManager = new SerieManager();
        $series = $serieManager->selectAll();

        return $this->twig->render('Serie/list.html.twig', ['series' => $series]);
    }

    /**
     * @return string
     * @throws \Twig_Error_Loader
     * @throws \Twig_Error_Runtime
     * @throws \Twig_Error_Syntax
     */
    public function catchPhrase()
    {
        return $this->twig->render('Serie/index.html.twig');
    }
}
