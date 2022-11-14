<?php

class Pacientes extends PDOModel
{

    function __construct()
    {
    }

    public function ObtenerPacientes()
    {
        $pdomodel = DB::PDOModel();
        $pdomodel->joinTables("panciano", "panciano.id_paciente = paciente.id_paciente", "INNER JOIN");
        $pdomodel->joinTables("pnino", "pnino.id_paciente = paciente.id_paciente", "INNER JOIN");
        $pdomodel->joinTables("pjoven", "pjoven.id_paciente = paciente.id_paciente", "INNER JOIN");
        $data =  $pdomodel->select("paciente");
        return $data;
    }
}
