<?php

    namespace Src\App\Controllers;

    use Src\Core\Controller;
    use Src\Core\View;

    /**
     * Short User Description
     *
     * Long User Description
     *
     * @package            Application\App
     * @subpackage         Controllers
     */
    class User extends Controller
    {
        public function __construct()
        {
            parent::__construct();
        }

        public static function get_products_by_user(array $params = [])
        {
            if (isset($params["user_id"])) {
                $params["user_id"] = (int)$params["user_id"];
            }
            if (isset($params["user_id"])) {
                $params["product_id"] = (int)$params["product_id"];
            }
            View::render_json($params);
            exit;
        }

    }
