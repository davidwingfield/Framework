<?php

    namespace Src\Core;

    use Exception;

    class Router
    {
        private static $controllerNamespace = 'Src\\App\\Controllers\\';

        public static $routes = [
            'GET' => [],
            "POST" => [],
            "DELETE" => [],
            "PATCH" => [],
            "OPTIONS" => [],
            "PUT" => [],
        ];

        /**
         * @param $uri
         * @param $controller
         *
         * @return mixed
         */
        public static function get($uri, $controller)
        {

            return self::$routes["GET"][trim($uri, '/')] = $controller;
        }

        public static function post($uri, $controller)
        {

            return self::$routes["POST"][trim($uri, '/')] = $controller;
        }

        public static function delete($uri, $controller)
        {

            return self::$routes["DELETE"][trim($uri, '/')] = $controller;
        }

        public static function patch($uri, $controller)
        {

            return self::$routes["PATCH"][trim($uri, '/')] = $controller;
        }

        /**
         * @param array $files
         *
         * @return Router
         */
        public static function load($files = [])
        {
            $instance = new static();

            foreach ($files as $file) {
                require_once $file;
            }

            return $instance;
        }

        public static function direct($uri, $requestType)
        {

            if (!isset(self::$routes[$requestType])) {
                http_response_code(503);
                header("Content-type:application/json");
                $data = array(
                    "status" => "error",
                    "message" => "Bad Request. Unknown request method $requestType",
                    "code" => 503,
                );

                View::render_invalid_json($data, 503);
                exit();
            }

            $routeFound = NULL;

            foreach (self::$routes[$requestType] as $key => $route) {
                $regex = self::parseRoute(trim($key, "/"));
                if (preg_match($regex, trim($uri, "/"))) {
                    $routeFound = $route;
                    break;
                }
            }

            if ($routeFound) {
                return static::mapController(...explode('@', $routeFound));
            }

            try {
                http_response_code(404);
                header("HTTP/1.1 404 Not Found");
                View::render("errors/404");
                exit;
            } catch (Exception $e) {
                //display($e->getMessage());
                exit();
            }
        }

        /**
         * @param $controller
         * @param $action
         *
         * @return mixed
         */
        public static function mapController($controller, $action)
        {
            $controller = (self::$controllerNamespace . $controller);
            //
            if (class_exists($controller)) {
                $controller = new $controller; //renew the controller class
                if (method_exists($controller, $action)) {
                    return array(
                        "controller" => $controller,
                        "action" => $action,
                    );
                    //return $controller->$action();
                }
            }

            try {
                View::render("errors/500");
                exit;
            } catch (Exception $e) {
                //$error = array();
                //display($e->getMessage());
                exit();
            }

        }

        private static function parseRoute(string $route = ""): string
        {
            $path = explode("/", $route);
            $regex = [];

            foreach ($path AS $el) {
                if ($el !== "") {
                    $temp = preg_replace('/^(\/)$/', "(\/)", $el);
                    $temp = preg_replace('/^(\$\{)([a-z_]*)(\})$/', "(\d+)", $temp);
                    $temp = preg_replace('/^[a-z_]*$/', "($el)", $temp);
                    $regex[] = $temp;
                }
            }

            return '/^' . implode("\/", $regex) . '$/';
        }

    }
