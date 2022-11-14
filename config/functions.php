<?php
class Redirect
{
	public static function to($url)
	{
		header("Location: " . base_url . $url);
		return $url;
	}
}

class Mailer
{
	public static function send($to, $subject, $emailBody, $cc = array())
	{
		PDOModel::$mail_host = $_ENV["MAIL_HOST"];
		PDOModel::$mail_port = $_ENV["MAIL_PORT"];
		PDOModel::$smtp_auth = evalBool($_ENV["SMTP_AUTH"]);
		PDOModel::$username = $_ENV["MAIL_USERNAME"];
		PDOModel::$password = $_ENV["MAIL_PASSWORD"];
		PDOModel::$emailfrom = $_ENV["EMAIL_FROM"];
		PDOModel::$smtpsecure = $_ENV["SMTP_SECURE"];

		$send = new PDOModel();
		$send->send_email_public($to, $subject, $emailBody, $cc = array(), true);
		return $send;
	}
}

$CONF['csrf_secret'] = $_ENV["CSRF_SECRET"];

class Token
{
	public static function generateFormToken($form)
	{
		$secret = $GLOBALS['CONF']['csrf_secret'];
		$sid = session_id();
		$token = password_hash($secret . $sid . $form, PASSWORD_DEFAULT);
		return $token;
	}

	public static function verifyFormToken($form, $token)
	{
		$secret = $GLOBALS['CONF']['csrf_secret'];
		$sid = session_id();
		if (password_verify($secret . $sid . $form, $token)) {
			return $token;
		}
	}
}

class Ruta
{
	public static function Url()
	{
		$url = $_GET['controller'] . '/' . $_GET['action'];
		return $url;
	}
}
