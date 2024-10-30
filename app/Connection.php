<?php

use Dotenv\Dotenv;

class Connection
{
    private $Host;
    private $User;
    private $Password;
    private $Database;
    private $attributes = array(PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION, PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC);
    protected $db;

    public function __construct()
    {
        $dotenv = Dotenv::createImmutable(__DIR__);
        $dotenv->load();

        // Asignar los valores de las variables de entorno
        $this->Host = $_ENV['DB_HOST'];
        $this->User = $_ENV['DB_USER'];
        $this->Password = $_ENV['DB_PASS'];
        $this->Database = $_ENV['DB_NAME'];
    }

    public function connect()
    {
        try {
            // Conexión PDO
            $this->db = new PDO("mysql:host={$this->Host};dbname={$this->Database};charset=utf8", $this->User, $this->Password, $this->attributes);

            // Devolver la conexión
            return $this->db;
        } catch (PDOException $e) {
            echo 'Fallo Al Conectarse Con El Servidor: ' . $e->getMessage();
        }
    }
}
