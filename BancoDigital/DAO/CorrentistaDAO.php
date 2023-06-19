<?php
namespace BancoDigital\DAO;

use BancoDigital\Model\CorrentistaModel;
use \PDO;

class CorrentistaDAO extends DAO {

	public function __construct()
    {
        parent::__construct();      
    }

    public function save(CorrentistaModel $m) : CorrentistaModel
    {
        return ($m->id == null) ? $this->insert($m) : $this->update($m);
    }

    public function insert(CorrentistaModel $model) 
    {
        $sql = "INSERT INTO correntista (nome, cpf, data_nasc, senha) VALUES (?, ?, ?, sha1(?)) ";

        $stmt = $this->conexao->prepare($sql);

        $stmt->bindValue(1, $model->nome);
        $stmt->bindValue(2, $model->cpf);
        $stmt->bindValue(3, $model->data_nasc);
        $stmt->bindValue(4, $model->senha);

        $stmt->execute();

        $model->id = $this->conexao->lastInsertId();

        return $model;
    }

    public function search(string $busca) : array
    {
        $str_busca = ['filtro' => '%' . $busca . '%'];

        $sql = "SELECT *
        FROM Correntista 
        WHERE nome LIKE :filtro ";

        $stmt = $this->conexao->prepare($sql);
        $stmt->execute($str_busca);

        return $stmt->fetchAll(PDO::FETCH_CLASS, "API\Model\CorrentistaModel");
    }

    public function update(CorrentistaModel $model)
    {
        $sql = "UPDATE conta SET nome=?, cpf=?, data_nasc = ?, senha = ? WHERE id=? ";

        $stmt = $this->conexao->prepare($sql);
        $stmt->bindValue(1, $model->nome);
        $stmt->bindValue(2, $model->cpf);
        $stmt->bindValue(3, $model->data_nasc);
        $stmt->bindValue(4, $model->senha);
        $stmt->bindValue(5, $model->id);
        $stmt->execute();

        return $model;
    }

    public function select()
    {
        $sql = "SELECT *
        FROM Correntista 
        ";

        $stmt = $this->conexao->prepare($sql);
        $stmt->execute();

        return $stmt->fetchAll(PDO::FETCH_CLASS, "API\Model\CorrentistaModel");
    }

    public function selectById(int $id)
    {
        $sql = "SELECT *
        FROM Correntista 
        WHERE id = ? ";

        $stmt = $this->conexao->prepare($sql);
        $stmt->bindValue(1, $id);
        $stmt->execute();

        return $stmt->fetchAll(PDO::FETCH_CLASS, "API\Model\CorrentistaModel");
    }

    public function selectByCpfAndSenha($cpf, $senha) : CorrentistaModel
    {
        $sql = "SELECT * FROM correntista WHERE cpf = ? AND senha = sha1(?) ";

        $stmt = $this->conexao->prepare($sql);
        $stmt->bindValue(1, $cpf);
        $stmt->bindValue(2, $senha);
        $stmt->execute();

        //return $stmt->fetchObject("API\Model\CorrentistaModel"); // Retornando um objeto específico PessoaModel
        $obj = $stmt->fetchObject("App\Model\CorrentistaModel");

        return is_object($obj) ? $obj : new CorrentistaModel();
    }

    public function delete(int $id)
    {
        $sql = "DELETE FROM correntista WHERE id = ? ";

        $stmt = $this->conexao->prepare($sql);
        $stmt->bindValue(1, $id);
        return $stmt->execute();
    }
}