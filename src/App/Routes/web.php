<?php

    /**
     * Short Web Routes Description
     *
     * Long Web Routes Description
     *
     * @package            Application\App
     * @subpackage         Routes
     */

    namespace Src\App\Routes;

    use Src\Core\Router;

    /** STATIC PAGE ROUTES */
    Router::get("", "StaticPages@index");
    Router::get("login", "StaticPages@login");
    Router::get("logout", "StaticPages@logout");
    Router::get("profile", "StaticPages@profile");

    /** PROVIDER PAGE ROUTES */
    Router::get('providers/${provider_id}', "Provider@edit");
    Router::get("providers", "Provider@index");

    /** PROVIDER PAGE ROUTES */

    /** TESTPOST */

    Router::get('users/${user_id}/products/${product_id}', "User@get_products_by_user");

