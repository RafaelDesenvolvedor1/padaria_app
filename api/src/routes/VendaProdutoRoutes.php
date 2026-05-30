<?php 

$database = new Database();
$model = new VendaProdutoModel($database);
$controller = new VendaProdutoController($model);

$method = $_SERVER['REQUEST_METHOD'];

match ($method) {
    'GET' => isset($_GET['venda_id']) ? $controller->getProdutosByVendaId($_GET['venda_id']) : $controller->listarVendaProdutos(),
    'POST' => $controller->createVendaProduto(file_get_contents('php://input')),
    'PUT' => $controller->updateVendaProduto($_GET['venda_id'], $_GET['produto_id'], file_get_contents('php://input')),
    'DELETE' => $controller->deleteVendaProduto($_GET['venda_id'], $_GET['produto_id']),
    default => http_response_code(405) // Método não permitido
};