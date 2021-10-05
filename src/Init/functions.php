<?php
    /**
     * functions.php
     *
     * @return ${TYPE_HINT}
     * ${THROWS_DOC}
     */

    function dd($var = NULL)
    {
        if (!is_null($var)) {
            echo "<pre>" . var_export($var, 1) . "</pre>";
        }
        die("-- END --");
    }

    function display($var, $title = "")
    {
        echo "$title<pre>" . var_export($var, 1) . "</pre>";
    }




