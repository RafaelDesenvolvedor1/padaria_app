<?php

require_once 'config/db.php';
require_once 'config/cors.php';

// O Host continua sendo 'db' (nome do serviço no docker-compose)
$host = getenv('DB_HOST') ?: 'db';

// AJUSTADO: Agora os nomes batem 100% com as variáveis que o Docker injeta
$dbname   = getenv('DB_NAME') ?: 'db_plataforma'; 
$user     = getenv('DB_USER') ?: 'rafael';
$password = getenv('DB_PASSWORD') ?: 'suasenhadesenvolvedor';





function json_stream($array) { 
    return json_encode($array, JSON_UNESCAPED_UNICODE); 
}