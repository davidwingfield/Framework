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
        public function __construct()
        {
            echo "<br>ProviderModel</br>";
        }

        public static function get()
        {
            return self::$db->rawQuery("SELECT * FROM product");
        }

    }
