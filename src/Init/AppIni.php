<?php
    /**
     * AppIni.php
     *
     * @return
     */

    namespace Src\Init;

    class AppIni
    {
        protected static $path = "/app.ini";
        protected static $ini = [];

        public static function load(): void
        {
            if (file_exists(ROOT_PATH . self::$path)) {
                self::$ini = parse_ini_file(ROOT_PATH . self::$path);
                self::set();
            }

        }

        private static function set()
        {
            Config::init(self::$ini);
        }

    }
