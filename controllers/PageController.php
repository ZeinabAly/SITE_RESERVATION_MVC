<?php
class PageController {

    public function render($view, $data = []) {
        // Extraire les variables (par ex. $title)
        extract($data);

        // Démarre la mise en mémoire tampon
        ob_start();
        include "views/pages/$view.php";
        $content = ob_get_clean();

        // Inclut le layout avec le contenu injecté
        include "views/layouts/app.php";
    }

    public function home() {
        $this->render('home', ['title' => 'Accueil']);
    }

    public function about() {
        $this->render('about', ['title' => 'À propos']);
    }
}
