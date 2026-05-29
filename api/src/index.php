<?php

require_once 'config/db.php';
require_once 'config/cors.php';

$uri = parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH);
// AJUSTE: trim($uri, '/') garante que a barra inicial seja removida antes do explode
$uriSegments = explode('/', trim($uri, '/'));

$resource = $uriSegments[0] ?? null;
$id = $uriSegments[1] ?? null;

// O match agora apenas RETORNA os dados, sem dar echo direto
$resultado = match ($resource) {
    'clientes' => [ 
        require_once './models/ClienteModel.php',
        require_once './controllers/ClienteController.php',
        require_once './routes/ClienteRoutes.php',
    ],
    'produtos' => json_stream(["message" => "Rota de produtos ainda não implementada"]),
    default => [
        http_response_code(404),
        json_stream(["error" => "Recurso não encontrado"]) 
    ]
};

// Se o match retornou um JSON (no caso de erro ou rota não implementada), nós exibimos aqui
if (is_string($resultado)) {
    echo $resultado;
}

function json_stream($array) { 
    return json_encode($array, JSON_UNESCAPED_UNICODE); 
}