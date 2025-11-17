<?php
namespace App\Controllers;

require_once 'models/Etudiant.php';

class EtudiantController {
    private $model;

    public function __construct($db) {
        $this->model = new Etudiant($db);
    }

    public function afficherEtudiants() {
        $etudiants = $this->model->getAll();
        include 'views/etudiants.php';
    }
}
?>
