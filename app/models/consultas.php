<?php

class Consultas extends PDOModel
{
    function __construct()
    {
    }

    public function ConsultarConsultas()
    {
        $pdomodel = DB::PDOModel();
        $pdomodel->where("estado", "Ocupada");
        $query = $pdomodel->select("consulta");
        return $query;
    }

    public function ActualizarEstado()
    {
        $pdomodel = DB::PDOModel();
        $pdomodel->where("estado", "Ocupada");
        $pdomodel->update("consulta", array("estado" => "Desocupada"));
        return $pdomodel;
    }

    public function ObtenerPacientesAtendidos($id)
    {
        $pdomodel = DB::PDOModel();
        $pdomodel->where("id", $id);
        $query = $pdomodel->select("consulta");
        return $query;
    }

    public function RestarPacientes($suma, $id)
    {
        $pdomodel = DB::PDOModel();
        $pdomodel->where("id", $id);
        $pdomodel->update("consulta", array("pacientes_atendidos" => $suma));
        return $pdomodel;
    }
}
