<?php
namespace BancoDigital\Controller;
use Exception;
use BancoDigital\Model\TransacaoModel;

class TransacaoController extends Controller {
	public static function save() : void
	{
		try
        {
            $json_obj = json_decode(file_get_contents('php://input'));

            $model = new TransacaoModel();
            $model->id = $json_obj->Id;
            $model->valor = $json_obj->Valor;
            $model->data_transacao = $json_obj->Data_transacao;
			$model->id_conta_enviou = $json_obj->Id_conta_enviou;
			$model->id_conta_recebeu = $json_obj->Id_conta_recebeu;

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
            $model = new TransacaoModel();
            
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
            
            (new TransacaoModel())->delete( (int) $id);

        } catch (Exception $e) {

            parent::LogError($e);
            parent::getExceptionAsJSON($e);
        }
	}

	public static function search()
	{
		try
        {
            $model = new TransacaoModel();
            
            $busca = json_decode(file_get_contents('php://input'));
            
            //fwrite(fopen("dados.json", "w"), file_get_contents('php://input'));
            
            $model->getAllRows($busca);

            parent::getResponseAsJSON($model->rows);
              
        } catch (Exception $e) {

            parent::LogError($e);
            parent::getExceptionAsJSON($e);
        }
	}

    public static function enviarPix()
	{

	}

	public static function receberPix()
	{
		
	}
}