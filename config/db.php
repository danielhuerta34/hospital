<?php

class DB
{
    public static function PDOCrud($multi = false, $template = "", $skin = "", $settings = array())
    {
        $settings["script_url"] = base_url . $_ENV['URL_PDOCRUD'];
        $settings["uploadURL"] = $_ENV['UPLOAD_URL'];
        $settings["downloadURL"] = base_url . $_ENV['DOWNLOAD_URL'];
        $settings["hostname"] = $_ENV['DB_HOST'];
        $settings["database"] = $_ENV['DB_NAME'];
        $settings["username"] = $_ENV['DB_USER'];
        $settings["password"] = $_ENV['DB_PASS'];
        $settings["dbtype"] = $_ENV['DB_TYPE'];
        $settings["characterset"] = $_ENV["CHARACTER_SET"];

        $pdocrud = new PDOCrud($multi, $template, $skin, $settings);
        return $pdocrud;
    }

    public static function PDOModel()
    {
        $pdomodel = new PDOModel();
        $pdomodel->connect($_ENV["DB_HOST"], $_ENV["DB_USER"], $_ENV["DB_PASS"], $_ENV["DB_NAME"]);
        $pdomodel->fetchType = "OBJ";
        return $pdomodel;
    }
}
