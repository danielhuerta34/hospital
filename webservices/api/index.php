<?php
ini_set('display_startup_errors', 1);
ini_set('display_errors', 1);
error_reporting(-1);
date_default_timezone_set(@date_default_timezone_get());
define('RESTpAPIABSPATH', dirname(__FILE__) . '/');
require_once RESTpAPIABSPATH . "../../vendor/autoload.php";
$dotenv = Dotenv\Dotenv::createImmutable(dirname(__DIR__, 2));
$dotenv->load();
function evalBool($value)
{
    return (strcasecmp($value, 'true') ? false : true);
}
spl_autoload_register('pdocrudRestAPIAutoLoad');
require_once RESTpAPIABSPATH . "config/config.php";
require_once RESTpAPIABSPATH . "../../config/functions.php";
require_once RESTpAPIABSPATH . "../../config/parameters.php";
function pdocrudRestAPIAutoLoad($class)
{
    if (file_exists(RESTpAPIABSPATH . "classes/" . $class . ".php"))
        require_once RESTpAPIABSPATH . "classes/" . $class . ".php";
}


/*function before_select($data, $obj)
{
    return $data;
}*/
//$settings["enableJWTAuth"] = false;
$restpAPI = new RESTpAPI();
//$restpAPI->addCallback("before_select", "before_select");
$restpAPI->render();


Redirect::to("/error/index");
die();
