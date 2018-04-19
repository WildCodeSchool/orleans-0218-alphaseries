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
        ['list', '/list/{page}', 'GET'],
        ['selectSerie', '/pageSerie/{id:\d+}', 'GET'],
        ['editSerie', '/pageSerie/admin/{id:\d+}', 'GET'],
        ['search', '/searchResult', 'GET'],
        ['addView', '/admin', 'GET'],
        ['listAdmin', '/list/admin/', 'GET'],
        ['viewAfterAdd', '/admin', 'POST'],
        ['viewAfterUpdate', '/pageSerie/admin/{id:\d+}', 'POST'],
        ['viewAfterDelete', '/admin/delete/', 'POST'],
    ],
    'Season' => [
        ['addSeason', '/admin/season', 'POST'],
    ],
    'Home' => [
        ['homePage', '/', 'GET'],
    ],

];
