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

$data = json_decode(file_get_contents('php://input'), true);

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

            if ($validator && !$validator->store($data)) {
                http_response_code(422);
                echo json_encode(['errors' => $validator->getErrors()]);
                exit;
            }

            if (isset($data['password_confirm'])) {
                unset($data['password_confirm']);
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
