<?php

    /**
     * Created by PhpStorm.
     * User: mimidots
     * Date: 6/5/2018
     * Time: 6:33 PM
     */

    namespace Src\App\Models;

    use Src\Core\Model;

    class ProvidersModel extends Model
    {
        protected static $data = [];

        public static function get(int $id = NULL): array
        {
            if (!is_null($id)) {
                Model::$db->where("id", $id);
            }

            Model::$db->where('enabled', 1);

            return Model::$db->get('provider');
        }

    }
