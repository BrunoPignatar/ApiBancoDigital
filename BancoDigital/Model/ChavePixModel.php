<?php

namespace BancoDigital\Model;

use BancoDigital\DAO\ChavePixDAO;
use Exception;

class ChavePixModel extends Model {
	public $id, $tipo, $chave, $id_conta;

	public function save() 
	{
		if($this->id == null)
		return (new ChavePixDAO())->insert($this);
	else
		return (new ChavePixDAO())->update($this);
	}

	public function getAllRows(string $query = null) 
	{
		$dao = new ChavePixDAO();

        $this->rows = ($query == null) ? $dao->select() : $dao->search($query);
	}

	public function delete(int $id) 
	{
		(new ChavePixDAO())->delete($id);
	}

	public function getById(int $id) 
	{
        $dao = new ChavePixDAO();

		$this->rows = $dao->selectById($id);
	}
}