<?php 

class ClienteController {
    private $model;

    public function __construct(ClienteModel $model){
        $this->model = $model;
    }

    public function listClientes() {
        $clientes = $this->model->getClientes();
        echo json_stream($clientes);
    }

    public function searchCliente($id) {
        $cliente = $this->model->getClienteById($id);
        echo json_stream($cliente);
    }

    public function createCliente() {
        $data = json_decode(file_get_contents('php://input'), true);
        $success = $this->model->postCliente($data);
        echo json_stream(["success" => $success]);
    }

    public function updateCliente($id) {
        $data = json_decode(file_get_contents('php://input'), true);
        $success = $this->model->putCliente($id, $data);
        echo json_stream(["success" => $success]);
    }

    public function deleteCliente($id) {
        $success = $this->model->deleteCliente($id);
        echo json_stream(["success" => $success]);
    }

}