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
    const LIMIT = 12;
    const PAGEMIN = 0;

    /**
     * Display serie listing
     * @param int $page
     * @param int $pageMax
     * @return string
     * @throws \Twig_Error_Loader
     * @throws \Twig_Error_Runtime
     * @throws \Twig_Error_Syntax
     */
    public function list(int $page)
    {
        $serieManager = new SerieManager();

        $pageMax = $serieManager->recupPageMax();

        if ($page < 1) {
            $page = 1;
        }

        if ($page > $pageMax) {
            $page = $pageMax;
        }

        $series = $serieManager->selectByPage($page, self::LIMIT);
        return $this->twig->render('Serie/list.html.twig', [
                'series' => $series,
                'page' => $page,
                'pageMax' => $pageMax,
            ]
        );
    }

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
