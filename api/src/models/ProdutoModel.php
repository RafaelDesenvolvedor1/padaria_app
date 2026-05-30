<?php 

class ProdutoModel {
    private $db;

    public function __construct(Database $db) {
        $this->db = $db->connect();
    }

    public function postProduto($data) {
        $sql = "INSERT INTO produto (nome, descricao, status, id_fornecedor) VALUES (:nome, :descricao, :status, :id_fornecedor)";
        $stmt = $this->db->prepare($sql);
        $stmt->bindValue(':nome', $data['nome']);
        $stmt->bindValue(':descricao', $data['descricao']);
        $stmt->bindValue(':status', $data['status']);
        $stmt->bindValue(':id_fornecedor', $data['id_fornecedor']);
        return $stmt->execute();
    }

    public function getProdutos() {
        $sql = "SELECT * FROM produto";
        $stmt = $this->db->query($sql);
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function getProdutoById($id) {
        $sql = "SELECT * FROM produto WHERE id_produto = :id";
        $stmt = $this->db->prepare($sql);
        $stmt->bindValue(':id', $id, PDO::PARAM_INT);
        $stmt->execute();
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }   

    public function putProduto($id, $data) {
        $sql = "UPDATE produto SET nome = :nome, descricao = :descricao, status = :status, id_fornecedor = :id_fornecedor WHERE id_produto = :id";
        $stmt = $this->db->prepare($sql);
        $stmt->bindValue(':nome', $data['nome']);
        $stmt->bindValue(':descricao', $data['descricao']);
        $stmt->bindValue(':status', $data['status']);
        $stmt->bindValue(':id_fornecedor', $data['id_fornecedor']);
        $stmt->bindValue(':id', $id, PDO::PARAM_INT);
        return $stmt->execute();
    }

    public function deleteProduto($id) {
        $sql = "DELETE FROM produto WHERE id_produto = :id";
        $stmt = $this->db->prepare($sql);
        $stmt->bindValue(':id', $id, PDO::PARAM_INT);
        return $stmt->execute();
    }
}