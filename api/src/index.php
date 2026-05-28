<?php
header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Methods: GET, POST, OPTIONS");
header("Access-Control-Allow-Headers: Content-Type, Authorization");
header("Content-Type: application/json");

// O Host continua sendo 'db' (nome do serviço no docker-compose)
$host = getenv('DB_HOST') ?: 'db';

// AJUSTADO: Agora os nomes batem 100% com as variáveis que o Docker injeta
$dbname   = getenv('DB_NAME') ?: 'db_plataforma'; 
$user     = getenv('DB_USER') ?: 'rafael';
$password = getenv('DB_PASSWORD') ?: 'suasenhadesenvolvedor';

try {
    $pdo = new PDO("mysql:host=$host;dbname=$dbname;charset=utf8", $user, $password);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);    
    
    echo json_stream(["status" => "sucesso", "mensagem" => "Conectado ao MySQL com sucesso via Docker!"]);
} catch (PDOException $e) {
    // Retorna o erro em formato JSON estruturado para o Dio do Flutter ler sem quebrar
    echo json_stream(["status" => "erro", "mensagem" => "Falha na conexão: " . $e->getMessage()]);
}

function json_stream($array) { 
    return json_encode($array, JSON_UNESCAPED_UNICODE); 
}