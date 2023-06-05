<?php
namespace BancoDigital\DAO;

use BancoDigital\Model\ContaModel;
use \PDO;

class ContaDAO extends DAO {

	public function __construct()
    {
        parent::__construct();      
    }

    public function insert(ContaModel $model) 
    {
        $sql = "INSERT INTO Conta(tipo, saldo, limite, id_correntista) VALUES (?, ?, ?, ?)";

        $stmt = $this->conexao->prepare($sql);
        $stmt->bindValue(1, $model->tipo);
        $stmt->bindValue(2, $model->saldo);
        $stmt->bindValue(3, $model->limite);
        $stmt->bindValue(4, $model->id_correntista);
        $stmt->execute();

        return $this->conexao->lastInsertId();
    }

    public function update(ContaModel $model) 
    {
        $sql = "UPDATE Conta SET tipo = ?, saldo = ?, limite = ?, id_correntista = ? WHERE id = ?";

        $stmt = $this->conexao->prepare($sql);
        $stmt->bindValue(1, $model->tipo);
        $stmt->bindValue(2, $model->saldo);
        $stmt->bindValue(3, $model->limite);
        $stmt->bindValue(4, $model->id_correntista);
        $stmt->bindValue(5, $model->id);

        return $this->conexao->lastInsertId();
    }

    public function select() 
    {
        $sql = "SELECT c.*,
        co.nome as nome_conta
        FROM Conta c
        JOIN Correntista co ON co.id = c.id_correntista";
       

        $stmt = $this->conexao->prepare($sql);

        $stmt->execute();
        
        return $stmt->fetchAll(PDO::FETCH_CLASS);
    }

    public function selectById($id) 
    {
        $sql = "SELECT c.*,
                co.nome as nome_conta
                FROM Conta c
                JOIN Correntista co ON co.id = c.id_correntista
                WHERE id = ?";
               
                $stmt = $this->conexao->prepare($sql);
                $stmt->bindValue(1, $id);    
                $stmt->execute();
                return $stmt->fetchObject();
    }

    public function delete($id) 
    {
        $sql = "DELETE FROM Conta WHERE id = ?";
        $stmt = $this->conexao->prepare($sql);
        $stmt->bindValue(1, $id);
        $stmt->execute();
    }
}