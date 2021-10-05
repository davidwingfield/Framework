<?php
    /**
     * View.php
     *
     * @return
     */

    namespace Src\Core;

    use Exception;

    class View
    {
        protected static $status = array(
            200 => "200 OK",
            400 => "400 Bad Request",
            401 => "401 Unauthorized",
            402 => "402 Payment Required",
            403 => "403 Forbidden",
            404 => "404 Not Found",
            405 => "405 Method Not Allowed",
            422 => "Unprocessable Entity",
            500 => "500 Internal Server Error",
            502 => "502 Bad Gateway",
            503 => "503 Service Unavailable",
            504 => "504 Gateway Timeout",
        );

        /**
         * @throws Exception
         */
        public static function render(string $view, array $data = []): void
        {
            extract($data, EXTR_SKIP);
            $file = VIEWS_PATH . "/$view" . ".phtml";
            if (is_readable($file)) {
                require $file;
            } else {
                throw new Exception("$file not found");
            }
        }

        public static function render_json(array $data = [], int $code = 200)
        {
            header_remove();
            http_response_code($code);
            header("Cache-Control: no-transform,public,max-age=300,s-maxage=900");
            header("Content-Type: application/json");
            header("Content-type:application/json");
            header("Status: " . self::$status[$code]);

            $return = array(
                "status" => "success",
                "result" => $data,
                "errors" => array(),
            );

            echo json_encode($return, 1);
            exit();
        }

        public static function render_invalid_json($message = NULL, int $code = 200)
        {
            header_remove();
            http_response_code($code);
            header("Cache-Control: no-transform,public,max-age=300,s-maxage=900");
            header("Content-Type: application/json");
            header("Content-type:application/json");
            header("Status: " . self::$status[$code]);

            $return = array(
                "code" => $code,
                "status" => "error",
                "error" => $message,
            );

            echo json_encode($return, 1);
            exit();
        }

        /**
         * @throws \Exception
         */
        public static function render_invalid_page(int $code = 200, array $data = [])
        {
            header_remove();
            http_response_code($code);
            header("Cache-Control: no-transform,public,max-age=300,s-maxage=900");
            header("Content-Type: application/json");
            header("Content-type:application/json");
            header("Status: " . self::$status[$code]);

            $view = "errors/500.phtml";
            extract($data, EXTR_SKIP);
            $file = VIEWS_PATH . "/$view" . ".phtml";
            ////
            if (is_readable($file)) {
                require $file;
            } else {
                throw new Exception("$file not found");
            }
            ////
        }

    }
