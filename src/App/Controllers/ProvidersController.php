<?php

    namespace Src\App\Controllers;

    use Exception;
    use Src\App\Models\ProvidersModel;
    use Src\Core\Controller;
    use Src\Core\View;

    class ProvidersController extends Controller
    {
        public function __construct()
        {
            parent::__construct();
        }

        public static function index()
        {
            Controller::$debug_log->trace("TEST");
            $data = array(
                "types" => [],
                "provider" => [],
                "company" => [],
                "location" => [],
            );
            //$providers = ProvidersModel::get();
            //display($providers);
            try {
                View::render("providers/index", $data);
            } catch (Exception $e) {
                try {
                    View::render_invalid_page("providers/index", $data);
                    exit();
                } catch (Exception $e) {
                    Controller::$debug_log->error($e->getMessage());
                    exit();
                }

            }
        }

        public static function edit()
        {
            //echo __FILE__ . "<br>";
        }

        public static function serveEdit()
        {
            //view('home',['somedata'=>["this","is","awesome"]]);
        }

        public static function serveNew()
        {
            //view('home',['somedata'=>["this","is","awesome"]]);
        }

    }
