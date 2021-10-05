<?php
    /**
     * src/index.php
     */

    namespace Src;

    use Src\App\Middlewares\Auth;
    use Src\Core\Request;
    use Src\Core\Router;

    require $_SERVER["DOCUMENT_ROOT"] . "/src/Init/bootstrap.php";

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
        display($route_params, "route_params");
        $controller->$action();
    }



