<?php 

class FuncionarioController {
    private $model;

    public function __construct(FuncionarioModel $model) {
        $this->model = $model;
    }

    public function postFuncionario($data) {
        $data = json_decode(file_get_contents('php://input'), true);
        $success = $this->model->postFuncionario($data);
        echo json_stream(["success" => $success]);
    }

    public function getFuncionarios() {
        $funcionarios = $this->model->getFuncionarios();
        echo json_stream($funcionarios);
    }

    public function getFuncionarioById($id) {
        $funcionario = $this->model->getFuncionarioById($id);
        echo json_stream($funcionario);
    }

    public function putFuncionario($id, $data) {
        $data = json_decode(file_get_contents('php://input'), true);
        $success = $this->model->putFuncionario($id, $data);
        echo json_stream(["success" => $success]);
    }

    public function deleteFuncionario($id) {
        $success = $this->model->deleteFuncionario($id);
        echo json_stream(["success" => $success]);
    }
}