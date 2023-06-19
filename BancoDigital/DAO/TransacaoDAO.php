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
        $sql = "INSERT INTO conta (valor, data_transacao, id_conta_enviou, id_conta_recebeu) VALUES (?, ?, ?, ?) ";

        $stmt = $this->conexao->prepare($sql);
        $stmt->bindValue(1, $model->valor);
        $stmt->bindValue(2, $model->data_transacao);
        $stmt->bindValue(3, $model->id_conta_enviou);
        $stmt->bindValue(4, $model->id_conta_recebeu);
        $stmt->execute();

        $model->id = $this->conexao->lastInsertId();

        return $model;
    }

    public function search(string $busca) : array
    {
        $str_busca = ['filtro' => '%' . $busca . '%'];

        $sql = "SELECT t.*,
        co1.nome as nome_enviou
        co2.nome as nome_recebeu
        FROM Transacao t
        JOIN Conta c1 ON c1.id = t.id_conta_enviou
        JOIN Correntista co1 ON co1.id = c1.id_correntista
        JOIN Conta c2 ON c2.id = t.id_conta_recebeu
        JOIN Correntista co2 ON co2.id = c2.id_correntista
        WHERE co1.nome LIKE :filtro ";

        $stmt = $this->conexao->prepare($sql);
        $stmt->execute($str_busca);

        return $stmt->fetchAll(PDO::FETCH_CLASS, "API\Model\ContaModel");
    }

    public function update(TransacaoModel $model)
    {
        $sql = "UPDATE conta SET valor=?, data_transacao=?, id_conta_enviou = ?, id_conta_recebeu = ? WHERE id=? ";

        $stmt = $this->conexao->prepare($sql);
        $stmt->bindValue(1, $model->valor);
        $stmt->bindValue(2, $model->data_transacao);
        $stmt->bindValue(3, $model->id_conta_enviou);
        $stmt->bindValue(4, $model->id_conta_recebeu);
        $stmt->bindValue(5, $model->id);
        $stmt->execute();

        return $stmt->execute();
    }

    public function select()
    {
        $sql = "SELECT t.*,
        co1.nome as nome_enviou
        co2.nome as nome_recebeu
        FROM Transacao t
        JOIN Conta c1 ON c1.id = t.id_conta_enviou
        JOIN Correntista co1 ON co1.id = c1.id_correntista
        JOIN Conta c2 ON c2.id = t.id_conta_recebeu
        JOIN Correntista co2 ON co2.id = c2.id_correntista
        ";

        $stmt = $this->conexao->prepare($sql);
        $stmt->execute();

        return $stmt->fetchAll(PDO::FETCH_CLASS, "API\Model\ContaModel");
    }

    public function selectById(int $id)
    {
        $sql = "SELECT t.*,
        co1.nome as nome_enviou
        co2.nome as nome_recebeu
        FROM Transacao t
        JOIN Conta c1 ON c1.id = t.id_conta_enviou
        JOIN Correntista co1 ON co1.id = c1.id_correntista
        JOIN Conta c2 ON c2.id = t.id_conta_recebeu
        JOIN Correntista co2 ON co2.id = c2.id_correntista
        WHERE cp.id = ? ";

        $stmt = $this->conexao->prepare($sql);
        $stmt->bindValue(1, $id);
        $stmt->execute();

        return $stmt->fetchAll(PDO::FETCH_CLASS, "API\Model\ContaModel");
    }

    public function delete(int $id)
    {
        $sql = "DELETE FROM transacao WHERE id = ? ";

        $stmt = $this->conexao->prepare($sql);
        $stmt->bindValue(1, $id);
        return $stmt->execute();
    }
}