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
        return $this->twig->render('Serie/list.html.twig', ['series' => $series,'page' => $page,'pageMax' => $pageMax]);
    }

    /**
     * @return string
     * @throws \Twig_Error_Loader
     * @throws \Twig_Error_Runtime
     * @throws \Twig_Error_Syntax
     */
    public function listAdmin()
    {
        $serieManager = new SerieManager();
        $series = $serieManager->selectAll();

        return $this->twig->render('Serie/listAdmin.html.twig', ['series' => $series]);
    }

    /**
     * @param int $id
     * @return string
     * @throws \Twig_Error_Loader
     * @throws \Twig_Error_Runtime
     * @throws \Twig_Error_Syntax
     */
    public function selectSerie(int $id)
    {
        $serieManager = new SerieManager();
        $serie = $serieManager->selectOneById($id);

        return $this->twig->render('Serie/pageSerie.html.twig', ['serie' => $serie]);
    }

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
            $lastId = $serieManager->insert($data);
            header('Location: /pageSerie/admin/'.$lastId);

        }
    }

    /**
     * @throws \Exception
     */
    public function viewAfterUpdate()
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
            $id = $data['id'];
            array_splice($data, 0, 1);
            $serieManager->update($id, $data);
            header('Location: /list/admin/1');
        }

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
        $series = $serieManager->searchBar($_GET['search']);

        return $this->twig->render('Serie/searchResult.html.twig', ['series' => $series]);

    }
}
