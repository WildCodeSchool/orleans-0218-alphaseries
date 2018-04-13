<?php
/**
 * Created by PhpStorm.
 * User: aragorn
 * Date: 03/04/18
 * Time: 17:12
 */

namespace Controller;

use Model\Serie;
use Model\SerieManager;


class SerieController extends AbstractController
{
    /**
     * Display serie listing
     *
     *@throws \Twig_Error_Loader
     * @throws \Twig_Error_Runtime
     * @throws \Twig_Error_Syntax
     * @return string
     */
    public function list()
    {
        $serieManager = new SerieManager();
        $series = $serieManager->selectAll();
        return $this->twig->render('Serie/list.html.twig', ['series' => $series]);
    }


    public function selectSerie(int $id)
    {
        $serieManager =  new SerieManager();
        $serie = $serieManager->selectOneById($id);
        return $this->twig->render('Serie/pageSerie.html.twig', ['serie' => $serie]);

    /**
     * @return string
     * @throws \Twig_Error_Loader
     * @throws \Twig_Error_Runtime
     * @throws \Twig_Error_Syntax
     */
    public function search()
    {
        $serieManager = new SerieManager();
        $series = $serieManager->searchbar($_GET['search']);

        return $this->twig->render('Serie/searchResult.html.twig', ['series' => $series]);

    }
}
