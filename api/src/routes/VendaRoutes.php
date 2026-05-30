<?php 

$database = new Database();
$model = new VendaModel($database);
$controller = new VendaController($model);

$method = $_SERVER['REQUEST_METHOD'];

match ($method) {
    'GET' => $id ? $controller->obterVendaPorId($id) : $controller->listarVendas(),
    'POST' => $controller->criarVenda($_POST),
    'PUT' => $controller->atualizarVenda($id, $_POST),
    'DELETE' => $controller->excluirVenda($id),
    default => http_response_code(405) // Método não permitido
};