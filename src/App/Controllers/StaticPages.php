<?php
    /**
     * StaticPages.php
     *
     * @subpackage   Controllers
     */

    namespace Src\App\Controllers;

    use Src\Core\Controller;
    use Src\Core\View;

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
