<?php
namespace BancoDigital\DAO;

use BancoDigital\Model\ChavePixModel;
use \PDO;

class ChavePixDAO extends DAO {

    public function __construct()
    {
        parent::__construct();      
    }

    public function insert(ChavePixModel $model)
    {
        $sql = "INSERT INTO chave_pix (tipo, chave, id_conta) VALUES (?, ?, ?) ";

        $stmt = $this->conexao->prepare($sql);
        $stmt->bindValue(1, $model->tipo);
        $stmt->bindValue(2, $model->chave);
        $stmt->bindValue(3, $model->id_conta);
        $stmt->execute();

        $model->id = $this->conexao->lastInsertId();

        return $model;
    }

    public function search(string $busca) : array
    {
        $str_busca = ['filtro' => '%' . $busca . '%'];

        $sql = "SELECT * FROM chave_pix WHERE nome LIKE :filtro ";

        $stmt = $this->conexao->prepare($sql);
        $stmt->execute($str_busca);

        return $stmt->fetchAll(PDO::FETCH_CLASS, "API\Model\ChavePixModel");
    }

    public function update(ChavePixModel $model)
    {
        $sql = "UPDATE chave_pix SET tipo=?, chave=?, id_conta = ? WHERE id=? ";

        $stmt = $this->conexao->prepare($sql);
        $stmt->bindValue(1, $model->tipo);
        $stmt->bindValue(2, $model->chave);
        $stmt->bindValue(3, $model->id_conta);
        $stmt->bindValue(4, $model->id);
        $stmt->execute();

        return $stmt->execute();
    }

    public function select()
    {
        $sql = "SELECT cp.*,
        co.nome as nome_conta
        FROM ChavePix cp 
        JOIN Conta c ON c.id = cp.id_conta
        JOIN Correntista co ON co.id = c.id_correntista";

        $stmt = $this->conexao->prepare($sql);
        $stmt->execute();

        return $stmt->fetchAll(PDO::FETCH_CLASS, "API\Model\ChavePixModel");
    }

    public function selectById(int $id)
    {
        $sql = "SELECT cp.*,
        co.nome as nome_conta
        FROM ChavePix cp 
        JOIN Conta c ON c.id = cp.id_conta
        JOIN Correntista co ON co.id = c.id_correntista 
        WHERE cp.id = ? ";

        $stmt = $this->conexao->prepare($sql);
        $stmt->bindValue(1, $id);
        $stmt->execute();

        return $stmt->fetchAll(PDO::FETCH_CLASS, "API\Model\ChavePixModel");
    }

    public function delete(int $id)
    {
        $sql = "DELETE FROM chave_pix WHERE id = ? ";

        $stmt = $this->conexao->prepare($sql);
        $stmt->bindValue(1, $id);
        return $stmt->execute();
    }
}