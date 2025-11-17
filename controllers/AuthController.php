<?php

namespace App\Controllers;

class AuthController {

    public function render($view, $data = []) {
        // Extraire les variables (par ex. $title)
        extract($data);

        // Inclure directement le layout, qui lui-même inclura la vue
        include "views/layouts/app.php";
    }

    public function login() {
        return $this->render('login', ['title' => 'Login']);
    }

    public function register() {
        return $this->render('register', ['title' => 'Registrer']);
    }
}
