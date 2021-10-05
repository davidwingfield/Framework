<?php
    /**
     * StaticPagesController.php
     *
     * @return
     */

    namespace Src\App\Controllers;

    use Src\Core\Controller;

    class StaticPagesController extends Controller
    {
        public function __construct()
        {
            parent::__construct();
        }
        
        public static function index()
        {
            //echo __FILE__ . "<br>";
            //$providers =

            //$this->respondOK($customers);
        }

        public static function login()
        {
            //echo __FILE__ . "<br>";
        }

    }
