<?php

namespace App\Controllers;

class HomeController {

    public function render($view, $data = []) {
        // Extraire les variables (par ex. $title)
        extract($data);

        // Inclure directement le layout, qui lui-même inclura la vue
        include "views/layouts/app.php";
    }

    public function home() {
        return $this->render('home', ['title' => 'Accueil']);
    }

    public function about() {
        return $this->render('about', ['title' => 'À propos']);
    }
}
