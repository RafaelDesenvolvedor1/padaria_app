<?php 

$database = new Database();
$model = new FornecedorModel($database);
$controller = new FornecedorController($model);

$method = $_SERVER['REQUEST_METHOD'];

match ($method) {
    'GET' => $id ? $controller->getFornecedorById($id) : $controller->getFornecedores(),
    'POST' => $controller->postFornecedor($_POST),
    'PUT' => $controller->putFornecedor($id, $_POST),
    'DELETE' => $controller->deleteFornecedor($id),
    default => http_response_code(405) // Método não permitido
};
