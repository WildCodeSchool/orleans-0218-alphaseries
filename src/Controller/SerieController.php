<?php
/**
 * Created by PhpStorm.
 * User: aragorn
 * Date: 03/04/18
 * Time: 17:12
 */

namespace Controller;

use Model\HomeManager;
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
    public function addView()
    {
        return $this->twig->render('Serie/add.html.twig');
    }

    /**
     * @return string
     * @throws \Twig_Error_Loader
     * @throws \Twig_Error_Runtime
     * @throws \Twig_Error_Syntax
     * @throws \Exception
     */
    public function viewAfterAdd()
    {
        if (!empty($_POST)){
            $data = $this->cleanPost($_POST);
            if (empty($data['title'])){
                throw new \Exception('Le champ titre est requis!');
            }
            if (strlen($data['title']) > 255){
                throw new \Exception('Le titre est trop long!');
            }
            if (!preg_match('/^([0-9]{4})-([0-9]{2})-([0-9]{2})$/', $data['creation_date'], $date)) {

                if (!checkdate($date[2], $date[3], $date[1])) {
                    throw new \Exception('Date invalide');
                }
            }
            $serieManager = new SerieManager();
            $series = $serieManager->insert($data);

        }

        return $this->twig->render('Serie/adminSerie.html.twig', ['series' => $series]);
    }
    public function search()
    {
        $serieManager = new SerieManager();
        $series = $serieManager->searchbar($_GET['search']);

        return $this->twig->render('Serie/searchResult.html.twig', ['series' => $series]);

    }
}
