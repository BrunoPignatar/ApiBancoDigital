<?php

namespace BancoDigital\Model;

use BancoDigital\DAO\ChavePixDAO;
use Exception;

class ChavePixModel extends Model {
	public $id, $tipo, $chave, $id_conta;

	public function save() 
	{
		$dao = new ChavePixDAO();
		if($this->id == null)
		    $dao->insert($this);
		else
		    $dao->update($this);
	}

	public function getAllRows() 
	{
		$dao = new ChavePixDAO();

		$this->rows = $dao->select();	
	}


	public function delete(int $id) 
	{
		$dao = new ChavePixDAO();
		
		$dao->delete($id);
	}

	public function getById(int $id) 
	{
        $dao = new ChavePixDAO();

		$this->rows = $dao->selectById($id);
	}
}