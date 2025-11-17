<?php
namespace App\Core;

// CONNEXION UNIQUE A LA DB AVEC LE PATTERN SINGLETON 

use App\Config\DB_CONFIG;

// PATTERN SINGLETON POUR LA CONNEXION UNIQUE A LA BASE DE DONNEES
class Database {
    private static ?Database $instance = null;
    private PDO $connection;

    // DECLARATION DES CONSTANTES DE CONNEXION A LA BASE DE DONNEES
    private string $host = DB_CONFIG['host'];
    private string $dbname = DB_CONFIG['dbname'];
    private string $username = DB_CONFIG['username'];
    private string $password = DB_CONFIG['password'];
    private string $charset = DB_CONFIG['charset'];

    // DECLARATION DU CONSTRUCTEUR PRIVE
    private function __construct(){
        try{
            $this->connection = new PDO(
                "mysql:host={$this->host};
                dbname={$this->dbname};
                charset={$this->charset}",
                $this->username,
                $this->password,
                [
                    PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
                    PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC
                ]
            );
        }catch(PDOExceptionn $e){
            die("Erreur de connexion : " . $e->getMessage());
        }


    }
    // METHODE POUR OBTENIR L'INSTANCE UNIQUE
    public static function getInstance(): Database {
        if(self::$instance === null){
            self::$instance = new Database();
        }
        return self::instance();
    }

    public function getConnection(): PDO {
        return $this->connection;
    }
}

