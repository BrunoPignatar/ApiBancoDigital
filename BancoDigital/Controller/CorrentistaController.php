<?php
namespace BancoDigital\Controller;

use BancoDigital\Model\CorrentistaModel;

class CorrentistaController extends Controller {
	public static function save() 
	{
		$json_obj = parent::getJSONFromRequest();

		$model = new CorrentistaModel();
		$model->id = $json_obj->id;
		$model->cpf = $json_obj->cpf;
		$model->data_nasc = $json_obj->data_nasc;
		$model->senha = $json_obj->senha;
		
		$model->save();
	}

	public static function select() 
	{

	}

	public static function update() 
	{

	}

	public static function delete() 
	{

	}

	public static function auth() 
	{

	}
}