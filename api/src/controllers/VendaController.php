<?php 

class VendaController {
    private $model;

    public function __construct($model) {
        $this->model = $model;
    }

    public function criarVenda($dados) {
        $data = json_decode(file_get_contents('php://input'), true);
        $success = $this->model->criarVenda($data);
        echo json_stream(["success" => $success]);
    }

    public function listarVendas() {
        $vendas = $this->model->listarVendas();
        echo json_stream($vendas);
    }

    public function obterVendaPorId($id) {
        $venda = $this->model->obterVendaPorId($id);
        echo json_stream($venda);
    }

    public function atualizarVenda($id, $dados) {
        $data = json_decode(file_get_contents('php://input'), true);
        $success = $this->model->atualizarVenda($id, $data);
        echo json_stream(["success" => $success]);
    }

    public function excluirVenda($id) {
        $success = $this->model->excluirVenda($id);
        echo json_stream(["success" => $success]);
    }
}