<?php

class LoginController
{
	public $token;

	public function __construct()
	{
		@session_start();
		if (isset($_SESSION["data"])) {
			Redirect::to("/home/index");
		}
		$this->token = Token::generateFormToken('send_message');
	}

	public function index()
	{
		$token = $this->token;
		$pdocrud = DB::PDOCrud(false, "pure", "pure");
		$pdocrud->formStaticFields("token_form", "html", "<input type='hidden' name='auth_token' value='" . $token . "' />");
		$pdocrud->fieldDisplayOrder(array("correo", "clave"));
		$pdocrud->fieldRenameLable("correo", "Correo");
		$pdocrud->fieldRenameLable("clave", "Contraseña");
		$pdocrud->fieldAddOnInfo("correo", "before", '<span class="input-group-addon" id="basic-addon1"><i class="fa fa-envelope-o"></i></span>');
		$pdocrud->fieldAddOnInfo("clave", "before", '<span class="input-group-addon" id="basic-addon1"><i class="fa fa-key"></i></span>');
		$pdocrud->addCallback("before_select", "beforeloginCallback");
		$pdocrud->formFields(array("correo", "clave"));
		$pdocrud->fieldTypes("clave", "password");
		//$pdocrud->recaptcha($_ENV["SITE_KEY"], $_ENV["SITE_SECRET"]);
		$login = $pdocrud->dbTable("usuarios")->render("selectform");

		return Vista::render(
			"login",
			['login' => $login]
		);
	}


	public function logout()
	{
		@session_start();
		@session_destroy();
		Redirect::to("/login/index");
	}

	public function reset()
	{
		$token = $this->token;
		$pdocrud = DB::PDOCrud(false, "pure", "pure");
		$pdocrud->formStaticFields("token_form", "html", "<input type='hidden' name='auth_token' value='" . $token . "' />");
		$pdocrud->fieldRenameLable("correo", "Correo");
		$pdocrud->fieldAddOnInfo("correo", "before", '<span class="input-group-addon" id="basic-addon1"><i class="fa fa-envelope-o"></i></span>');
		$pdocrud->addCallback("before_select", "resetloginCallback");
		$pdocrud->formFields(array("correo"));
		$pdocrud->setLangData("login", "Recuperar Contraseña");
		$reset = $pdocrud->dbTable("usuarios")->render("selectform");

		return Vista::render(
			"reset",
			['reset' => $reset]
		);
	}
}
