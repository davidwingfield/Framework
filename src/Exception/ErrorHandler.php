<?php
    /**
     * ErrorHandler.php
     *
     */

    namespace Src\Exception;

    use ErrorException;
    use Src\Core\Controller;
    use Src\Init\Config;
    use Src\Logger\Log;

    class ErrorHandler
    {
        public static $errno;
        public static $errstr;
        public static $errfile;
        public static $errline;
        public static $errcontext;
        public static $errorType = array(
            E_ERROR => "ERROR",
            E_WARNING => "WARNING",
            E_PARSE => "PARSING ERROR",
            E_NOTICE => "NOTICE",
            E_CORE_ERROR => "CORE ERROR",
            E_CORE_WARNING => "CORE WARNING",
            E_COMPILE_ERROR => "COMPILE ERROR",
            E_COMPILE_WARNING => "COMPILE WARNING",
            E_USER_ERROR => "USER ERROR",
            E_USER_WARNING => "USER WARNING",
            E_USER_NOTICE => "USER NOTICE",
            E_STRICT => "STRICT NOTICE",
            E_RECOVERABLE_ERROR => "RECOVERABLE ERROR",
            E_DEPRECATED => "DEPRECATED",
            E_USER_DEPRECATED => "USER DEPRECATED",
        );

        /**
         * Custom Error Handler
         *
         * @param int         $code
         * @param string      $description
         * @param string|null $file
         * @param int|null    $line
         * @param array|null  $context
         *
         * @return bool
         */
        public function handleError(int $code, string $description, string $file = null, int $line = null, array $context = null): bool
        {
            $displayErrors = ini_get("display_errors");
            $displayErrors = strtolower($displayErrors);
            $date = date("Y-m-d H:i:s");
            $eCode = self::$errorType[$code];
            $description = htmlspecialchars($description);
            ////
            if (error_reporting() === 0 || $displayErrors === "on") {
                return false;
            }
            ////
            list($error, $log, $logger) = self::mapErrorCode($code);
            ////
            $data = array(
                'date' => $date,
                'eCode' => $eCode,
                'level' => $log,
                'code' => $code,
                'error' => $error,
                'description' => $description,
                'file' => $file,
                'line' => $line,
                //'context' => $context,
                'logger' => $logger,
                'path' => $file,
                'message' => $error . ' (' . $code . '): ' . $description . ' in [' . $file . ', line ' . $line . ']',
            );

            Log::$logger($description);

            return true;
        }

        /**
         * Map an error code into an Error word, and log location.
         *
         * @param int $code Error code to map
         *
         * @return array Array of error word, and log location.
         */
        private static function mapErrorCode($code)
        {
            $error = $log = null;
            $logger = 'trace';
            switch ($code) {
                case E_PARSE:
                case E_ERROR:
                case E_CORE_ERROR:
                case E_COMPILE_ERROR:
                case E_USER_ERROR:
                    $logger = 'error';
                    $error = 'Fatal Error';
                    $log = LOG_ERR;
                    break;
                case E_WARNING:
                case E_USER_WARNING:
                case E_COMPILE_WARNING:
                case E_RECOVERABLE_ERROR:
                    $logger = 'warn';
                    $error = 'Warning';
                    $log = LOG_WARNING;
                    break;
                case E_NOTICE:
                case E_USER_NOTICE:
                    $logger = 'trace';
                    $error = 'Notice';
                    $log = LOG_NOTICE;
                    break;
                case E_STRICT:
                    $logger = 'warn';
                    $error = 'Strict';
                    $log = LOG_NOTICE;
                    break;
                case E_DEPRECATED:
                case E_USER_DEPRECATED:
                    $logger = 'info';
                    $error = 'Deprecated';
                    $log = LOG_NOTICE;
                    break;
                default :
                    break;
            }

            return array(
                $error,
                $log,
                $logger,
            );
        }

        private static function log_error($num, $str, $file, $line, $context = null)
        {
            if (Config::getDevelopmentMode()) {

            }
            //self::log_exception(new ErrorException($str, 0, $num, $file, $line));
        }

        private static function log_exception(Exception $e)
        {
            //log_exception(new ErrorException($str, 0, $num, $file, $line));
        }

    }
