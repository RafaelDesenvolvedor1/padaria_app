<?php

class FuncionarioModel {
    private $db;

    public function __construct(Database $db) {
        $this->db = $db->connect();
    }

    public function postFuncionario($data) {
        $sql = "INSERT INTO funcionario (nome, telefone, email) VALUES (:nome, :telefone, :email)";
        $stmt = $this->db->prepare($sql);
        $stmt->bindValue(':nome', $data['nome']);
        $stmt->bindValue(':telefone', $data['telefone']);
        $stmt->bindValue(':email', $data['email']);
        return $stmt->execute();
    }

    public function getFuncionarios() {
        $sql = "SELECT * FROM funcionario";
        $stmt = $this->db->query($sql);
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function getFuncionarioById($id) {
        $sql = "SELECT * FROM funcionario WHERE id_funcionario = :id";
        $stmt = $this->db->prepare($sql);
        $stmt->bindValue(':id', $id, PDO::PARAM_INT);
        $stmt->execute();
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    public function putFuncionario($id, $data) {
        $sql = "UPDATE funcionario SET nome = :nome, telefone = :telefone, email = :email WHERE id_funcionario = :id";
        $stmt = $this->db->prepare($sql);
        $stmt->bindValue(':nome', $data['nome']);
        $stmt->bindValue(':telefone', $data['telefone']);
        $stmt->bindValue(':email', $data['email']);
        $stmt->bindValue(':id', $id, PDO::PARAM_INT);
        return $stmt->execute();
    }

    public function deleteFuncionario($id) {
        $sql = "DELETE FROM funcionario WHERE id_funcionario = :id";
        $stmt = $this->db->prepare($sql);
        $stmt->bindValue(':id', $id, PDO::PARAM_INT);
        return $stmt->execute();
    }
}