<?php
    /**
     * FrameWork
     *
     * PHP Version 5
     *
     * @author      David Wingfield <David@trips2italy.com>
     * @copyright   Copyright (c) 2021-2022
     * @version     1.0.0
     * @category    FrameWork
     * @package     FrameWork
     * @link        https://trips2Italy.com/docs/FrameWork/
     */

    namespace Src;

    use Src\App\Middlewares\Auth;
    use Src\Core\Request;
    use Src\Core\Router;
    use Src\Exception\ErrorHandler;
    use Src\Exception\ViewException;
    use Src\Logger\Log;

    include $_SERVER["DOCUMENT_ROOT"] . "/src/Init/bootstrap.php";

    ///////////////////////////////////////////////
    //ini_set("display_errors", 0);
    //ini_set("error_reporting", E_ALL);
    ///////////////////////////////////////////////

    // send some CORS headers so the API can be called from anywhere
    header("Access-Control-Allow-Origin: *");
    header("Access-Control-Allow-Methods: OPTIONS,GET,POST,PUT,DELETE");
    header("Access-Control-Max-Age: 3600");
    header("Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Headers, Authorization, X-Requested-With");

    $route_params = Router::load([
        ROUTES_PATH . "/web.php",
        ROUTES_PATH . "/api.php",
    ])::direct(Request::uri(), Request::method());

    if (isset($route_params["controller"], $route_params["action"])) {
        if (!Auth::logged_in()) {
            header("HTTP/1.1 401 Unauthorized");
            exit('Unauthorized');
        }

        $controller = $route_params["controller"];
        $action = $route_params["action"];
        $controller->$action();
    }





