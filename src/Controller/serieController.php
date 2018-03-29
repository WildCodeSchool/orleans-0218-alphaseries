<?php
/**
 * Created by PhpStorm.
 * User: wilder19
 * Date: 29/03/18
 * Time: 16:16
 */

namespace Controller;


class serieController extends AbstractController
{
    public function accroche()
    {
        return $this->twig->render('serie/accroche.html.twig');
    }
}