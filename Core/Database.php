<?php
namespace App\Core;

use const App\Config\DB_CONFIG;

class Database
{
    private static ?Database $instance = null;
    private \PDO $connection;

    private string $host;
    private string $dbname;
    private string $user;
    private string $password;
    private string $charset;
    private int $port;

    private function __construct()
    {
        $this->host     = DB_CONFIG['host'];
        $this->dbname   = DB_CONFIG['dbname'];
        $this->user     = DB_CONFIG['username'];
        $this->password = DB_CONFIG['password'];
        $this->charset  = DB_CONFIG['charset'] ?? 'utf8mb4';
        $this->port     = DB_CONFIG['port'] ?? 3306;

        try {
            $this->connection = new \PDO(
                "mysql:host={$this->host};port={$this->port};dbname={$this->dbname};charset={$this->charset}",
                $this->user,
                $this->password,
                [
                    \PDO::ATTR_ERRMODE => \PDO::ERRMODE_EXCEPTION,
                    \PDO::ATTR_DEFAULT_FETCH_MODE => \PDO::FETCH_ASSOC
                ]
            );
        } catch (\PDOException $e) {
            die("Erreur de connexion DB : " . $e->getMessage());
        }
    }

    public static function getInstance(): Database
    {
        if (self::$instance === null) {
            self::$instance = new Database();
        }
        return self::$instance;
    }

    public function getConnection(): \PDO
    {
        return $this->connection;
    }
}
