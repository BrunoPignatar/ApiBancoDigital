<?php
namespace BancoDigital\Controller;
use Exception;
use BancoDigital\Model\ChavePixModel;

class ChavePixController extends Controller {
	public static function save() : void
	{
		try
        {
            $json_obj = json_decode(file_get_contents('php://input'));

            $model = new ChavePixModel();
            $model->id = $json_obj->Id;
            $model->tipo = $json_obj->Tipo;
            $model->chave = $json_obj->Chave;
			$model->id_conta = $json_obj->Id_conta;

            parent::getResponseAsJSON($model->save());
              
        } catch (Exception $e) {

            parent::LogError($e);
            parent::getExceptionAsJSON($e);
        }
	}

	public static function select() : void
	{
		try
        {
            $model = new ChavePixModel();
            
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

	public static function delete() : void
	{
		try 
        {
            $id = json_decode(file_get_contents('php://input'));
            
            (new ChavePixModel())->delete( (int) $id);

        } catch (Exception $e) {

            parent::LogError($e);
            parent::getExceptionAsJSON($e);
        }
	}

	public static function search()
	{
		try
        {
            $model = new ChavePixModel();
            
            $busca = json_decode(file_get_contents('php://input'));
            
            //fwrite(fopen("dados.json", "w"), file_get_contents('php://input'));
            
            $model->getAllRows($busca);

            parent::getResponseAsJSON($model->rows);
              
        } catch (Exception $e) {

            parent::LogError($e);
            parent::getExceptionAsJSON($e);
        }
	}
}