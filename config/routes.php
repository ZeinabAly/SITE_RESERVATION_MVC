<?php 

namespace App\Config;

// LISTES L'ENSEMBLE DES ROUTES DISPONIBLES DANS L'APPLICATION CORRESPONDANTES AUX CONTRÔLEURS
class Routes{

    public const AVAILABLE_ROUTES = [
        "home" => ["controller" => "HomeController", "method" => ["GET" => "home"]],
        "about" => ["controller" => "HomeController", "method" => ["GET" => "about"]],
        "login" => ["controller" => "AuthController", "method" => ["GET" => "login"]],
        "register" => ["controller" => "AuthController", "method" => ["GET" => "register"]],
    ];
    
    public const DEFAULT_ROUTE = "home";

}