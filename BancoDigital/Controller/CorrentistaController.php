<?php
namespace BancoDigital\Controller;

use BancoDigital\Model\CorrentistaModel;
use BancoDigital\Service\Service;
use Exception;

class CorrentistaController extends Controller {
	
	public static function save() 
	{
		try
        {
            //$json_obj = parent::getJSONFromRequest();
            //$json_obj = json_decode(file_get_contents('php://input'));
            $data = json_decode(file_get_contents('php://input'));

            $model = new CorrentistaModel();

            foreach (get_object_vars($data) as $key => $value) 
            {
                $prop_letra_minuscula = strtolower($key);

                $model->$prop_letra_minuscula = $value;
            }
            static $service = new Service;
            $model->cpf = $service->unmaskCPF($model->cpf);
            parent::getResponseAsJSON($model->save()); 

        
              
        } catch (Exception $e) {
            parent::LogError($e);
            parent::getExceptionAsJSON($e);
        }
	}

	public static function select() 
	{
		try
        {
            $model = new CorrentistaModel();
            
            $model->getAllRows();

            parent::getResponseAsJSON($model->rows);
              
        } catch (Exception $e) {

            parent::LogError($e);
            parent::getExceptionAsJSON($e);
        }
	}
		

	

	public static function delete() 
	{
		try 
        {
            $id = json_decode(file_get_contents('php://input'));
            
            (new CorrentistaModel())->delete( (int) $id);

        } catch (Exception $e) {

            parent::LogError($e);
            parent::getExceptionAsJSON($e);
        }
	}

	public static function login()
	{
		try
		{
			$data = json_decode(file_get_contents('php://input'));

			$model = new CorrentistaModel();

			parent::getResponseAsJSON($model->getByCpfAndSenha($data->CPF, $data->Senha)); 
		}
		catch(Exception $e)
		{
			parent::LogError($e);
			parent::getExceptionAsJSON($e);

		}
	}
}