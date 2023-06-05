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
        $sql = "INSERT INTO ChavePix(tipo, chave, id_conta) VALUES (?, ?, ?)";

        $stmt = $this->conexao->prepare($sql);
        $stmt->bindValue(1, $model->tipo);
        $stmt->bindValue(2, $model->chave);
        $stmt->bindValue(3, $model->id_conta);
        $stmt->execute();

        return $this->conexao->lastInsertId();
    }

    public function update(ChavePixModel $model) 
    {
        $sql = "UPDATE ChavePix SET tipo = ?, chave = ?, id_conta = ? WHERE id = ?";

        $stmt = $this->conexao->prepare($sql);
        $stmt->bindValue(1, $model->tipo);
        $stmt->bindValue(2, $model->chave);
        $stmt->bindValue(3, $model->id_conta);
        $stmt->bindValue(4, $model->id);

        return $this->conexao->lastInsertId();
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
        
        return $stmt->fetchAll(PDO::FETCH_CLASS);
    }

    public function selectById($id) 
    {
        $sql = "SELECT cp.*,
                co.nome as nome_conta
                FROM ChavePix cp
                JOIN Conta c ON c.id = cp.id_conta
                JOIN Correntista co.ON co.id = c.id_correntista
                WHERE cp.id = ?";

        $stmt = $this->conexao->prepare($sql);
        $stmt->bindValue(1, $id);

        $stmt->execute();
        return $stmt->fetchObject();
    }

    public function delete($id) 
    {
        $sql = "DELETE FROM chavepix WHERE id = ?";

        $stmt = $this->conexao->prepare($sql);

        $stmt->bindValue(1, $id);

        $stmt->execute();
    }
}