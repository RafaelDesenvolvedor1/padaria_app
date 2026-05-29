<?php 

$database = new Database();
$model = new ClienteModel($database);
$controller = new ClienteController($model);

$method = $_SERVER['REQUEST_METHOD'];

match ($method) {
    'GET' => $id ? $controller->searchCliente($id) : $controller->listClientes(),
    'POST' => $controller->createCliente(),
    'PUT' => $controller->updateCliente($id),
    'DELETE' => $controller->deleteCliente($id),
    default => http_response_code(405) // Método não permitido
};