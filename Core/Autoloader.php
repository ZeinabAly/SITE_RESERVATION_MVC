<?php

namespace App\Core;

class Autoloader
{
    public static function register(){
        spl_autoload_register([__CLASS__, 'namespaceLoad']);
    }

    public static function namespaceLoad($class){
        // On vérifie que la classe appartient au namespace App
        if (strpos($class, 'App\\') !== 0) {
            return;
        }

        // On enlève "App\" pour retrouver la structure des dossiers
        $class = str_replace("App\\", "", $class);

        // Conversion namespace → chemin fichier
        $class = str_replace("\\", "/", $class);

        // Construction du chemin complet
        $file = __DIR__ . "/../" . $class . ".php";

        if (file_exists($file)) {
            require $file;
        }

    }
}