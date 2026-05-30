<?php 

$database = new Database();
$model = new FuncionarioModel($database);
$controller = new FuncionarioController($model);

$method = $_SERVER['REQUEST_METHOD'];

match ($method) {
    'GET' => $id ? $controller->getFuncionarioById($id) : $controller->getFuncionarios(),
    'POST' => $controller->postFuncionario($_POST),
    'PUT' => $controller->putFuncionario($id, $_POST),
    'DELETE' => $controller->deleteFuncionario($id),
    default => http_response_code(405) // Método não permitido
};