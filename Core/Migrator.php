<?php
namespace App\Core;
use App\Migrations;

// EXECUTE TOUTES LES MIGRTATIONS AUTOMATIQUEMENT

class Migrator{
    public static function run(){
        $files = glob(__DIR__.'/Migrations/*.php'); // recherche tous les fichiers dans Migration

        foreach ($files as $file){
            require_once $file;

            // RECUPERER LA CLASSE A EXECUTER

            $className = basename($file, '.php');
            $migration = new $className();
            $migration->up();
            echo 'yes';
        }

        // echo "Toutes les migrations ont été éxecutées ! ";
    }
}