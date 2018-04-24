<?php
/**
 * Created by PhpStorm.
 * User: aragorn
 * Date: 03/04/18
 * Time: 17:12
 */
namespace Controller;
use Model\HomeManager;
use Model\SeasonManager;
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
     * @param int $page
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
     * @param int $id
     * @return string
     * @throws \Twig_Error_Loader
     * @throws \Twig_Error_Runtime
     * @throws \Twig_Error_Syntax
     */
    public function editSerie(int $id)
    {
        $serieManager = new SerieManager();
        $serie = $serieManager->selectOneById($id);
        $saisonManager = new SeasonManager();
        $seasons = $saisonManager->selectAllByFk('idserie', 'id', $id, 'serie', 'numberSeason');
        return $this->twig->render('Serie/adminSerie.html.twig', ['serie' => $serie, 'idSerie' => $id, 'seasons' => $seasons]);
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
            try{
                $file = $_FILES["fichier"];
                $data['link_picture'] = $serieManager->upload($file);
                $lastId = $serieManager->insert($data);
                header('Location: /pageSerie/admin/'.$lastId);
                exit();
            }catch (\Exception $e){
                echo 'Exception reçue : ',  $e->getMessage(), "\n";
            }
        }
    }
    /**
     * @throws \Exception
     */
    public function viewAfterUpdate()
    {
        if (!empty($_POST)){
            $data = $this->cleanPost($_POST);
            $idSerie = $data['idSerie'];
            if (!isset($data['nbSeasons'])) {
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
                unset($data['idSerie']);
                $serie = $serieManager->selectOneById($idSerie);
                if ($serie->getLink_Picture()) {
                    if ($data[ 'edit_image' ]) {
                        $fileName = 'assets/upload/' . $data[ 'link_picture' ];
                        if (file_exists($fileName)) {
                            unlink($fileName);
                        }
                        $data[ 'link_picture' ] = null;
                    }
                    unset($data[ 'edit_image' ]);
                }
                else {
                    $file = $_FILES["fichier"];
                    $data['link_picture'] = $serieManager->upload($file);
                }
                $serieManager->update($idSerie, $data);
                header('Location: /list/admin/');
                exit();
            }
        }
    }
    public function viewAfterDelete()
    {
        if (!empty($_POST)) {
            $id = trim($_POST['serieId']);
            $serieManager = new SerieManager();
            $serieManager->delete($id);
            header('Location: /list/admin/');
            exit();
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