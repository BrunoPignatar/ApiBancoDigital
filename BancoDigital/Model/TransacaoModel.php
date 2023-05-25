<?php

namespace BancoDigital\Model;

use BancoDigital\DAO\TransacaoDAO;

class TransacaoModel extends Model {
	public $id, $valor, $data_transacao, $id_conta_enviou, $id_conta_recebeu;

	public function save() 
	{
		$dao = new TransacaoDAO();
		if($this->id == null)
			$dao->insert($this);
		else
			$dao->update($this);
	}

	public function getAllRows() 
	{
		$dao = new TransacaoDAO();

		$this->rows = $dao->select();
	}

	public function delete(int $id) 
	{
		$dao = new TransacaoDAO();

		$dao->delete($id);
	}

	public function getById(int $id) 
	{
		$dao = new TransacaoDAO();

		$this->rows = $dao->selectById($id);
	}
}