<?php

    namespace Src\App\Models;

    use Exception;
    use Src\Core\Model;

    /**
     * Short AddressTypes Description
     *
     * Long AddressTypes Description
     *
     * @package            Application\App
     * @subpackage         Controllers
     */
    class AddressTypesModel extends Model
    {

        protected static $dbTable = "address_types";
        protected static $dbFields = Array();

        public static function get(int $id = null): array
        {

            try {
                if (!is_null($id)) {
                    self::$db->where("id", $id);
                }

                self::$db->where("enabled", 1);
                self::$db->orderBy("sort_order", "ASC");

                return self::$db->get(self::$dbTable);
            } catch (Exception $e) {
                return [];
            }
        }

        public static function getOne(int $id = null): array
        {
            try {
                if (!is_null($id)) {
                    self::$db->where("id", $id);
                }

                self::$db->where("enabled", 1);

                return self::$db->getOne(self::$dbTable);
            } catch (Exception $e) {
                return [];
            }
        }

        public static function update(array $params = []): array
        {
            $id = 1;

            return self::get($id);
        }

    }
