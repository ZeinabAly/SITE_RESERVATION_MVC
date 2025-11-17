<?php
namespace App;
// Point d'entrée principal de l'application, affiche dynamiquement la page demandée
use App\Core\Autoloader;
use App\Core\Router;


// UTILISER LE JS POUR GERER LES REQUETES

require "./Core/Autoloader.php";
Autoloader::register();

use App\Core\Database;


$router = new Router();
$router->route();
