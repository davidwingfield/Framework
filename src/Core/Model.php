<?php

    namespace Src\Core;

    use Src\Init\Config;

    class Model
    {

        public static $db;

        public static function init()
        {
            if (self::$db === NULL) {
                self::$db = new MysqliDb(Config::getDBHost(), Config::getDBUser(), Config::getDBPass(), Config::getDBName());
            }
        }

    }
