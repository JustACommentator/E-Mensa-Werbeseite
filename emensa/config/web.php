<?php
/**
 * Mapping of paths to controllers.
 * Note, that the path only supports one level of directory depth:
 *     /demo is ok,
 *     /demo/subpage will not work as expected
 */
session_start();

return array(
    '/home'         => 'HomeController@index',
    '/demo'         => 'DemoController@demo',
    '/dbconnect'    => 'DemoController@dbconnect',
    '/debug'        => 'HomeController@debug',

    '/6b' => 'ExampleController@m4_6b_kategorie',
    '/6c' => 'ExampleController@m4_6c_gerichte',
    '/6d' => 'ExampleController@m4_6d_layout',

    // Erstes Beispiel:
    '/6a' => 'ExampleController@m4_6a_queryparameter',
    '/m4' => 'ExampleController@m4_6a_queryparameter',


    //Werbeseite
    '/' => 'WerbeseitenController@home',
    '/soup' => 'WerbeseitenController@soup',
    '/login' => 'WerbeseitenController@login',
    '/logout' => 'WerbeseitenController@logout',
    '/logtest' => 'WerbeseitenController@logtest',
    '/bewertung' => 'WerbeseitenController@bewerten',
    '/highlight' => 'WerbeseitenController@highlight',
    '/addreview' => 'WerbeseitenController@addreview',
    '/newsletter' => 'WerbeseitenController@newsletter',
    '/bewertungen' => 'WerbeseitenController@bewertungen',
    '/deletereview' => 'WerbeseitenController@deleteReview',
    '/wunschgericht' => 'WerbeseitenController@wunschgericht',
    '/meinebewertungen' => 'WerbeseitenController@meinebewertungen',
);