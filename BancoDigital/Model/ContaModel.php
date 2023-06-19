<?php

namespace BancoDigital\Model;

use BancoDigital\DAO\ContaDAO;

class ContaModel extends Model {
	public $id, $tipo, $saldo, $limite, $id_correntista;

	public function save() 
	{
		$dao = new ContaDAO();
		if($this->id == null)
			$dao->insert($this);
		else
			$dao->update($this);
	}

	public function getAllRows() 
	{
		$dao = new ContaDAO();

		$this->rows = $dao->select();
	}

	public function delete(int $id) 
	{
		$dao = new ContaDAO();
		
		$dao->delete($id);
	}

	public function getById(int $id) 
	{
		$dao = new ContaDAO();

		$this->rows = $dao->selectById($id);
	}
}