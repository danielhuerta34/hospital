<?php

class HomeController
{
	public $token;

	public function __construct()
	{
		@session_start();
		if (!isset($_SESSION["data"])) {
			Redirect::to("/login/index");
		}
		$this->token = Token::generateFormToken('send_message');
	}

	public function consulta()
	{
		$token = $this->token;
		$pdocrud = DB::PDOCrud();
		$pdocrud->setSkin("hover");
		$action = "javascript:;";
		$text = '<i class="btn btn-primary btn-sm fa fa-plus" aria-hidden="true"></i>';
		$attr = array("title" => "Agregar Pacientes");
		$pdocrud->enqueueBtnActions("url popup", $action, "url", $text, "id", $attr);

		$pdocrud->formFieldValue("pacientes_atendidos", "0");
		$pdocrud->fieldHideLable("pacientes_atendidos");
		$pdocrud->fieldGroups("Name1", array("nombre_especialista", "tipo_consulta"));
		$pdocrud->fieldDataAttr("pacientes_atendidos", array("style" => "display:none"));
		$pdocrud->formStaticFields("token_form", "html", "<input type='hidden' name='auth_token' value='" . $token . "' />");
		$pdocrud->setSearchCols(array("cantidad_pacientes", "pacientes_atendidos", "nombre_especialista", "tipo_consulta", "estado"));
		$pdocrud->fieldTypes("tipo_consulta", "select");
		$pdocrud->fieldDataBinding("tipo_consulta", array("Pediatría" => "Pediatría", "Urgencia" => "Urgencia", "Consulta General Integral (CGI)" => "Consulta General Integral (CGI)"), "", "", "array");

		$pdocrud->fieldTypes("estado", "select");
		$pdocrud->fieldDataBinding("estado", array("Ocupada" => "Ocupada", "En espera de atención" => "En espera de atención", "Desocupada" => "Desocupada"), "", "", "array");

		$pdocrud->relatedData('nombre_especialista', 'especialistas', 'id_especialistas', 'nombre');
		$pdocrud->setSkin(array("advance", "form-material"));
		$pdocrud->crudRemoveCol(array("id"));
		$pdocrud->buttonHide("submitBtnSaveBack");
		$pdocrud->setSettings("viewbtn", false);
		$pdocrud->setSettings("printBtn", false);
		$pdocrud->setSettings("pdfBtn", false);
		$pdocrud->setSettings("csvBtn", false);
		$pdocrud->setSettings("excelBtn", false);
		$pdocrud->bulkCrudUpdate("estado", "select", array("data-cust-attr" => "some-cust-val"), array(
			array(
				"Ocupada",
				"Ocupada"
			),
			array(
				"En espera de atención",
				"En espera de atención"
			),
			array(
				"Desocupada",
				"Desocupada"
			)
		));
		$pdocrud->addCallback("before_insert", "insertar_consulta");
		$pdocrud->addCallback("before_update", "actualizar_consulta");
		$pdocrud->addCallback("before_delete", "eliminar_consulta");
		$render = $pdocrud->dbTable("consulta")->render();
		Vista::render(
			'home',
			['render' => $render]
		);
	}

	public function paciente()
	{

		if ($_SERVER["REQUEST_METHOD"] == "POST") {
			$id = $_POST["id"];

			$token = $this->token;
			$pdocrud = DB::PDOCrud(true);
			$pdocrud->dbOrderBy(array("prioridad desc"));
			$pdocrud->fieldDisplayOrder(array("id", "nombre", "numero_historia_clinica", "edad", "relacion_peso", "estatura", "prioridad", "tiene_dieta", "fumador", "anos_de_fumador"));
			$pdocrud->colRename("relacion_peso", "Relación peso");
			$pdocrud->addCallback("format_table_data", "formatear_grilla_paciente");
			$pdocrud->addCallback("before_insert", "insertar_pacientes");
			$pdocrud->addCallback("before_update", "actualizar_pacientes");
			$pdocrud->fieldHideLable("id");
			$pdocrud->fieldGroups("Name1", array("relacion_peso", "estatura"));
			$pdocrud->fieldGroups("Name2", array("fumador", "anos_de_fumador"));
			$pdocrud->fieldRenameLable("relacion_peso", "Relación peso");
			$pdocrud->fieldCssClass("edad", array("edad_data"));
			$pdocrud->fieldCssClass("riesgo", array("riesgo_data"));
			$pdocrud->fieldDataAttr("riesgo", array("readonly" => "true"));
			$pdocrud->fieldCssClass("anos_de_fumador", array("anos_de_fumador_data"));
			$pdocrud->fieldCssClass("fumador", array("fumador_data"));
			$pdocrud->fieldCssClass("tiene_dieta", array("tiene_dieta_data"));
			$pdocrud->fieldCssClass("relacion_peso", array("relacion_peso_data"));
			$pdocrud->fieldCssClass("prioridad", array("prioridad_data"));
			$pdocrud->fieldCssClass("estatura", array("estatura_data"));
			$pdocrud->fieldDataAttr("prioridad", array("readonly" => "true"));
			$pdocrud->fieldTypes("fumador", "radio");
			$action = base_url . "/home/todos_los_pacientes"; //pk will be replaced by primary key value
			$text = '<i class="btn btn-default btn-sm fa fa-filter" aria-hidden="true"></i>';
			$attr = array("title" => "Filtros");
			$pdocrud->enqueueBtnActions("url", $action, "url", $text, "booking_status", $attr);
			$pdocrud->fieldDataBinding("fumador", array("1" => "Si", "2" => "No"), "", "", "array");
			$pdocrud->fieldTypes("tiene_dieta", "radio");
			$pdocrud->fieldDataBinding("tiene_dieta", array("1" => "Si", "2" => "No"), "", "", "array");
			$pdocrud->joinTable("panciano", "panciano.id_paciente = paciente.id_paciente", "INNER JOIN");
			$pdocrud->joinTable("pnino", "pnino.id_paciente = paciente.id_paciente", "INNER JOIN");
			$pdocrud->joinTable("pjoven", "pjoven.id_paciente = paciente.id_paciente", "INNER JOIN");
			$pdocrud->fieldDataAttr("id", array("style" => "display:none"));
			$pdocrud->setSettings("viewbtn", false);
			$pdocrud->formStaticFields("token_form", "html", "<input type='hidden' name='auth_token' value='" . $token . "' />");
			$pdocrud->setSearchCols(array("nombre", "edad", "numero_historia_clinica", "tiene_dieta", "relacion_peso", "fumador"));
			$pdocrud->crudRemoveCol(array("id_paciente", "id", "id_panciano", "id_pnino", "id_pjoven"));
			$pdocrud->where("id", $id);
			$pdocrud->formFieldValue("id", $id);
			$pdocrud->formFieldValue("prioridad", "0");
			$pdocrud->formFieldValue("riesgo", "0");
			$pdocrud->buttonHide("submitBtnSaveBack");
			$pdocrud->setSettings("printBtn", false);
			$pdocrud->setSettings("pdfBtn", false);
			$pdocrud->setSettings("csvBtn", false);
			$pdocrud->setSettings("excelBtn", false);
			$pdocrud->setLangData("no_data", "No hay Pacientes para mostrar");

			echo $pdocrud->dbTable("paciente")->render();
		}
	}

	public function obtener_pacientes_atendidos()
	{
		if ($_SERVER["REQUEST_METHOD"] == 'POST') {
			$id = $_POST["valor"];

			$consulta = new Consultas();
			$result = $consulta->ObtenerPacientesAtendidos($id);

			if ($result && $result[0]->estado == "Ocupada") {

				if ($result[0]->pacientes_atendidos >= $result[0]->cantidad_pacientes) {
					$a = ['mensaje' => 'Error'];
					echo json_encode($a);
				} else {
					$totalSuma = $result[0]->pacientes_atendidos + 1;
					$consulta->RestarPacientes($totalSuma, $id);

					$a = ['mensaje' => 'correcto'];
					echo json_encode($a);
				}
			}
		}
	}

	public function todos_los_pacientes()
	{
		$pdocrud = DB::PDOCrud();
		$pdocrud->setSettings("deleteMultipleBtn", false);
		$pdocrud->setSettings("checkboxCol", false);

		$pacientes = new Pacientes();
		$data = $pacientes->ObtenerPacientes();

		$options = array();
		foreach ($data as $record) {
			if ($record->fumador == 1) {
				$options[$record->fumador] = "Si";
			} else {
				$options[$record->fumador] = "No";
			}
		}

		$pdocrud->addFilter("Edad_filter", "Filtrar por Edad", "edad", "dropdown");
		$pdocrud->setFilterSource("Edad_filter", "paciente", "edad", "edad as pl", "db");

		$pdocrud->addFilter("Fumador_filter", "Filtrar por fumador", "fumador", "dropdown");
		$pdocrud->setFilterSource("Fumador_filter", $options, "", "", "array");
		$pdocrud->addFilter("Numero_filter", "Filtrar por Número historia clinica", "numero_historia_clinica", "dropdown");
		$pdocrud->setFilterSource("Numero_filter", "paciente", "numero_historia_clinica", "numero_historia_clinica as pl", "db");

		$pdocrud->fieldHideLable("id");
		$pdocrud->colRename("relacion_peso", "Relación peso estatura");
		$pdocrud->dbOrderBy("edad desc");
		$pdocrud->addCallback("format_table_data", "formatear_grilla_paciente");
		$pdocrud->fieldDataAttr("id", array("style" => "display:none"));
		$pdocrud->setSkin(array("advance", "form-material"));
		$pdocrud->joinTable("panciano", "panciano.id_paciente = paciente.id_paciente", "INNER JOIN");
		$pdocrud->joinTable("pnino", "pnino.id_paciente = paciente.id_paciente", "INNER JOIN");
		$pdocrud->joinTable("pjoven", "pjoven.id_paciente = paciente.id_paciente", "INNER JOIN");
		$pdocrud->setSearchCols(array("nombre", "edad", "numero_historia_clinica", "tiene_dieta", "relacion_peso", "fumador"));
		$pdocrud->crudRemoveCol(array("id_paciente", "id", "id_panciano", "id_pnino", "id_pjoven"));
		$pdocrud->buttonHide("submitBtnSaveBack");
		$pdocrud->setSettings("actionbtn", false);
		$pdocrud->setSettings("viewbtn", false);
		$pdocrud->setSettings("printBtn", false);
		$pdocrud->setSettings("addbtn", false);
		$pdocrud->setSettings("pdfBtn", false);
		$pdocrud->setSettings("csvBtn", false);
		$pdocrud->setSettings("excelBtn", false);
		$render = $pdocrud->dbTable("paciente")->render();

		Vista::render('paciente', [
			'render' => $render
		]);
	}


	public function liberar_consultas()
	{
		if ($_SERVER["REQUEST_METHOD"] == "POST") {
			$consulta = new Consultas();
			$ocupada = $consulta->ConsultarConsultas();

			if ($ocupada) {
				$consulta->ActualizarEstado();
				$a = ['mensaje' => 'correcto'];
				echo json_encode($a);
			} else {
				$a = ['mensaje' => 'incorrecto'];
				echo json_encode($a);
			}
		}
	}


	public function especialistas()
	{
		$token = $this->token;
		$pdocrud = DB::PDOCrud();
		$pdocrud->addCallback("before_insert", "insertar_especialistas");
		$pdocrud->formStaticFields("token_form", "html", "<input type='hidden' name='auth_token' value='" . $token . "' />");
		$pdocrud->setSearchCols(array("nombre"));
		$pdocrud->crudRemoveCol(array("id_especialistas"));
		$pdocrud->setSkin(array("advance", "form-material"));
		$pdocrud->formDisplayInPopup();
		$pdocrud->buttonHide("submitBtnSaveBack");
		$pdocrud->setSettings("printBtn", false);
		$pdocrud->setSettings("pdfBtn", false);
		$pdocrud->setSettings("csvBtn", false);
		$pdocrud->setSettings("excelBtn", false);
		$render = $pdocrud->dbTable("especialistas")->render();

		Vista::render('especialistas', [
			'render' => $render
		]);
	}

	public function usuarios()
	{
		$token = $this->token;
		$pdocrud = DB::PDOCrud();
		$pdocrud->setSkin("hover");
		$pdocrud->formStaticFields("token_form", "html", "<input type='hidden' name='auth_token' value='" . $token . "' />");
		$pdocrud->setSearchCols(array("nombre", "correo"));
		$pdocrud->formDisplayInPopup();
		$pdocrud->setSkin(array("advance", "form-material"));
		$pdocrud->setViewColumns(array("nombre", "correo", "avatar"));
		$pdocrud->tableColFormatting("avatar", "html", array("type" => "html", "str" => "<img src='" . base_url . "{col-name}' width='60' />"));
		$pdocrud->viewColFormatting("avatar", "html", array("type" => "html", "str" => "<img src='" . base_url . "{col-name}' width='60' />"));
		$pdocrud->crudRemoveCol(array("id_usuario", "clave"));
		$pdocrud->fieldTypes("clave", "password");
		$pdocrud->fieldTypes("avatar", "FILE_NEW");
		$pdocrud->buttonHide("submitBtnSaveBack");
		$pdocrud->addCallback("before_insert", "insertar_usuarios");
		$pdocrud->addCallback("before_update", "actualizar_usuarios");
		$pdocrud->fieldGroups("Name1", array("nombre", "correo"));
		$pdocrud->fieldGroups("Name2", array("clave", "avatar"));
		$pdocrud->fieldDataAttr("clave", array("value" => "", "placeholder" => "*******"));
		$pdocrud->setSettings("viewbtn", false);
		$pdocrud->setSettings("printBtn", false);
		$pdocrud->setSettings("pdfBtn", false);
		$pdocrud->setSettings("csvBtn", false);
		$pdocrud->setSettings("excelBtn", false);
		$render = $pdocrud->dbTable("usuarios")->render();

		Vista::render('usuarios', [
			'render' => $render
		]);
	}

	public function perfil()
	{
		if (isset($_GET['id'])) {
			$id = $_GET['id'];

			$user = new Users();
			$id_user = $user->SelectUserById($id);

			if (!$id_user) {
				Redirect::to("/error/index");
			}

			$token = $this->token;
			$pdocrud = DB::PDOCrud();
			$pdocrud->fieldCssClass("clave", array("clave"));
			$pdocrud->setSkin(array("advance", "form-material"));
			$pdocrud->fieldTypes("clave", "password");
			$pdocrud->addCallback("before_update", "actualizar_usuarios");
			$pdocrud->fieldDataAttr("clave", array("value" => "", "placeholder" => "*******"));
			$pdocrud->fieldGroups("Name1", array("nombre", "correo"));
			$pdocrud->fieldGroups("Name2", array("clave", "avatar"));
			$pdocrud->fieldTypes("avatar", "FILE_NEW");
			$pdocrud->formStaticFields("token_form", "html", "<input type='hidden' name='auth_token' value='" . $token . "' />");
			$pdocrud->setPK("id_usuario");
			$render = $pdocrud->dbTable("usuarios")->render("editform", array("id" => $id));
		}

		Vista::render(
			"profile",
			['render' => $render]
		);
	}

	public function avatar()
	{
		if ($_SERVER["REQUEST_METHOD"] == "POST") {

			$data = $_SESSION["usuarios"][0]->avatar;

			$user = new Users();
			$avatar = $user->Avatar($data);
			echo json_encode($avatar);
		}
	}
}
