<?php

class Users extends PDOModel
{
	public function SelectUserById($id)
	{
		$pdomodel = DB::PDOModel();
		$pdomodel->where("id_usuario", $id);
		$query = $pdomodel->select("usuarios");
		return $query;
	}

	public function Avatar($avatar)
	{
		$pdomodel = DB::PDOModel();
		$pdomodel->where("avatar", $avatar);
		$avatar = $pdomodel->select("usuarios");
		return $avatar;
	}
}
