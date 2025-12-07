<?php
namespace App\Core;
use App\Migrations;

// EXECUTE TOUTES LES MIGRTATIONS AUTOMATIQUEMENT

class Migrator{
    public static function run(){
        $files = glob('./Migrations/*.php'); // recherche tous les fichiers dans Migration

        foreach ($files as $file) {
            require_once $file;

            // Nom de fichier → nom de classe
            $className = basename($file, '.php');

            echo $className;

            // Construire le namespace complet
            $fullyQualifiedName = "App\\Migrations\\" . $className;
            
            // Instancier dynamiquement
            $migration = new $fullyQualifiedName();
            $migration->up();

        }

        // echo "Toutes les migrations ont été éxecutées ! ";
    }
}