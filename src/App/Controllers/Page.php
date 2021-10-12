<?php

    namespace Src\App\Controllers;

    use Src\App\Models\PageModel;
    use Src\Core\Controller;

    /**
     * Short Page Description
     *
     * Long Page Description
     *
     * @package            Application\App
     * @subpackage         Controllers
     */
    class Page extends Controller
    {
        public function __construct()
        {
            parent::__construct();
        }

        public static function buildSideMenu(int $parent_id = 0, int $sub_id = 0): string
        {
            $parent_menu = array();
            $sub_menu = array();
            $role_id = 1;

            $menus = PageModel::getMenus();

            return "";
        }

    }
