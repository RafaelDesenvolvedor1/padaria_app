<?php 

class Database {
    private $host;
    private $port;
    private $database;
    private $user;
    private $password;

    public function __construct() {
        $this->host = getenv('DB_HOST') ?: 'db';
        $this->port = getenv('DB_PORT') ?: '3306';
        $this->database = getenv('DB_NAME') ?: 'db_plataforma';
        $this->user = getenv('DB_USER') ?: 'username';
        $this->password = getenv('DB_PASSWORD') ?: 'suasenhadesenvolvedor';
    }

    public function connect() {
        try {
            $dsn = "mysql:host={$this->host};port={$this->port};dbname={$this->database};charset=utf8mb4";

            return new PDO($dsn, $this->user, $this->password);
        } catch (PDOException $e) {
            die("Erro de conexão com o banco de dados: " . $e->getMessage());
        }
    }
}