<?php 

namespace App\Core;

// LIT L'URL ET APPELLE LE BON CONTROLLER + METHODE

use App\Controllers\HomeController;
use App\Config\Routes;

class Router{

    public function route(){

        // FICHIER DE ROUTAGE PRINCIPAL DE L'APPLICATION : ATTRIBUE LES REQUÊTES AUX CONTRÔLEURS ADÉQUATS

        // Récupération des clés de tableau associatif des routes disponibles
        $availableRoutesNames = array_keys(Routes::AVAILABLE_ROUTES);

        $url = trim($_SERVER['REQUEST_URI'], '/');
        $activePage = $url !== '' ? $url : 'home';

        // Verifier si le paramètre page existe dans l'URL et s'il correspond à une route disponible
        
        $route = Routes::AVAILABLE_ROUTES[$activePage] ?? Routes::AVAILABRE_ROUTES[Routes::DEFAULT_ROUTE];

        // Construire le nom complet de la classe contrôleur
        $controllerClass = "App\\Controllers\\" . $route['controller'];
        // INCLUDE DU CONTRÔLEUR ADÉQUAT ET APPEL DE LA MÉTHODE CORRESPONDANTE

        $controllerInstance = new $controllerClass();

        // Déterminer la méthode à appeler selon le type de requête
        $url_method = $_SERVER['REQUEST_METHOD'];
        if ($url_method === 'GET') {
            $method = $route['method']['GET'];
        } elseif ($url_method === 'POST') {
            $method = $route['method']['POST'];
        }

        // Appeler la méthode correspondante
        $controllerInstance->$method();

    }
}