<?php

    namespace Src\Init;

    use Src\Core\Model;

    require_once("vendor/autoload.php");

    define("ROOT_PATH", $_SERVER["DOCUMENT_ROOT"]);
    define("ROUTES_PATH", ROOT_PATH . "/src/App/Routes");
    define("VIEWS_PATH", ROOT_PATH . "/src/App/Views");

    include_once("logger_config.php");

    const DEV = 0;
    const PRODUCTION = 1;

    #development_mode : DEV / PRODUCTION
    $development_mode = DEV;

    AppIni::load();
    Model::init();
    require_once(__DIR__ . "/index.php");
    require_once(__DIR__ . "/functions.php");

    
