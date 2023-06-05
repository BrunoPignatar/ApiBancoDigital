<?php
namespace BancoDigital\DAO;

use BancoDigital\Model\CorrentistaModel;
use \PDO;

class CorrentistaDAO extends DAO {

	public function __construct()
    {
        parent::__construct();      
    }

    public function insert(CorrentistaModel $model) 
    {
        $sql = "INSERT INTO Correntista(nome, cpf, data_nasc, senha) VALUES (?, ?, ?, ?)";

        $stmt = $this->conexao->prepare($sql);
        $stmt->bindValue(1, $model->nome);
        $stmt->bindValue(2, $model->cpf);
        $stmt->bindValue(3, $model->data_nasc);
        $stmt->bindValue(4, $model->senha);
        $stmt->execute();

        return $this->conexao->lastInsertId();
    }

    public function update(CorrentistaModel $model) 
    {
        $sql = "UPDATE Correntista SET nome = ?, cpf = ?, data_nasc = ?, senha = ? WHERE id = ?";

        $stmt = $this->conexao->prepare($sql);
        $stmt->bindValue(1, $model->nome);
        $stmt->bindValue(2, $model->cpf);
        $stmt->bindValue(3, $model->data_nasc);
        $stmt->bindValue(4, $model->senha);
        $stmt->bindValue(5, $model->id);

        return $this->conexao->lastInsertId();
    }

    public function select() 
    {
        $sql = "SELECT *,
        FROM Correntista c";
       

        $stmt = $this->conexao->prepare($sql);

        $stmt->execute();
        
        return $stmt->fetchAll(PDO::FETCH_CLASS);
    }

    public function selectById($id) 
    {
        $sql = "SELECT *,
        FROM Correntista c";
       
        $stmt = $this->conexao->prepare($sql);
        $stmt->bindValue(1, $id);    
        $stmt->execute();
        return $stmt->fetchObject();
    }

    public function delete($id) 
    {
        $sql = "DELETE FROM Correntista WHERE id = ?";
        $stmt = $this->conexao->prepare($sql);
        $stmt->bindValue(1, $id);
        $stmt->execute();
    }
}