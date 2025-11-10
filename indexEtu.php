<?php
require_once 'controllers/EtudiantController.php';

// Connexion à la base
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "coursPHPCorte";

try {
    $db = new PDO("mysql:host=$servername;dbname=$dbname;charset=utf8", $username, $password);
    $db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    // Créer le contrôleur
    $controller = new EtudiantController($db);

    // Appeler la fonction pour afficher les étudiants
    $controller->afficherEtudiants();

} catch (PDOException $e) {
    echo "Erreur : " . $e->getMessage();
}
?>
