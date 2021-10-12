<?php

    namespace Src\App\Controllers;

    use Exception;
    use Src\App\Controllers\StaticPages;
    use Src\App\Models\CompanyModel;
    use Src\App\Models\ProviderModel;
    use Src\Core\Controller;
    use Src\Core\View;

    /**
     * Short Provider Description
     *
     * Long Provider Description
     *
     * @package            Application\App
     * @subpackage         Controllers
     */
    class Provider extends Controller
    {
        protected static $data = [];

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
            $page_id = 5;
            // ----
            define("PAGE_TITLE", "Login");
            define("PAGE_HEADING", "Login");
            define("PAGE_SUBHEADING", "Enter Loging Details");
            define("PARENT_MENU", 0);
            define("PARENT_SUB_MENU", 0);

            define("BREAD_CRUMBS", "");
            $data = array(
                "types" => StaticPages::getTypes(),
                "provider" => ProviderModel::get(),
                "company" => [],
                "location" => [],
            );

            try {
                View::render_template("providers/index", self::$data);
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
        public static function edit(array $params = [])
        {
            if (isset($params["provider_id"])) {
                $provider_id = (int)$params["provider_id"];
            }
            // ----
            $page_id = 6;
            // ----
            define("PAGE_TITLE", "Login");
            define("PAGE_HEADING", "Login");
            define("PAGE_SUBHEADING", "Enter Loging Details");
            define("PARENT_MENU", 0);
            define("PARENT_SUB_MENU", 0);

            define("BREAD_CRUMBS", "");
            // ----
            $provider_id = null;
            $providers = [];
            $address_detail = [];
            $company_detail = [];
            $provider_detail = ProviderModel::getOne($provider_id);
            if (isset($provider_detail["company_id"])) {
                $company_id = (int)$provider_detail["company_id"];
                if (isset($company_id) && intval($company_id) > 0) {
                    $company_detail = CompanyModel::getOne($company_id);

                }

            }

            // ----
            $data = array(
                "types" => StaticPages::getTypes(),
                "provider_detail" => $provider_detail,
                "company_detail" => $company_detail,
                "address_detail" => $address_detail,
            );
            $breadcrumbs = "
                    <li class='breadcrumb-item'>
                        <a href='/providers'>Providers</a>
                    </li>
                    <li class='breadcrumb-item'>
                        $provider_id
                    </li>";

            $provider_detail = ProviderModel::getOne($provider_id);

            $providers[] = array(
                "provider_detail" => $provider_detail,
                "company_detail" => $company_detail,
                "address_detail" => $address_detail,
            );

            View::render_template("providers/edit", self::$data);
        }

        public static function serveGet()
        {
            var_dump("tert", 1);
        }

        public static function autocomplete()
        {
            var_dump("tert", 1);
        }

        private static function format($providers = [])
        {

        }

    }
