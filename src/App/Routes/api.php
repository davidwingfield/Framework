<?php
    /**
     * Short Api Routes Description
     *
     * Long Api Routes Description
     *
     * @package            Application\App
     * @subpackage         Routes
     */

    namespace Src\App\Routes;

    use Src\Core\Router;

    $routeLead = APIPATH . "/" . VERSION;

    Router::get($routeLead . '/providers', 'Provider@serveGet');
    Router::get($routeLead . '/providers/${provider_id}', "Provider@serveGet");
    Router::get($routeLead . '/providers/autocorrect', "Provider@autocorrect");

    //Router::get('login', 'StaticPagesController@serveLogin');
    //Router::get('home', 'StaticPagesController@serveHome');
