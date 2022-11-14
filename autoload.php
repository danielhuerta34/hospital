<?php

spl_autoload_register(function ($class) {

    $sources = array("app/controllers/$class.php", "app/models/$class.php");

    foreach ($sources as $source) {
        if (file_exists($source)) {
            require_once $source;
        }
    }
});
