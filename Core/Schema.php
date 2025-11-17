<?php
namespace App\Core;

// SCHEMA DES MIGRATIONS

use App\Core\Database;

class Schema{
    public static function create(string $table, callable $callable){
        $blueprint = new BluePrint($table);
        $callable($blueprint);

        $sql = $blueprint->buildCreateQuery();

        $db = Database::getInstance()->getConnection();

        $db->exec($sql);

        echo "Table $table créée ! ";
    }

    public static function drop(string $table){
        $db = Database::getInstance()->getConnection();

        $db->exec("DROP TABLE IF EXISTS `$table`");

        echo "Table $table supprimée ! ";
    }
}

?>