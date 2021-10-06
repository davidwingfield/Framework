<?php

    namespace Src\Init;

    use Src\Core\Controller;
    use Src\Core\Model;
    use Src\Core\View;
    use Src\Exception\ErrorHandler;
    use Src\Logger\Log;

    require_once("vendor/autoload.php");

    define("ROOT_PATH", $_SERVER["DOCUMENT_ROOT"]);
    define("ROUTES_PATH", ROOT_PATH . "/src/App/Routes");
    define("VIEWS_PATH", ROOT_PATH . "/src/App/Views");

    include_once("logger_config.php");

    const DEV = 0;
    const PRODUCTION = 1;

    #development_mode : DEV / PRODUCTION
    const development_mode = DEV;
    ////
    Log::init();
    Controller::init();
    AppIni::load();
    Model::init();
    View::init();
    $ErrorHandler = new ErrorHandler();
    ////
    require_once(__DIR__ . "/index.php");
    include(__DIR__ . "/functions.php");
    ////

    set_error_handler(array(
        $ErrorHandler,
        "handleError",
    ));


    
