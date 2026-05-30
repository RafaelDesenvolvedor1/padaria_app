<?php 

class VendaProdutoController {
    private $model;

    public function __construct(VendaProdutoModel $model) {
        $this->model = $model;
    }

    public function createVendaProduto($data) {
        $data = json_decode(file_get_contents('php://input'), true);
        $success = $this->model->createVendaProduto($data['id_venda'], $data['id_produto']);
        echo json_stream(["success" => $success]);
    }

    public function listarVendaProdutos() {
        $vendas = $this->model->listarVendaProdutos();
        echo json_stream($vendas);
    }

    public function getProdutosByVendaId($vendaId) {
        $produtos = $this->model->getProdutosByVendaId($vendaId);
        echo json_stream($produtos);
    }

    public function updateVendaProduto($vendaId, $produtoId, $newProdutoId) {
        $data = json_decode(file_get_contents('php://input'), true);
        $success = $this->model->updateVendaProduto($vendaId, $produtoId, $newProdutoId);
        echo json_stream(["success" => $success]);
    }

    public function deleteVendaProduto($vendaId, $produtoId) {
        $success = $this->model->deleteVendaProduto($vendaId, $produtoId);
        echo json_stream(["success" => $success]);
    }
}