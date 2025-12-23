<?php
namespace App\Controllers;

use App\Core\Model;
use Exception;

class AdminController extends Model {

    public function index(string $table): array {
        return $this->getAll($table, 'DESC');
    }

    public function show(string $table, int $id): ?array {
        return $this->getById($table, $id);
    }

    public function store(string $table, array $data): void {
        // $this->validate($table, $data);
        $this->create($table, $data);
    }

    public function update(string $table, int $id, array $data): void {
        // $this->validate($table, $data, false);
        $this->updateById($table, $id, $data);
    }

    public function destroy(string $table, int $id): void {
        $this->deleteById($table, $id);
    }
    
}
