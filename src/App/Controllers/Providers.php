<?php
    /**
     * Providers.php
     *
     * @license      http://opensource.org/licenses/gpl-3.0.html GNU Public License
     * @author       David Wingfield <David@trips2italy.com>
     * @copyright    Copyright (c) 2021-2022
     * @version      1.0.0
     * @category     Controllers
     * @subpackage   Controllers
     */

    namespace Src\App\Controllers;

    use Exception;
    use Src\App\Models\ProvidersModel;
    use Src\Core\Controller;
    use Src\Core\View;

    /**
     * Src\App\Controllers\Providers
     *
     * This is the short Desc
     *
     * This is the Long desc
     */
    class Providers extends Controller
    {
        public function __construct()
        {
            parent::__construct();
        }

        /**
         * index
         *
         * Loads Provider Index
         */
        public static function index(): void
        {
            $data = array(
                "types" => [],
                "provider" => ProvidersModel::get(2),
                "company" => [],
                "location" => [],
            );

            try {
                View::render_template("providers/index", $data);
                exit();
            } catch (Exception $e) {
                View::render_invalid_page(500, (array)$e);
                exit();

            }
        }

        /**
         * edit
         *
         * Loads Provider Edit
         */
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
