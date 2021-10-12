<?php

    use Src\Init\AppIni;

    /**
     * Used for logging all php notices,warings and etc in a file when error reporting
     * is set and display_errors is off
     *
     * @author Aditya Mehrotra<aditycse@gmail.com>
     * @uses   used in prod env for logging all type of error of php code in a file for further debugging
     *         and code performance
     */

    function sec_session_start()
    {
        /** Set a custom session name */
        $session_name = "sec_session_id";
        $secure = SECURE;

        /** This stops JavaScript being able to access the session id. */
        $httponly = true;

        /** Forces sessions to only use cookies. */
        if (ini_set("session.use_only_cookies", 1) === false) {
            header("Location: ../error.php?err=Could not initiate a safe session (ini_set)");
            exit();
        }

        /** Gets current cookies params. */
        $cookieParams = session_get_cookie_params();
        session_set_cookie_params($cookieParams["lifetime"], $cookieParams["path"], $cookieParams["domain"], $secure, $httponly);

        /** Sets the session name to the one set above. */
        session_name($session_name);

        /** Start the PHP session */
        session_start();
        /** regenerated the session, delete the old one. */
        session_regenerate_id();
    }

    define("ROOT_PATH", $_SERVER["DOCUMENT_ROOT"]);
    define("ROUTES_PATH", ROOT_PATH . "/src/App/Routes");
    define("VIEWS_PATH", ROOT_PATH . "/src/App/Views");
    define("INI_PATH", ROOT_PATH . "/app.ini");

    define("SECURE", false);

    if (session_id() == "") {
        //sec_session_start();
    } else {
        //echo "<pre>" . var_export($_SESSION, 1) . "</pre>";
    }

    require_once(__DIR__ . "/public/index.php");
