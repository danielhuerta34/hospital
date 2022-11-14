<?php
@session_start();
/*enable this for development purpose */
ini_set('display_startup_errors', 0);
ini_set('display_errors', 0);
error_reporting(0);
date_default_timezone_set(@date_default_timezone_get());
define('PDOCrudABSPATH', dirname(__FILE__) . '/');
require_once PDOCrudABSPATH . "../../../vendor/autoload.php";
$dotenv = Dotenv\Dotenv::createImmutable(dirname(__DIR__, 3));
$dotenv->load();
function evalBool($value)
{
    return (strcasecmp($value, 'true') ? false : true);
}
require_once PDOCrudABSPATH . "config/config.php";
require_once PDOCrudABSPATH . '../../../config/functions.php';
require_once PDOCrudABSPATH . '../../../config/parameters.php';
spl_autoload_register('pdocrudAutoLoad');

function pdocrudAutoLoad($class)
{
    if (file_exists(PDOCrudABSPATH . "classes/" . $class . ".php"))
        require_once PDOCrudABSPATH . "classes/" . $class . ".php";
}

if (isset($_REQUEST["pdocrud_instance"])) {
    $fomplusajax = new PDOCrudAjaxCtrl();
    $fomplusajax->handleRequest();
}

function formatear_grilla_paciente($data, $obj)
{
    if ($data) {
        for ($i = 0; $i < count($data); $i++) {
            if ($data[$i]["tiene_dieta"] == 1) {
                $data[$i]["tiene_dieta"] = "No";
            } else {
                $data[$i]["tiene_dieta"] = "Si";
            }

            if ($data[$i]["fumador"] == 2) {
                $data[$i]["fumador"] = "No";
            } else {
                $data[$i]["fumador"] = "Si";
            }
        }
    }
    return $data;
}


function insertar_pacientes($data, $obj)
{
    $token = $_POST['auth_token'];
    $valid = Token::verifyFormToken('send_message', $token);
    if (!$valid) {
        echo "El token recibido no es válido";
        die();
    }

    $newdata = array();
    $newdata["paciente"]["id"] = $data["paciente"]["id"];
    $newdata["paciente"]["nombre"] = $data["paciente"]["nombre"];
    $newdata["paciente"]["edad"] = $data["paciente"]["edad"];
    $newdata["paciente"]["prioridad"] = $data["paciente"]["prioridad"];
    $newdata["paciente"]["riesgo"] = $data["paciente"]["riesgo"];
    $newdata["paciente"]["numero_historia_clinica"] = $data["paciente"]["numero_historia_clinica"];

    $newdata["panciano"]["tiene_dieta"] = $data["panciano"]["tiene_dieta"];
    $newdata["pnino"]["relacion_peso"] = $data["pnino"]["relacion_peso"];
    $newdata["pnino"]["estatura"] = $data["pnino"]["estatura"];
    $newdata["pjoven"]["fumador"] = $data["pjoven"]["fumador"];
    $newdata["pjoven"]["anos_de_fumador"] = $data["pjoven"]["anos_de_fumador"];

    $obj->setLangData("success", "Paciente guardado con éxito");

    return $newdata;
}

function actualizar_pacientes($data, $obj)
{
    $token = $_POST['auth_token'];
    $valid = Token::verifyFormToken('send_message', $token);
    if (!$valid) {
        echo "El token recibido no es válido";
        die();
    }

    $newdata = array();
    $newdata["paciente"]["id"] = $data["paciente"]["id"];
    $newdata["paciente"]["nombre"] = $data["paciente"]["nombre"];
    $newdata["paciente"]["edad"] = $data["paciente"]["edad"];
    $newdata["paciente"]["prioridad"] = $data["paciente"]["prioridad"];
    $newdata["paciente"]["riesgo"] = $data["paciente"]["riesgo"];
    $newdata["paciente"]["numero_historia_clinica"] = $data["paciente"]["numero_historia_clinica"];

    $newdata["panciano"]["tiene_dieta"] = $data["panciano"]["tiene_dieta"];
    $newdata["pnino"]["relacion_peso"] = $data["pnino"]["relacion_peso"];
    $newdata["pnino"]["estatura"] = $data["pnino"]["estatura"];
    $newdata["pjoven"]["fumador"] = $data["pjoven"]["fumador"];
    $newdata["pjoven"]["anos_de_fumador"] = $data["pjoven"]["anos_de_fumador"];

    $obj->setLangData("success", "Paciente Actualizado con éxito");

    return $newdata;
}

function insertar_especialistas($data, $obj)
{
    $token = $_POST['auth_token'];
    $valid = Token::verifyFormToken('send_message', $token);
    if (!$valid) {
        echo "El token recibido no es válido";
        die();
    }

    $newdata = array();
    $newdata["especialistas"]["nombre"] = $data["especialistas"]["nombre"];

    $obj->setLangData("success", "Especialista guardado con éxito");
    return $newdata;
}


function eliminar_consulta($data, $obj)
{
    $id = $data["id"];

    $pdomodel = $obj->getPDOModelObj();
    $pdomodel->where("id", $id);
    $result = $pdomodel->select("consulta");

    if ($result) {
        $pdomodel->where("id", $result[0]["id"]);
        $pdomodel->delete("paciente");
    }
    return $data;
}


function insertar_consulta($data, $obj)
{
    $token = $_POST['auth_token'];
    $valid = Token::verifyFormToken('send_message', $token);
    if (!$valid) {
        echo "El token recibido no es válido";
        die();
    }

    $newdata = array();
    $newdata["consulta"]["cantidad_pacientes"] = $data["consulta"]["cantidad_pacientes"];
    $newdata["consulta"]["pacientes_atendidos"] = $data["consulta"]["pacientes_atendidos"];
    $newdata["consulta"]["nombre_especialista"] = $data["consulta"]["nombre_especialista"];
    $newdata["consulta"]["tipo_consulta"] = $data["consulta"]["tipo_consulta"];
    $newdata["consulta"]["estado"] = $data["consulta"]["estado"];

    $obj->setLangData("success", "Consulta guardada con éxito");

    return $newdata;
}

function actualizar_consulta($data, $obj)
{
    $token = $_POST['auth_token'];
    $valid = Token::verifyFormToken('send_message', $token);
    if (!$valid) {
        echo "El token recibido no es válido";
        die();
    }

    $newdata = array();
    $newdata["consulta"]["cantidad_pacientes"] = $data["consulta"]["cantidad_pacientes"];
    $newdata["consulta"]["pacientes_atendidos"] = $data["consulta"]["pacientes_atendidos"];
    $newdata["consulta"]["nombre_especialista"] = $data["consulta"]["nombre_especialista"];
    $newdata["consulta"]["tipo_consulta"] = $data["consulta"]["tipo_consulta"];
    $newdata["consulta"]["estado"] = $data["consulta"]["estado"];
    return $newdata;
}


function insertar_usuarios($data, $obj)
{
    $token = $_POST['auth_token'];
    $valid = Token::verifyFormToken('send_message', $token);
    if (!$valid) {
        echo "El token recibido no es válido";
        die();
    }

    $newdata = array();
    $newdata["usuarios"]["nombre"] = $data["usuarios"]["nombre"];
    $newdata["usuarios"]["correo"] = $data["usuarios"]["correo"];
    $newdata["usuarios"]["clave"] = password_hash($data["usuarios"]["clave"], PASSWORD_DEFAULT);
    $newdata["usuarios"]["avatar"] = $data["usuarios"]["avatar"];

    $obj->setLangData("success", "Usuario guardado con éxito");

    return $newdata;
}

function actualizar_usuarios($data, $obj)
{
    $token = $_POST['auth_token'];
    $valid = Token::verifyFormToken('send_message', $token);
    if (!$valid) {
        echo "El token recibido no es válido";
        die();
    }

    $newdata = array();
    $newdata["usuarios"]["nombre"] = $data["usuarios"]["nombre"];
    $newdata["usuarios"]["correo"] = $data["usuarios"]["correo"];
    $newdata["usuarios"]["clave"] = password_hash($data["usuarios"]["clave"], PASSWORD_DEFAULT);
    $newdata["usuarios"]["avatar"] = $data["usuarios"]["avatar"];

    return $newdata;
}

function beforeloginCallback($data, $obj)
{
    $token = $_POST['auth_token'];
    $valid = Token::verifyFormToken('send_message', $token);
    if (!$valid) {
        echo "El token recibido no es válido";
        die();
    }

    $pass = htmlspecialchars($data['usuarios']['clave']);
    $email = htmlspecialchars($data['usuarios']['correo']);

    $pdomodel = $obj->getPDOModelObj();
    $pdomodel->where("correo", $email);
    $hash = $pdomodel->select("usuarios");

    if (password_verify($pass, $hash[0]['clave'])) {
        @session_start();
        $_SESSION["data"] = $data;
        $obj->setLangData("no_data", "Bienvenido");
        $obj->formRedirection(base_url . "/home/consulta");
    } else {
        echo "El correo o la contraseña ingresada no coinciden";
        die();
    }

    $newdata = array();
    $newdata["usuarios"]["clave"] = $data["usuarios"]["clave"];
    $newdata["usuarios"]["correo"] = $data["usuarios"]["correo"];

    return $newdata;
}


function resetloginCallback($data, $obj)
{

    $token = $_POST['auth_token'];
    $valid = Token::verifyFormToken('send_message', $token);
    if (!$valid) {
        echo "El token recibido no es válido";
        die();
    }

    $email = htmlspecialchars($data['usuarios']['correo']);
    $pdomodel = $obj->getPDOModelObj();
    $pdomodel->where("correo", $email);
    $hash = $pdomodel->select("usuarios");

    if ($hash) {
        $pass = $pdomodel->getRandomPassword(15, true);
        $encrypt = password_hash($pass, PASSWORD_DEFAULT);

        $pdomodel->where("id_usuario", $hash[0]["id_usuario"]);
        $pdomodel->update("usuarios", array("password" => $encrypt));

        $emailBody = "Correo enviado  tu nueva contraseña es: $pass";
        $subject = "prueba de email";
        $to = $email;
        Mailer::send($to, $subject, $emailBody, $cc = array(), true);
        $obj->setLangData("success", "Correo enviado con éxito");
        die();
    }

    return $data;
}
