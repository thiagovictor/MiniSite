<?php

class conexao {

    private $type = "mysql";
    private $host = "localhost";
    private $dbname = "db_pratica";
    private $user = "root";
    private $password = "";
    private $conn;

    public function __construct() {
        try {
            $connection = new PDO("{$this->type}:host={$this->host};dbname={$this->dbname}", $this->user, $this->password);
            $this->conn = $connection;
        } catch (PDOException $e) {
            echo "Erro: " . $e->getMessage();
        }
    }

    public function getConn() {
        return $this->conn;
    }

}
