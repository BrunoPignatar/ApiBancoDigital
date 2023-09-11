<?php

namespace BancoDigital\Model;

use BancoDigital\DAO\CorrentistaDAO;

class CorrentistaModel extends Model {
	public $id, $nome, $cpf, $data_nasc, $senha;
	public $rows_conta = array();

	public function save()
	{
		$dao = new CorrentistaDAO();

		if($this->id == null){
			$model_preenchida = new CorrentistaModel();
			$model_preenchida = $dao->insert($this);

			if($model_preenchida->id != null){

				// Criando conta corrente do correntista
				$conta_corrente = new ContaModel();
				$conta_corrente->tipo = "C";
				$conta_corrente->saldo = 0;
				$conta_corrente->limite = 100;
				$conta_corrente->id_correntista = $model_preenchida->id;
				$conta_corrente->id = $conta_corrente->save();
				$model_preenchida->rows_conta[] = $conta_corrente;

				// Criando conta poupanca do correntista
				$conta_poupanca = new ContaModel();
				$conta_poupanca->tipo = "P";
				$conta_poupanca->saldo = 0;
				$conta_poupanca->limite = 0;
				$conta_poupanca->id_correntista = $model_preenchida->id;
				$conta_poupanca->id = $conta_poupanca->save();
				$model_preenchida->rows_conta[] = $conta_poupanca;
			}

			return $model_preenchida;
		}
			
		else
			$dao->update($this);
	}

	public function getByCpfAndSenha($cpf, $senha) : CorrentistaModel
    {      
        return (new CorrentistaDAO())->selectByCpfAndSenha($cpf, $senha);
    }

	public function getAllRows() 
	{
		$dao = new CorrentistaDAO();

		$this->rows = $dao->select();
	}

	public function delete(int $id) 
	{
		$dao = new CorrentistaDAO();
		
		$dao->delete($id);
	}

	public function getById(int $id) 
	{
		$dao = new CorrentistaDAO();

		$this->rows = $dao->selectById($id);
	}

	
}