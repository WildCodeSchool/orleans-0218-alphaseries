<?php
/**
 * Created by PhpStorm.
 * User: aragorn
 * Date: 03/04/18
 * Time: 17:12
 */

namespace Controller;

use Model\HomeManager;

class HomeController extends AbstractController
{
    /**
     * @return mixed
     */
    public function homePage()
    {
        $homeManager = new HomeManager();
        $series = $homeManager->showLimitedSeries(3);
        return $this->twig->render('Home/index.html.twig', ['series' => $series]);
    }

    public function printInfo()
    {

        return $this->twig->render('Home/conditions_generales.html.twig');
    }

}
