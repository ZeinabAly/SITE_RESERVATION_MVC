<?php
namespace App\Core;

// SCHEMA DES MIGRATIONS

use App\Core\Database;
// var_dump('schema');

class Schema{
    public static function create(string $table, string $sql){

        $db = Database::getInstance()->getConnection();
        
        $structure = 
        "CREATE TABLE IF NOT EXISTS `$table` 
        (\n$sql
        , `created_at` TIMESTAMP DEFAULT CURRENT_TIMESTAMP, 
          `updated_at` TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
          `deleted_at` TIMESTAMP DEFAULT NULL
        \n)
        ENGINE=InnoDB;";

        $db->exec($structure);

        echo "Table $table créée ! ";
    }

    public static function drop(string $table){
        $db = Database::getInstance()->getConnection();

        // Désactive temporairement les checks FK
        $db->exec("SET FOREIGN_KEY_CHECKS = 0;");

        // Supprime la table
        $db->exec("DROP TABLE IF EXISTS `$table`;");

        // Réactive les checks FK
        $db->exec("SET FOREIGN_KEY_CHECKS = 1;");

        echo "Table $table supprimée ! ";
    }
}


?>