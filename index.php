<?php
require_once 'controllers/PageController.php';

$controller = new PageController();

// Détermine la page à afficher
$page = $_GET['page'] ?? 'home';

// Appelle la bonne méthode du contrôleur
switch ($page) {
    case 'about':
        $controller->about();
        break;
    default:
        $controller->home();
        break;
}
