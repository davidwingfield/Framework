<?php
    /**
     * Short Description
     *
     * Long AppIni Description
     *
     * @package            Application\Init
     */

    namespace Src\Init;

    require_once("vendor/autoload.php");

    session_start();
    
    use Src\App\Middlewares\Auth;
    use Src\Core\Request;
    use Src\Core\Router;
    use Src\Exception\ErrorHandler;
    use Src\Core\Controller;
    use Src\Core\Model;
    use Src\Core\View;
    use Src\Logger\Log;

    include_once(__DIR__ . "/logger_config.php");

    $ini = [];
    if (file_exists(ROOT_PATH . "/app.ini")) {
        $ini = AppIni::parse_ini_file_multi(ROOT_PATH . "/app.ini", true);
    }

    define("DBPASS", $ini["database"]["db_pass"]);
    define("DBHOST", $ini["database"]["db_host"]);
    define("DBNAME", $ini["database"]["db_name"]);
    define("DBUSER", $ini["database"]["db_user"]);
    define("DBPORT", $ini["database"]["db_port"]);
    define("DBPERSISTENT", $ini["database"]["db_persistent"]);
    define("DBLOGINATTEMPTS", $ini["database"]["db_loginattempts"]);
    define("EXPIRETIME", $ini["database"]["expire_time"]);
    define("VERSION", $ini["application"]["version"]);
    define("PATH", $ini["application"]["path"]);
    define("APIPATH", $ini["application"]["api_path"]);
    define("DEVMODE", $ini["application"]["development_mode"]);
    define("MAILADDRESS", $ini["application"]["email"]);
    define("LOGINATTEMPTS", $ini["database"]["db_loginattempts"]);

    const DEV = 0;
    const PRODUCTION = 1;

    #development_mode : DEV / PRODUCTION
    const ENVIRONMENT = DEV;

    include_once(__DIR__ . "/functions.php");

    //sec_session_start();

    Config::init();
    Controller::init();
    AppIni::init($ini);
    Model::init();
    View::init();
    // ----
    Log::clear();

    $ErrorHandler = new ErrorHandler();

    set_error_handler(array(
        $ErrorHandler,
        "handleError",
    ));

    /*
    ini_set("display_errors", 0);
    ini_set("error_reporting", E_ALL);
    //*/

    $route_params = Router::load([
        ROUTES_PATH . "/web.php",
        ROUTES_PATH . "/api.php",
    ])::direct(Request::uri(), Request::method());

    if (isset($route_params["controller"], $route_params["action"])) {
        $controller = $route_params["controller"];
        $action = $route_params["action"];

        if (Request::src()) {//api call

            if (!Auth::authenticate($route_params["action"])) {
                header("HTTP/1.1 401 Unauthorized");
                exit("Unauthorized");
            }

        } else {

            if (!Auth::logged_in() && Request::uri() !== "login" && Request::uri() !== "logout") {
                header("Location: /login");
                exit;
            }

        }

        $controller->$action($route_params["params"]);
    }


    
