<?php
namespace BancoDigital\Controller;

use BancoDigital\Model\ContaModel;
use Exception;

class ContaController extends Controller {
	public static function save() : void
	{
		try
		{
			$json_obj = json_decode(file_get_contents('php://input'));

			$model = new ContaModel();

			$model->id = $json_obj->Id;
			$model->tipo = $json_obj->Tipo;
			$model->saldo = $json_obj->Saldo;
			$model->limite = $json_obj->Limite;
			$model->id_correntista = $json_obj->Id_correntista;

			parent::GetResponseAsJSON($model->save());
		}catch(Exception $e)
		{
			parent::LogError($e);
			parent::GetResponseAsJSON($e);
		}
	}

	public static function select() 
	{
		try
        {
            $model = new ContaModel();
            
            $model->getAllRows();

            parent::getResponseAsJSON($model->rows);
              
        } catch (Exception $e) {

            parent::LogError($e);
            parent::getExceptionAsJSON($e);
        }
	}

	public static function update() 
	{

	}

	public static function extrato() 
	{

	}

	public static function enviarPix()
	{

	}

	public static function receberPix()
	{
		
	}

	public static function delete() 
	{
		try 
        {
            $id = json_decode(file_get_contents('php://input'));
            
            (new ContaModel())->delete( (int) $id);

        } catch (Exception $e) {

            parent::LogError($e);
            parent::getExceptionAsJSON($e);
        }
	}

	public static function search()
	{
		try
        {
            $model = new ContaModel();
            
            $busca = json_decode(file_get_contents('php://input'));
            
            
            $model->getAllRows($busca);

            parent::getResponseAsJSON($model->rows);
              
        } catch (Exception $e) {

            parent::LogError($e);
            parent::getExceptionAsJSON($e);
        }
	}
}