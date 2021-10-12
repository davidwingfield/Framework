<?php

    namespace Src\App\Models;

    use Exception;
    use Src\Core\Model;

    /**
     * Short Page Description
     *
     * Long Page Description
     *
     * @package            Application\App
     * @subpackage         Controllers
     */
    class PageModel extends Model
    {

        protected static $dbTable = "page";
        protected static $dbFields = Array();

        public static function get(int $id = null): array
        {

            try {
                if (!is_null($id)) {
                    self::$db->where("id", $id);
                }

                self::$db->where("enabled", 1);

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

        public static function getMenus(int $id = null): array
        {
            if (!is_null($id)) {
                self::$db->where("id", $id);
                $items = self::$db->getOne("menu");

                return $items;
            } else {
                $items = self::$db->get("menu");
            }

            foreach ($items as $value) {
                var_dump($value, 1);
            }

            exit;
        }

    }
