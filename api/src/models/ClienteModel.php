<?php 

class ClienteModel {
    private $db;

    public function __construct(Database $db) {
        $this->db = $db->connect();
    }

    public function postCliente($data) {
        $sql = "INSERT INTO cliente (nome, email, telefone) VALUES (:nome, :email, :telefone)";
        $stmt = $this->db->prepare($sql);
        $stmt->bindValue(':nome', $data['nome']);
        $stmt->bindValue(':email', $data['email']);
        $stmt->bindValue(':telefone', $data['telefone']);
        return $stmt->execute();
    }

    public function getClientes() {
        $sql = "SELECT * FROM cliente";
        $stmt = $this->db->query($sql);
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function getClienteById($id) {
        $sql = "SELECT * FROM cliente WHERE id_cliente = :id";
        $stmt = $this->db->prepare($sql);
        $stmt->bindValue(':id', $id, PDO::PARAM_INT);
        $stmt->execute();
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    public function putCliente($id, $data) {
        $sql = "UPDATE cliente SET nome = :nome, email = :email, telefone = :telefone WHERE id_cliente = :id";
        $stmt = $this->db->prepare($sql);
        $stmt->bindValue(':nome', $data['nome']);
        $stmt->bindValue(':email', $data['email']);
        $stmt->bindValue(':telefone', $data['telefone']);
        $stmt->bindValue(':id', $id, PDO::PARAM_INT);
        return $stmt->execute();
    }

    public function deleteCliente($id) {
        $sql = "DELETE FROM cliente WHERE id_cliente = :id";
        $stmt = $this->db->prepare($sql);
        $stmt->bindValue(':id', $id, PDO::PARAM_INT);
        return $stmt->execute();
    }
}