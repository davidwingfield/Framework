<?php
    /**
     * Web.php
     *
     * @return
     */

    namespace Src\App\Routes;

    use Src\Core\Router;

    /** STATIC PAGE ROUTES */
    Router::get('', 'StaticPages@index');
    Router::get('login', 'StaticPages@login');

    /** PROVIDER PAGE ROUTES */
    Router::get('providers/${provider_id}', 'Providers@edit');
    Router::get('providers', 'Providers@index');
    /** PROVIDER PAGE ROUTES */
    Router::get('users/${user_id}/books/${book_id}', 'StaticPages@serveHome');


