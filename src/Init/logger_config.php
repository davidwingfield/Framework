<?php
    /**
     * logger_config.php
     *
     * @return ${TYPE_HINT}
     * ${THROWS_DOC}
     */

    if (isset($_SERVER["REMOTE_ADDR"])) {
        LoggerMDC::put("ip", $_SERVER["REMOTE_ADDR"]);
    }

    Logger::configure(array(
        //////
        "rootLogger" => array(
            "appenders" => array("default"),
        ),
        //////
        "loggers" => array(
            //////
            "MAIN" => array(
                "level" => "warn",
                "appenders" => array("default"),
            ),
            //////
            "ACCESS" => array(
                "level" => "trace",
                "appenders" => array("access"),
            ),
            //////
            "DEBUG" => array(
                "level" => "trace",
                "appenders" => array("debug"),
            ),
            //////
            "IMAGE" => array(
                "level" => "warn",
                "appenders" => array("image"),
            ),
            //////
            "BATCH" => array(
                "level" => "warn",
                "appenders" => array("batch"),
            ),
            //////
        ),
        //////
        "appenders" => array(
            //////
            "debug" => array(
                "class" => "LoggerAppenderRollingFile",
                "layout" => array(
                    "class" => "LoggerLayoutPattern",
                    "params" => array(
                        "conversionPattern" => "%d{m/d/Y H:i:s.u} [%method:%pid] [%p] [IP:%X{ip}] [%F:%L] %m%n",
                    ),
                ),
                "params" => array(
                    "file" => $_SERVER["DOCUMENT_ROOT"] . "/var/logs/debug.log",
                    "maxBackupIndex" => 3,
                    "maxFileSize" => "2MB",
                    "compress" => TRUE,
                ),
            ),
            //////
            "access" => array(
                "class" => "LoggerAppenderRollingFile",
                "layout" => array(
                    "class" => "LoggerLayoutPattern",
                    "params" => array(
                        "conversionPattern" => "%d{m/d/Y H:i:s.u} [%method:%pid] [%p] [IP:%X{ip}] [%F:%L] %m%n",
                    ),
                ),
                "params" => array(
                    "file" => $_SERVER["DOCUMENT_ROOT"] . "/var/logs/access.log",
                    "maxBackupIndex" => 3,
                    "maxFileSize" => "2MB",
                    "compress" => TRUE,
                ),
            ),
            //////
            "image" => array(
                "class" => 'LoggerAppenderFile',
                "layout" => array(
                    "class" => "LoggerLayoutPattern",
                    "params" => array(
                        "conversionPattern" => "%d{m/d/Y H:i:s.u} %-5p [%c] %m [%F:%L][IP:%X{ip}]%n",
                    ),
                ),
                "params" => array(
                    "file" => $_SERVER["DOCUMENT_ROOT"] . "/var/logs/image.log",
                    "append" => TRUE,
                ),
            ),
            //////
            "batch" => array(
                "class" => 'LoggerAppenderFile',
                "layout" => array(
                    "class" => "LoggerLayoutPattern",
                    "params" => array(
                        "conversionPattern" => "%d{m/d/Y H:i:s.u} [%-5p] [%F:%L] [%method] %m%n",
                    ),
                ),
                "params" => array(
                    "file" => $_SERVER["DOCUMENT_ROOT"] . "/var/logs/batch.log",
                    "append" => TRUE,
                ),
            ),
            //////
            "default" => array(
                "class" => "LoggerAppenderRollingFile",
                "layout" => array(
                    "class" => "LoggerLayoutPattern",
                    "params" => array(
                        "conversionPattern" => "%d{m/d/Y H:i:s.u} [%c] %m [%F:%L][IP:%X{ip}]%n",
                    ),
                ),
                "params" => array(
                    "file" => $_SERVER["DOCUMENT_ROOT"] . "/var/logs/event.log",
                    "maxBackupIndex" => 3,
                    "maxFileSize" => "2MB",
                    "compress" => TRUE,
                ),
            ),
            //////
        ),
    ));

    $MAIN_API_FILE_LOGGER = NULL;

    $MAIN_API_FILE_LOGGER = Logger::getLogger("MAIN");
    $ACCESS_LOGGER = Logger::getLogger("ACCESS");
    $DEBUG_LOGGER = Logger::getLogger("DEBUG");
    $IMAGE_LOGGER = Logger::getLogger("IMAGE");
    $BATCH_LOGGER = Logger::getLogger("BATCH");
    /*
    $MAIN_API_FILE_LOGGER->warn("Access");
    $DEBUG_LOGGER->warn("Access");
    $IMAGE_LOGGER->warn("Access");
    $BATCH_LOGGER->warn("Access");
    $ACCESS_LOGGER->warn("Access");
    //*/
