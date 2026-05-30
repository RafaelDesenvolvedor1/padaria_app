<?php 

class VendaModel {
    private $db;

    public function __construct(Database $db) {
        $this->db = $db->connect();
    }

    public function criarVenda($dados) {
        $sql = "INSERT INTO venda (nome, descricao, status, id_cliente, id_funcionario) VALUES (:nome, :descricao, :status, :id_cliente, :id_funcionario)";
        $stmt = $this->db->prepare($sql);
        $stmt->bindParam(':nome', $dados['nome']);
        $stmt->bindParam(':descricao', $dados['descricao']);
        $stmt->bindParam(':status', $dados['status']);
        $stmt->bindParam(':id_cliente', $dados['id_cliente']);
        $stmt->bindParam(':id_funcionario', $dados['id_funcionario']);
        return $stmt->execute();
    }

    public function listarVendas() {
        $sql = "SELECT * FROM venda";
        $stmt = $this->db->query($sql);
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function obterVendaPorId($id) {
        $sql = "SELECT * FROM venda WHERE id = :id";
        $stmt = $this->db->prepare($sql);
        $stmt->bindParam(':id', $id);
        $stmt->execute();
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    public function atualizarVenda($id, $dados) {
        $sql = "UPDATE venda SET nome = :nome, descricao = :descricao, status = :status, id_cliente = :id_cliente, id_funcionario = :id_funcionario WHERE id = :id";
        $stmt = $this->db->prepare($sql);
        $stmt->bindParam(':nome', $dados['nome']);
        $stmt->bindParam(':descricao', $dados['descricao']);
        $stmt->bindParam(':status', $dados['status']);
        $stmt->bindParam(':id_cliente', $dados['id_cliente']);
        $stmt->bindParam(':id_funcionario', $dados['id_funcionario']);
        $stmt->bindParam(':id', $id);
        return $stmt->execute();
    }

    public function excluirVenda($id) {
        $sql = "DELETE FROM venda WHERE id = :id";
        $stmt = $this->db->prepare($sql);
        $stmt->bindParam(':id', $id);
        return $stmt->execute();
    }
}