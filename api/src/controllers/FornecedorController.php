<?php 

class FornecedorController {
    private $model;

    public function __construct(FornecedorModel $model) {
        $this->model = $model;
    }

    public function postFornecedor($data) {
        $data = json_decode(file_get_contents('php://input'), true);
        $success = $this->model->postFornecedor($data);
        echo json_stream(["success" => $success]);
    }

    public function getFornecedores() {
        $fornecedores = $this->model->getFornecedores();
        echo json_stream($fornecedores);
    }

    public function getFornecedorById($id) {
        $fornecedor = $this->model->getFornecedorById($id);
        echo json_stream($fornecedor);
    }

    public function putFornecedor($id, $data) {
        $data = json_decode(file_get_contents('php://input'), true);
        $success = $this->model->putFornecedor($id, $data);
        echo json_stream(["success" => $success]);
    }

    public function deleteFornecedor($id) {
        $success = $this->model->deleteFornecedor($id);
        echo json_stream(["success" => $success]);
    }
}