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
        ['viewAfterUpdate', '/admin/serie', 'POST'],

    ],
    'Season' => [
        ['addSeason', '/admin/season', 'POST'],
        ['allSeasons', '/pageSerie/admin/{id:\d+}', 'POST'],
    ],
    'Episode' => [
        ['addEpisode', '/admin/episode', 'POST'],
    ],
    'Home' => [
        ['homePage', '/', 'GET'],
    ],

];
