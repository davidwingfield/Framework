<?php

    namespace Src\Core;

    use Src\Init\Config;

    /**
     * Short Request Description
     *
     * Long Request Description
     *
     * @package            Application\Core
     */
    class Request
    {
        /**
         * returns the request uri.
         */
        public static function uri(): string
        {
            return trim(parse_url($_SERVER["REQUEST_URI"], PHP_URL_PATH), "/");

        }

        public static function params(): array
        {
            $params = [];

            $uri = filter_var(self::uri(), FILTER_SANITIZE_URL);
            
            $url = explode("/", $uri);

            foreach ($url AS $val) {
                if ($val !== "api" && $val !== "v" . Config::getVersion()) {
                    $params[] = $val;
                }

            }

            return $params;

        }

        public static function method()
        {
            return $_SERVER["REQUEST_METHOD"];
        }

    }
