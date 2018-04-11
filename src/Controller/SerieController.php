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
     */
    public function listAfterAdd()
    {
        $serieManager = new SerieManager();
        $serieManager->addSerie($this->cleanPost($_POST));
        $series = $serieManager->selectAll();

        return $this->twig->render('Serie/listAdmin.html.twig', ['series' => $series]);
    }

    public function cleanPost(array $data) {
        foreach ($data as $key => $item){
            $data[$key] = trim($item);
            $data[$key] = htmlspecialchars($item);
        }
        return $data;
    }
}
