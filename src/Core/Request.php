<?php
    /**
     * Request.php
     *
     * @return
     */

    namespace Src\Core;

    class Request
    {
        /**
         * returns the request uri.
         */
        public static function uri()
        {
            return trim(parse_url($_SERVER["REQUEST_URI"], PHP_URL_PATH), '/');
        }

        public static function method()
        {
            return $_SERVER["REQUEST_METHOD"];
        }

    }