<?php
/**
 * This file hold all routes definitions.
 *
 * PHP version 7
 *
 * @author   WCS <contact@wildcodeschool.fr>
 *
 * @link     https://github.com/WildCodeSchool/simple-mvc
 */

$routes = [
    'Serie' => [
        ['list', '/list', 'GET'],
        ['form', '/admin', 'GET'],
        ['add', '/list/admin', ['GET','POST']],

    ],
    'Home' => [
        ['homePage', '/', 'GET'],
    ],

];
