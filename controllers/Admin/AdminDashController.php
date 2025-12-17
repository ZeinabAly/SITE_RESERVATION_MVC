<?php

namespace App\Controllers\Admin;

class AdminDashController {

    public function render($view, $data = []) {
        // Extraire les variables (par ex. $title)
        extract($data);

        // Inclure directement le layout, qui lui-même inclura la vue
        include "views/layouts/admin.php";
    }

    public function index() {
        return $this->render('dashboard', ['title' => 'Admin Dashboard']);
    }

}
