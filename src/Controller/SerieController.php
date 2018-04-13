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
            if (empty($_POST['title'])){
                throw new \Exception('Le champ titre est requis!');
            }
            if (strlen($_POST['title']) > 255){
                throw new \Exception('Le titre est trop long!');
            }
            if (!preg_match('/^[0-9]{4}-(0[1-9]|1[0-2])-(0[1-9]|[1-2][0-9]|3[0-1])$/', $_POST['creation_date'])){
                throw new \Exception('Date invalide');
            }
            $serieManager = new SerieManager();
            $series = $serieManager->insert($data);

        }

        return $this->twig->render('Serie/adminSerie.html.twig', ['series' => $series]);
    }

}
