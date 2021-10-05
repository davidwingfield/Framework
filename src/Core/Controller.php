<?php

    namespace Src\Core;

    class Controller
    {
        public static $debug_log;
        public static $event_log;
        public static $access_log;
        public static $image_log;
        public static $batch_log;

        public function __construct()
        {
            //display(__FILE__);
            global $MAIN_API_FILE_LOGGER;
            global $DEBUG_LOGGER;
            global $ACCESS_LOGGER;
            global $BATCH_LOGGER;
            global $IMAGE_LOGGER;
            self::$debug_log = $DEBUG_LOGGER;
            self::$access_log = $ACCESS_LOGGER;
            $image_log = $IMAGE_LOGGER;
            $batch_log = $BATCH_LOGGER;
            $event_log = $MAIN_API_FILE_LOGGER;

        }

    }
