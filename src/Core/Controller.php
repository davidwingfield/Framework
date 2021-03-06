<?php

    namespace Src\Core;

    use Src\Logger\Log;

    /**
     * Short Controller Description
     *
     * Long Controller Description
     *
     * @package            Application\Core
     */
    class Controller
    {

        public static $log;
        public static $access_log;

        public function __construct()
        {
            global $DEBUG_LOGGER;
            global $ACCESS_LOGGER;

            $log = new Log();

            self::$log = $log;
            //self::$access_log = $ACCESS_LOGGER;

        }

        public static function init()
        {

        }

    }
