<?php

    namespace Src\App\Controllers;

    use Src\Core\Controller;
    use Src\Core\View;

    /**
     * Short StaticPages Description
     *
     * Long StaticPages Description
     *
     * @package            Application\App
     * @subpackage         Controllers
     */
    class StaticPages extends Controller
    {
        public function __construct()
        {
            parent::__construct();
        }

        public static function index()
        {
            $data = array(
                "types" => [],
                "provider" => [],
                "company" => [],
                "location" => [],
            );

            View::render_template("pages/dashboard", $data);
        }

        public static function login()
        {

        }

    }
