<?php

namespace BancoDigital\DAO;

use BancoDigital\Model\TransacaoModel;
use \PDO;

class TransacaoDAO extends DAO {

	public function __construct()
    {
        parent::__construct();      
    }

    public function insert(TransacaoModel $model) 
    {
        $sql = "INSERT INTO Transacao(valor, data_transacao, id_conta_enviou, id_conta_recebeu) VALUES (?, ?, ?, ?)";

        $stmt = $this->conexao->prepare($sql);
        $stmt->bindValue(1, $model->valor);
        $stmt->bindValue(2, $model->data_transacao);
        $stmt->bindValue(3, $model->id_conta_enviou);
        $stmt->bindValue(4, $model->id_conta_recebeu);
        $stmt->execute();

        return $this->conexao->lastInsertId();
    }

    public function update(TransacaoModel $model) 
    {
        $sql = "UPDATE Transacao SET valor = ?, data_transacao = ?, id_conta_enviou = ?, id_conta_recebeu = ? WHERE id = ?";

        $stmt = $this->conexao->prepare($sql);
        $stmt->bindValue(1, $model->valor);
        $stmt->bindValue(2, $model->data_transacao);
        $stmt->bindValue(3, $model->id_conta_enviou);
        $stmt->bindValue(4, $model->id_conta_recebeu);
        $stmt->bindValue(5, $model->id);

        return $this->conexao->lastInsertId();    
    }

    public function select() 
    {
        $sql = "SELECT t.*,
        co.nome1 as nome_enviou
        co.nome2 as nome_recebeu
        FROM Transacao t
        JOIN Conta c1 ON c1.id = t.id_conta_enviou
        JOIN Correntista co1 ON co1.id = c1.id_correntista
        JOIN Conta c2 ON c2.id = t.id_conta_recebeu
        JOIN Correntista co2 ON co2.id = c2.id_correntista";
       

        $stmt = $this->conexao->prepare($sql);

        $stmt->execute();
        
        return $stmt->fetchAll(PDO::FETCH_CLASS);
    }

    public function selectById($id) 
    {
        $sql = "SELECT t.*,
        co1.nome as nome_enviou
        co2.nome as nome_recebeu
        FROM Transacao t             
                JOIN Conta c1 ON c1.id = t.id_conta_enviou
                JOIN Correntista co1 ON co1.id = c1.id_correntista
                JOIN Conta c2 ON c2.id = t.id_conta_recebeu
                JOIN Correntista co2 ON co2.id = c2.id_correntista
                WHERE t.id = ?";
       
        $stmt = $this->conexao->prepare($sql);
        $stmt->bindValue(1, $id);    
        $stmt->execute();
        return $stmt->fetchObject();
    }

    public function delete($id) 
    {
        $sql = "DELETE FROM Transacao WHERE id = ?";
        $stmt = $this->conexao->prepare($sql);
        $stmt->bindValue(1, $id);
        $stmt->execute();
    }
}