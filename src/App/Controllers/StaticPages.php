<?php

    namespace Src\App\Controllers;

    use Src\App\Models\AddressTypesModel;
    use Src\App\Models\AirportTypesModel;
    use Src\App\Models\CategoriesRatingsTypesModel;
    use Src\App\Models\CategoryModel;
    use Src\App\Models\ColorSchemeModel;
    use Src\App\Models\ContactTypesModel;
    use Src\App\Models\CurrencyModel;
    use Src\App\Models\LocationTypesModel;
    use Src\App\Models\MessageTypesModel;
    use Src\App\Models\PageModel;
    use Src\App\Models\PricingStrategyTypesModel;
    use Src\App\Models\RatingTypesModel;
    use Src\App\Models\SalesTypesModel;
    use Src\App\Models\StatusTypesModel;
    use Src\Core\Controller;
    use Src\Core\View;
    use Src\Logger\Log;

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

        private static function getDetails(int $page_id): array
        {
            $details = array(
                "parent_menu" => 0,
                "submenu_id" => 0,
                "title" => "",
                "heading" => "",
                "sub_heading" => "",
            );

            $page = PageModel::getOne($page_id);

            if ($page) {
                if (isset($page["menu_id"])) {
                    $menu = PageModel::getMenus($page["menu_id"]);
                    $parent_id = (!is_null($menu["parent_id"])) ? (int)$menu["parent_id"] : 1;
                    $sub_menu = (!is_null($menu["id"])) ? (int)$menu["id"] : 1;
                    define("PARENT_MENU", $parent_id);
                    define("SUB_MENU", $sub_menu);
                }
                $details["parent_menu"] = $parent_id;
                $details["submenu_id"] = $sub_menu;
                $details["title"] = (!is_null($page["title"])) ? $page["title"] : "generic title";
                $details["heading"] = (!is_null($page["heading"])) ? $page["heading"] : "generic heading";
                $details["sub_heading"] = (!is_null($page["sub_heading"])) ? $page["sub_heading"] : "generic subheading";
                $details["keywords"] = (!is_null($page["keywords"])) ? $page["keywords"] : "generic keywords";
                $details["description"] = (!is_null($page["description"])) ? $page["description"] : "generic description";
                // ----
                define("PAGE_AUTHOR", "David Wingfield");
                define("PAGE_DESCRIPTION", (!is_null($page["description"])) ? $page["description"] : "generic description");
                define("PAGE_KEYWORDS", (!is_null($page["description"])) ? $page["description"] : "generic description");
                define("PAGE_HEADING", (!is_null($page["heading"])) ? $page["heading"] : "Trips2Italy");
                define("PAGE_TITLE", (!is_null($page["title"])) ? $page["title"] : "Trips2Italy");
                define("PAGE_SUBHEADING", (!is_null($page["sub_heading"])) ? $page["sub_heading"] : "generic subheading");
            }

            return $details;
        }

        public static function profile()
        {
            $pageDetails = self::getDetails(13);

            $parent_id = 0;
            $submenu_id = 0;
            if (isset($pageDetails["parent_id"])) {
                $parent_id = (int)$pageDetails["parent_id"];
            }
            if (isset($pageDetails["submenu_id"])) {
                $submenu_id = (int)$pageDetails["submenu_id"];
            }
            // ----
            define("PAGE_TITLE", "");
            define("PAGE_HEADING", "");
            define("PAGE_SUBHEADING", "");
            define("BREAD_CRUMBS", "");
            define("PARENT_MENU", $pageDetails["parent_id"]);
            define("SUB_MENU", $pageDetails["submenu_id"]);
            // ----
            $data = array(
                "types" => self::getTypes(),
            );
            // ----
            View::render_template("pages/profile", $data);
            exit;
        }

        public static function index()
        {
            $pageDetails = self::getDetails(1);
            $breadcrumbs = "
            <li class='breadcrumb-item'>
                Home
            </li>";

            define("BREADCRUMBS", $breadcrumbs);

            // ----
            $data = array(
                "types" => self::getTypes(),
            );
            // ----
            View::render_template("pages/dashboard", $data);
            exit;
        }

        public static function login()
        {
            $page_id = 2;
            $page = PageModel::getOne($page_id);
            // ----
            define("PAGE_TITLE", "Login");
            define("PAGE_HEADING", "Login");
            define("PAGE_SUBHEADING", "Enter Loging Details");
            define("PARENT_MENU", (int)$page["parent_id"]);
            define("SUB_MENU", (int)$page["id"]);
            // ----
            $data = array(
                "types" => self::getTypes(),
            );
            // ----
            View::render_template("pages/login", $data);
            exit;
        }

        public static function logout()
        {
            $page_id = 3;
            $page = PageModel::getOne($page_id);
            // ----
            define("PAGE_TITLE", "");
            define("PAGE_HEADING", "");
            define("PAGE_SUBHEADING", "");
            define("BREAD_CRUMBS", "");
            define("PARENT_MENU", $page["parent_id"]);
            define("SUB_MENU", $page["id"]);
            // ----
            $data = array(
                "types" => self::getTypes(),
            );
            // ----

            $user_id = "{no user_id}";
            if (isset($_SESSION["user_id"])) {
                $user_id = $_SESSION["user_id"];
            }

            Log::$access_log->info("$user_id: Logged Out");
            $_SESSION = array();
            $params = session_get_cookie_params();
            setcookie(session_name(), '', time() - 42000, $params["path"], $params["domain"], $params["secure"], $params["httponly"]);
            session_destroy();

            header("Location: /");

            exit;
        }

        /**
         * @return array
         */
        public static function getTypes(): array
        {
            $results = array(
                "address_types" => AddressTypesModel::get(),
                "airport_types" => AirportTypesModel::get(),
                "categories_ratings_types" => CategoriesRatingsTypesModel::get(),
                "category" => CategoryModel::get(),
                "color_scheme" => ColorSchemeModel::get(),
                "contact_types" => ContactTypesModel::get(),
                "currency" => CurrencyModel::get(),
                "location_types" => LocationTypesModel::get(),
                "message_types" => MessageTypesModel::get(),
                "pricing_strategy_types" => PricingStrategyTypesModel::get(),
                "rating_types" => RatingTypesModel::get(),
                "sales_types" => SalesTypesModel::get(),
                "status_types" => StatusTypesModel::get(),
            );

            return $results;
        }

    }
