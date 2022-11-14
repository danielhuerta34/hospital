<?php

class ApiController
{
    public $token;
    public $json;

    public function __construct()
    {
        $this->json = file_get_contents('php://input');
        $this->token = trim(ltrim($_SERVER["HTTP_AUTHORIZATION"], "Bearer"));
    }

    public function generarToken()
    {
        $json = $this->json;
        $content = json_decode($json);

        if (isset($content)) {
            $email = $content->email;
            $password = $content->password;

            $data = array(
                "data" =>
                array(
                    "email" => $email,
                    "password" => $password,
                )
            );
            $data = json_encode($data);
            $ch = curl_init();
            curl_setopt($ch, CURLOPT_URL, webservices . "/api/users/?op=jwtauth");
            curl_setopt($ch, CURLOPT_HTTPHEADER, array('Content-Type:application/json'));
            curl_setopt($ch, CURLOPT_POSTFIELDS, $data);
            curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
            $result = curl_exec($ch);
            $data = json_decode($result, true);

            if ($data) {
                return $data["data"];
            }
        }
    }


    /*public function Token()
    {

        if (isset($_GET["email"]) && isset($_GET["password"])) {

            $email = $_GET["email"];
            $password = $_GET["password"];

            $data = array(
                "data" =>
                array(
                    "email" => $email,
                    "password" => $password,
                )
            );
            $data = json_encode($data);
            $ch = curl_init();
            curl_setopt($ch, CURLOPT_URL, base_url . "/webservices/api/users/?op=jwtauth");
            curl_setopt($ch, CURLOPT_HTTPHEADER, array('Content-Type:application/json'));
            curl_setopt($ch, CURLOPT_POSTFIELDS, $data);
            curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
            $result = curl_exec($ch);
            $data = json_decode($result, true);

            $a = ['token' => $data['data']];
            echo json_encode($a);
        }
    }*/


    public function login()
    {
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $json = $this->json;
            $content = json_decode($json);

            if (isset($content)) {
                $email = $content->email;
                //$password = $content->password;

                $token_result = $this->generarToken();

                $ch = curl_init();
                $headers = array(
                    "Content-Type: application/json",
                    "Authorization: Bearer " . $token_result,
                );
                curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
                curl_setopt($ch, CURLOPT_URL, webservices . "/api/users/email/$email");
                curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
                $result = curl_exec($ch);
                $data = json_decode($result, true);

                if ($data['data'] && $data['message'] != "No tienes permiso para acceder a este recurso.") {
                    $a = ['resultado' => $data['data'], 'token' => $token_result];
                    echo json_encode($a);
                } else {
                    $a = ['Error' => $data['message']];
                    echo json_encode($a);
                }
            }
        } else {
            Redirect::to("/error/index");
        }
    }

    public function listar()
    {
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            //$token_result = $this->token; /* conactado a traves de la app externa*/
            $token_result = $this->generarToken(); /* conectado a traves del mismo php */

            $ch = curl_init();
            curl_setopt($ch, CURLOPT_URL, webservices . '/api/users');
            curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
            $headers = array(
                "Content-Type: application/json",
                "Authorization: Bearer " . $token_result,
            );
            curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
            $result = curl_exec($ch);
            $data = json_decode($result, true);
            if ($data['data']) {
                $a = ['resultado' => $data['data']];
                echo json_encode($a);
            } else {
                $a = ['error' => $data['message']];
                echo json_encode($a);
            }
        } else {
            Redirect::to("/error/index");
        }
    }
}
