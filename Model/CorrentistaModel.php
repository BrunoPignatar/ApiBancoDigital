<?php

namespace BancoDigital\Model;

use BancoDigital\DAO\CorrentistaDAO;

class CorrentistaModel extends Model {
	public $id, $nome, $cpf, $data_nasc, $senha;

	public function save() 
	{
		$dao = new CorrentistaDAO();
		if($this->id == null)
			return $dao->insert($this);
		else
			$dao->update($this);
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