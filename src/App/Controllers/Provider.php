<?php

    namespace Src\App\Controllers;

    use Exception;
    use Src\App\Models\AddressTypesModel;
    use Src\App\Models\CategoryModel;
    use Src\App\Models\CompanyModel;
    use Src\App\Models\ContactTypesModel;
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
            self::$data = array(
                "types" => [],
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
            $provider_id = null;
            $providers = [];
            if (isset($params["provider_id"])) {
                $provider_id = (int)$params["provider_id"];
            }

            $provider_detail = ProviderModel::getOne($provider_id);

            $address_detail = [];
            $company_detail = [];

            if (isset($provider_detail["company_id"])) {
                $company_id = (int)$provider_detail["company_id"];
                $company_detail = CompanyModel::getOne($company_id);
            }

            $providers[] = array(
                "provider_detail" => $provider_detail,
                "company_detail" => $company_detail,
                "address_detail" => $address_detail,
            );

            self::$data = [
                "types" => array(
                    "contact_types" => ContactTypesModel::get(),
                    "address_types" => AddressTypesModel::get(),
                    "category" => CategoryModel::get(),
                ),
                "provider_detail" => $provider_detail,
                "company_detail" => $company_detail,
                "address_detail" => $address_detail,
            ];

            View::render_template("providers/edit", self::$data);
        }

        public static function serveGet()
        {
            View::render_json($_GET);
        }

        public static function autocorrect()
        {
            var_dump("tert", 1);
        }

    }
