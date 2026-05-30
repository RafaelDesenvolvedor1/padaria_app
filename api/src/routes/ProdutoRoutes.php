<?php 

$database = new Database();
$model = new ProdutoModel($database);
$controller = new ProdutoController($model);

$method = $_SERVER['REQUEST_METHOD'];

match ($method) {
    'GET' => $id ? $controller->getProdutoById($id) : $controller->getProdutos(),
    'POST' => $controller->postProduto($_POST),
    'PUT' => $controller->putProduto($id, $_POST),
    'DELETE' => $controller->deleteProduto($id),
    default => http_response_code(405) // Método não permitido
};