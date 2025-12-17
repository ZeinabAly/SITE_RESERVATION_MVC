<?php

namespace App\Controllers;
use App\Core\Database;
use App\Core\Model;

class HomeController extends Model {

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

    public function contact() {
        return $this->render('contact', ['title' => 'Contactez-nous']);
    }
    
    public function vols() {
        $vols = $this->getAll('vols', 'DESC');
        return $this->render('vols', ['title' => 'Vols', 'vols' => $vols]);
    }

    public function hotels() {
        $hotels = $this->getAll('hotels', 'DESC');
        return $this->render('hotels', ['title' => 'Hotels', 'hotels' => $hotels]);
    }

    public function locationV() {
        return $this->render('locationV', ['title' => 'Location de véhicules', 'vols' => $vols]);
    }

    public function activities() {
        
        $activities = $this->getAll('activities', 'DESC');
        return $this->render('activities', ['title' => 'Activités', 'activities' => $activities]);
    }
}
