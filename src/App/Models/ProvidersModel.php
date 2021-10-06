<?php

    /**
     * ProvidersModel.php
     *
     * @subpackage   Model
     */

    namespace Src\App\Models;

    use Src\Core\Model;

    /**
     * Src\App\Models\ProvidersModel
     */
    class ProvidersModel extends Model
    {
        protected static $data = [
            "id" => array(),
            "company_id" => array(),
            "location_id" => array(),
            "code_direct_id" => array(),
            "provider_vendor" => array(),
            "email" => array(),
            "website" => array(),
            "enabled" => array(),
            "created_by" => array(),
            "date_created" => array(),
            "modified_by" => array(),
            "date_modified" => array(),
            "note" => array(),
        ];

        function __construct()
        {

        }

        public static function get(int $id = NULL): array
        {
            if (!is_null($id)) {
                Model::$db->where("id", $id);
            }

            Model::$db->where('enabled', 1);

            return Model::$db->get('provider');
        }

    }
