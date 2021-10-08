<?php

    namespace Src\App\Controllers;

    use Exception;
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

            if (isset($params["provider_id"])) {
                $provider_id = (int)$params["provider_id"];
            }

            $provider_detail = ProviderModel::get($provider_id);

            self::$data = [
                "types" => [],
                "provider" => $provider_detail,
                "company" => [],
                "location" => [],
                "addresses" => [],
                "contacts" => [],
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
