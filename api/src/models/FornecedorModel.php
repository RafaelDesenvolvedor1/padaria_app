<?php 

class FornecedorModel {
    private $db;

    public function __construct(Database $db) {
        $this->db = $db->connect();
    }

    public function postFornecedor($data) {
        $sql = "INSERT INTO fornecedor (nome, descricao, status) VALUES (:nome, :descricao, :status)";
        $stmt = $this->db->prepare($sql);
        $stmt->bindValue(':nome', $data['nome']);
        $stmt->bindValue(':descricao', $data['descricao']);
        $stmt->bindValue(':status', $data['status']);
        return $stmt->execute();
    }

    public function getFornecedores() {
        $sql = "SELECT * FROM fornecedor";
        $stmt = $this->db->query($sql);
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function getFornecedorById($id) {
        $sql = "SELECT * FROM fornecedor WHERE id_fornecedor = :id";
        $stmt = $this->db->prepare($sql);
        $stmt->bindValue(':id', $id, PDO::PARAM_INT);
        $stmt->execute();
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    public function putFornecedor($id, $data) {
        $sql = "UPDATE fornecedor SET nome = :nome, descricao = :descricao, status = :status WHERE id_fornecedor = :id";
        $stmt = $this->db->prepare($sql);
        $stmt->bindValue(':nome', $data['nome']);
        $stmt->bindValue(':descricao', $data['descricao']);
        $stmt->bindValue(':status', $data['status']);
        $stmt->bindValue(':id', $id, PDO::PARAM_INT);
        return $stmt->execute();
    }

    public function deleteFornecedor($id) {
        $sql = "DELETE FROM fornecedor WHERE id_fornecedor = :id";
        $stmt = $this->db->prepare($sql);
        $stmt->bindValue(':id', $id, PDO::PARAM_INT);
        return $stmt->execute();
    }
}