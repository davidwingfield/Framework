<?php

    namespace Src\Init;

    use Src\Init\AppIni;

    class Config
    {

        protected static $DBNAME;
        protected static $DBHOST;
        protected static $DBUSER;
        protected static $DBPORT;
        protected static $SHOW_ERRORS;
        protected static $DBPASS;
        protected static $EXPIRETIME;

        /**
         * Show or hide error messages on screen
         *
         * @var boolean
         */
        //protected static $SHOW_ERRORS = TRUE;

        //protected static $EXPIRE_TIME = EXPIRETIME;

        public static function init(array $ini = [])
        {
            self::setDBName($ini["db_name"]);
            self::setDBHost($ini["db_host"]);
            self::setDBUser($ini["db_user"]);
            self::setDBPassword($ini["db_pass"]);
        }

        public static function getDBName()
        {
            return self::$DBNAME;
        }

        public static function getDBHost()
        {
            return self::$DBHOST;
        }

        public static function getDBUser()
        {
            return self::$DBUSER;
        }

        public static function getDBPass()
        {
            return self::$DBPASS;
        }

        private static function setDBName($DBNAME = NULL)
        {
            if (!is_null($DBNAME)) {
                self::$DBNAME = $DBNAME;

            }
        }

        private static function setDBHost($DBHOST = NULL)
        {
            if (!is_null($DBHOST)) {
                self::$DBHOST = $DBHOST;
            }
        }

        private static function setDBUser($DBUSER = NULL)
        {
            if (!is_null($DBUSER)) {
                self::$DBUSER = $DBUSER;
            }
        }

        private static function setDBPassword($DBPASS = NULL)
        {
            if (!is_null($DBPASS)) {
                self::$DBPASS = $DBPASS;
            }
        }

        private static function setDBPort($DBPORT = NULL)
        {
            if (!is_null($DBPORT)) {
                self::$DBPORT = $DBPORT;
            }
        }

    }
