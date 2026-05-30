<?php 

class ProdutoController {
    private $model;

    public function __construct(ProdutoModel $model) {
        $this->model = $model;
    }

    public function postProduto($data) {
        $data = json_decode(file_get_contents('php://input'), true);
        $success = $this->model->postProduto($data);
        echo json_stream(["success" => $success]);
    }

    public function getProdutos() {
        $produtos = $this->model->getProdutos();
        echo json_stream($produtos);
    }

    public function getProdutoById($id) {
        $produto = $this->model->getProdutoById($id);
        echo json_stream($produto);
    }

    public function putProduto($id, $data) {
        $data = json_decode(file_get_contents('php://input'), true);
        $success = $this->model->putProduto($id, $data);
        echo json_stream(["success" => $success]);
    }

    public function deleteProduto($id) {
        $success = $this->model->deleteProduto($id);
        echo json_stream(["success" => $success]);
    }
}