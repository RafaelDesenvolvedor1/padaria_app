<?php 

class VendaProdutoModel {
    private $db;

    public function __construct(Database $db) {
        $this->db = $db->connect();
    }

    public function createVendaProduto($vendaId, $produtoId) {
        $sql = "INSERT INTO venda_produto (id_venda, id_produto) VALUES (:venda_id, :produto_id)";
        $stmt = $this->db->prepare($sql);
        $stmt->bindParam(':venda_id', $vendaId);
        $stmt->bindParam(':produto_id', $produtoId);
        return $stmt->execute();
    }

    public function listarVendaProdutos() {
        $sql = "SELECT vp.id_venda, vp.id_produto, p.nome AS produto_nome
                FROM venda_produto vp
                JOIN produto p ON vp.id_produto = p.id_produto";
        $stmt = $this->db->prepare($sql);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function getProdutosByVendaId($vendaId) {
        $sql = "SELECT p.id_produto, p.nome FROM produto p
                JOIN venda_produto vp ON p.id_produto = vp.id_produto
                WHERE vp.id_venda = :venda_id";
        $stmt = $this->db->prepare($sql);
        $stmt->bindParam(':venda_id', $vendaId);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function updateVendaProduto($vendaId, $produtoId, $newProdutoId) {
        $sql = "UPDATE venda_produto SET id_produto = :new_produto_id 
                WHERE id_venda = :venda_id AND id_produto = :produto_id";
        $stmt = $this->db->prepare($sql);
        $stmt->bindParam(':venda_id', $vendaId);
        $stmt->bindParam(':produto_id', $produtoId);
        $stmt->bindParam(':new_produto_id', $newProdutoId);
        return $stmt->execute();
    }

    public function deleteVendaProduto($vendaId, $produtoId) {
        $sql = "DELETE FROM venda_produto WHERE id_venda = :venda_id AND id_produto = :produto_id";
        $stmt = $this->db->prepare($sql);
        $stmt->bindParam(':venda_id', $vendaId);
        $stmt->bindParam(':produto_id', $produtoId);
        return $stmt->execute();
    }

}