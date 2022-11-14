<?php
@session_start();
require('vendor/autoload.php');
$dotenv = Dotenv\Dotenv::createImmutable(__DIR__);
$dotenv->load();
require_once 'app/libs/script/pdocrud.php';
require_once 'app/libs/xinvoice/xinvoice.php';
require_once 'autoload.php';
require_once 'config/functions.php';
require_once 'config/db.php';
require_once 'config/parameters.php';
require_once 'app/classVista.php';

if (isset($_SESSION["data"]["usuarios"]["correo"])) {
	$pdocrud = DB::PDOCrud();
	$pdomodel = $pdocrud->getPDOModelObj();
	$pdomodel->fetchType = "OBJ";
	$pdomodel->where("correo", $_SESSION["data"]["usuarios"]["correo"]);
	$sesion_users = $pdomodel->select("usuarios");
	$_SESSION["usuarios"] = $sesion_users;
}

function show_error()
{
	$error = new ErrorController();
	$error->index();
}

if (isset($_GET['controller'])) {
	$nombre_controlador = $_GET['controller'] . 'Controller';
} elseif (!isset($_GET['controller']) && !isset($_GET['action'])) {
	$nombre_controlador = controller_default;
} else {
	show_error();
	exit();
}

if (class_exists($nombre_controlador)) {
	$controlador = new $nombre_controlador();

	if (isset($_GET['action']) && method_exists($controlador, $_GET['action'])) {
		$action = $_GET['action'];
		$controlador->$action();
	} elseif (!isset($_GET['controller']) && !isset($_GET['action'])) {
		$action_default = action_default;
		$controlador->$action_default();
	} else {
		show_error();
	}
} else {
	show_error();
}
