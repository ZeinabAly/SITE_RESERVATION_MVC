<?php 

namespace App\Config;

// LISTES L'ENSEMBLE DES ROUTES DISPONIBLES DANS L'APPLICATION CORRESPONDANTES AUX CONTRÔLEURS
class Routes{

    public const AVAILABLE_ROUTES = [
        "home" => ["controller" => "HomeController", "method" => ["GET" => "home"]],
        "about" => ["controller" => "HomeController", "method" => ["GET" => "about"]],
        "activities" => ["controller" => "HomeController", "method" => ["GET" => "activities"]],
        "vols" => ["controller" => "HomeController", "method" => ["GET" => "vols"]],
        "hotels" => ["controller" => "HomeController", "method" => ["GET" => "hotels"]],
        "locationV" => ["controller" => "HomeController", "method" => ["GET" => "locationV"]],
        "contact" => ["controller" => "HomeController", "method" => ["GET" => "contact"]],
        "login" => ["controller" => "AuthController", "method" => ["GET" => "login", "POST" => "handleLogin"]],
        "register" => ["controller" => "AuthController", "method" => ["GET" => "register", "POST" => "handleRegister"]],
    ];

    public const ADMIN_ROUTES = [
        "admin" => ["controller" => "AdminDashController", "method" => ["GET" => "index"] ]
    ];
    
    public const DEFAULT_ROUTE = "home";

}