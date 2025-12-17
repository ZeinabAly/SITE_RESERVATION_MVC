<?php
namespace App\Core;

class Validator {

    protected array $errors = [];
    protected $pdo;

    public function __construct($pdo) {
        $this->pdo = $pdo;
    }

    public function required(string $field, $value, string $message = null) {
        if (empty($value)) {
            $this->errors[$field][] = $message ?? "Champ requis";
        }
    }

    public function email(string $field, $value) {
        if (!filter_var($value, FILTER_VALIDATE_EMAIL)) {
            $this->errors[$field][] = "Email invalide";
        }
    }

    public function phone(string $field, $value) {
        // Supprime les espaces au cas où l'utilisateur en aurait mis
        $caracters = [' ', '.', '-', '(', ')'];
        foreach ($caracters as $char) {
            $value = str_replace($char, '', $value);
        }
        
        // Vérifie si c'est composé de 9 chiffres exactement
        if (!preg_match('/^[0-9]{9}$/', $value)) {
            $this->errors[$field][] = "Le numéro doit contenir exactement 9 chiffres.";
        }
    }

    public function min(string $field, $value, int $length) {
        if (strlen($value) < $length) {
            $this->errors[$field][] = "Minimum {$length} caractères";
        }
    }

    public function unique(string $field, $value, string $table, $exceptId = null) {
        $sql = "SELECT COUNT(*) FROM $table WHERE $field = ?";
        $params = [$value];

        // Si on a un ID d'exception (cas de l'update)
        if ($exceptId) {
            $sql .= " AND id != ?";
            $params[] = $exceptId;
        }

        $stmt = $this->pdo->prepare($sql);
        $stmt->execute($params);
        $count = $stmt->fetchColumn();

        if ($count > 0) {
            $this->errors[$field][] = "Cette valeur est déjà utilisée.";
        }
    }


    // Vérifier la force du mot de passe
    public function password(string $field, $value) {
        // Minimum 8 caractères
        if (strlen($value) < 8) {
            $this->errors[$field][] = "Le mot de passe doit faire au moins 8 caractères.";
        }
        // Au moins une lettre et un chiffre
        if (!preg_match('/[A-Za-z]/', $value) || !preg_match('/[0-9]/', $value)) {
            $this->errors[$field][] = "Le mot de passe doit contenir au moins une lettre et un chiffre.";
        }
    }

    // Vérifie si deux champs sont identiques (ex: password et confirmation)
    public function password_confirm(string $field, $value, $confirmationValue) {
        if ($value !== $confirmationValue) {
            $this->errors[$field][] = "Les deux mots de passe ne correspondent pas.";
        }
    }

    public function image(string $field, $file) {
        // 1. Vérifier si le fichier a bien été uploadé sans erreur PHP
        if (!isset($file['tmp_name']) || $file['error'] !== UPLOAD_ERR_OK) {
            $this->errors[$field][] = "Erreur lors du téléchargement du fichier.";
            return;
        }

        // 2. Vérifier l'extension / Type MIME
        $allowedMimeTypes = ['image/jpeg', 'image/png', 'image/jpg', 'image/webp'];
        // Ouvrir une petite loupe pour inspecter le fichier
        $fileInfo = finfo_open(FILEINFO_MIME_TYPE);
        // Examiner le fichier temporaire pour voir son vrai type
        $mimeType = finfo_file($fileInfo, $file['tmp_name']);
        finfo_close($fileInfo);

        if (!in_array($mimeType, $allowedMimeTypes)) {
            $this->errors[$field][] = "Format invalide. Autorisés : PNG, JPG, JPEG, WEBP.";
        }

        // 3. Vérifier la taille (8Mo)
        $maxSize = 8 * 1024 * 1024; 
        if ($file['size'] > $maxSize) {
            $this->errors[$field][] = "L'image est trop lourde (max 1024 Mo).";
        }
    }

    public function getErrors() {
        return $this->errors;
    }

    public function isValid() {
        return empty($this->errors);
    }
}
