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
