<?php

require_once __DIR__ . '/../Core/Autoloader.php';

use App\Core\Autoloader;
use App\Controllers\AdminController;
use App\Core\Database;

Autoloader::register();

header('Content-Type: application/json');

$controller = new AdminController();

$allowedTables = [
    'users', 'airports', 'airlines', 'flights', 'hotels',
    'rooms', 'activities', 'reservations', 'transactions',
    'payments', 'reviews', 'images'
];

$table  = $_GET['table']  ?? null;
$action = $_GET['action'] ?? null;
$id     = $_GET['id']     ?? null;

if (!$table || !$action || !in_array($table, $allowedTables)) {
    http_response_code(403);
    echo json_encode(['error' => 'Requête invalide']);
    exit;
}

// ==================== GÉRER LES DONNÉES ====================
$contentType = $_SERVER['CONTENT_TYPE'] ?? '';

if (strpos($contentType, 'application/json') !== false) {
    // Données JSON
    $data = json_decode(file_get_contents('php://input'), true);
} else {
    // Données FormData
    $data = $_POST;
}

// TRAITER LES FICHIERS UPLOADÉS **AVANT** LA VALIDATION
// if (!empty($_FILES)) {
//     foreach ($_FILES as $fieldName => $file) {
//         if ($file['error'] === UPLOAD_ERR_OK) {
//             // Créer le dossier uploads s'il n'existe pas
//             $uploadDir = __DIR__ . '/../uploads/';
//             if (!is_dir($uploadDir)) {
//                 mkdir($uploadDir, 0777, true);
//             }
            
//             // Générer un nom de fichier unique
//             $extension = pathinfo($file['name'], PATHINFO_EXTENSION);
//             $filename = uniqid() . '_' . time() . '.' . $extension;
//             $targetPath = $uploadDir . $filename;
            
//             // Déplacer le fichier uploadé
//             if (move_uploaded_file($file['tmp_name'], $targetPath)) {
//                 // ⭐ Stocker le chemin dans $data pour la validation
//                 $data[$fieldName] = 'uploads/' . $filename;
//             } else {
//                 http_response_code(422);
//                 echo json_encode(['errors' => [$fieldName => ['Erreur lors du téléchargement du fichier.']]]);
//                 exit;
//             }
//         } elseif ($file['error'] === UPLOAD_ERR_NO_FILE) {
//             // Pas de fichier uploadé, ne rien faire
//             // (utile pour les champs optionnels)
//         } else {
//             // Autre erreur d'upload
//             $uploadErrors = [
//                 UPLOAD_ERR_INI_SIZE => 'Le fichier dépasse la taille maximale autorisée.',
//                 UPLOAD_ERR_FORM_SIZE => 'Le fichier dépasse la taille maximale du formulaire.',
//                 UPLOAD_ERR_PARTIAL => 'Le fichier n\'a été que partiellement téléchargé.',
//                 UPLOAD_ERR_NO_TMP_DIR => 'Dossier temporaire manquant.',
//                 UPLOAD_ERR_CANT_WRITE => 'Échec de l\'écriture du fichier sur le disque.',
//                 UPLOAD_ERR_EXTENSION => 'Une extension PHP a arrêté l\'upload du fichier.',
//             ];
            
//             $errorMessage = $uploadErrors[$file['error']] ?? 'Erreur inconnue lors du téléchargement.';
            
//             http_response_code(422);
//             echo json_encode(['errors' => [$fieldName => [$errorMessage]]]);
//             exit;
//         }
//     }
// }

function resolveValidator(string $table, $pdo)
{
    $class = 'App\\Validators\\' . ucfirst(rtrim($table, 's')) . 'Validator';

    if (class_exists($class)) {
        return new $class($pdo);
    }

    return null;
}

try {
    switch ($action) {
        case 'index':
            echo json_encode($controller->index($table));
            break;

        case 'show':
            echo json_encode($controller->show($table, (int)$id));
            break;

        case 'store':
            $pdo = Database::getInstance()->getConnection();
            $validator = resolveValidator($table, $pdo);

            //Maintenant $data contient déjà le chemin du fichier uploadé
            if ($validator && !$validator->store($data)) {
                http_response_code(422);
                echo json_encode(['errors' => $validator->getErrors()]);
                exit;
            }

            
            if (!empty($_FILES)) {
                foreach ($_FILES as $fieldName => $file) {
                    if ($file['error'] === UPLOAD_ERR_OK) {
                        $uploadDir = __DIR__ . '/../uploads/';
                        if (!is_dir($uploadDir)) {
                            mkdir($uploadDir, 0777, true);
                        }
                        
                        $extension = pathinfo($file['name'], PATHINFO_EXTENSION);
                        $filename = uniqid() . '_' . time() . '.' . $extension;
                        $targetPath = $uploadDir . $filename;
                        
                        if (move_uploaded_file($file['tmp_name'], $targetPath)) {
                            $data[$fieldName] = 'uploads/' . $filename;
                        } else {
                            http_response_code(422);
                            echo json_encode(['errors' => [$fieldName => ['Erreur lors du déplacement du fichier.']]]);
                            exit;
                        }
                    }
                }
            }

            if (isset($data['password_confirm'])) {
                unset($data['password_confirm']);
            }

            if (!empty($data['password'])) {
                $data['password'] = password_hash($data['password'], PASSWORD_DEFAULT);
            }

            $controller->store($table, $data);
        
            echo json_encode(['success' => true]);
            break;

        case 'update':
            $pdo = Database::getInstance()->getConnection();
            $validator = resolveValidator($table, $pdo);

            if ($validator && !$validator->update((int)$id, $data)) {
                http_response_code(422);
                echo json_encode(['errors' => $validator->getErrors()]);
                exit;
            }

            $controller->update($table, (int)$id, $data);
            echo json_encode(['success' => true]);
            break;

        case 'delete':
            $controller->destroy($table, (int)$id);
            echo json_encode(['success' => true]);
            break;

        default:
            throw new Exception('Action invalide');
    }

} catch (Throwable $e) {
    http_response_code(500);
    echo json_encode([
        'error' => $e->getMessage()
    ]);
}