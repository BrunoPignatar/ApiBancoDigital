<?php
namespace BancoDigital\Controller;

use BancoDigital\Model\CorrentistaModel;
use BancoDigital\Service\Service;

class CorrentistaController extends Controller {
	
	public static function save() 
	{
		$json_obj = parent::getJSONFromRequest();

		$model = new CorrentistaModel();
		$model->id = $json_obj->Id;
		$model->nome = $json_obj->Nome;
		$model->cpf = Service::unmaskCPF($json_obj->CPF);
		$model->data_nasc = $json_obj->Data_nasc;
		$model->senha = $json_obj->Senha;
		
		$model->save();
		parent::getResponseAsJSON($model);
	}

	public static function select() 
	{

	}
		

	

	public static function delete() 
	{

	}
}