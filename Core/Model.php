<?php
namespace App\Core;

// CLASSE PARENT GERANT LES REQUETES PDO

use App\Core\Database;
use PDO;

abstract class Model {
    protected PDO $db;

    public function __construct(){
        $this->db = Database::getInstance()->getConnection();
    }

    public function getAll(string $table, $order = "ASC", $colOrder = "id"): array {
        $stmt = $this->db->prepare("SELECT * FROM {$table} ORDER BY {$colOrder} {$order}");
        $stmt->execute();
        return $stmt->fetchAll();
    }

    public function getById(string $table, int $id): ?array {
        $stmt = $this->db->prepare("SELECT * FROM {$table} WHERE id = :id");
        $stmt->bindParam(':id', $id, PDO::PARAM_INT);
        $stmt->execute();
        $result = $stmt->fetch();
        return $result ? $result : null;
    }

    public function create(string $table, array $data){
        $columns = implode(",", array_keys($data));
        $placeholders = ":" . implode(",:", array_keys($data));
        $stmt = $this->db->prepare("INSERT INTO {$table} ({$columns}) VALUES ({$placeholders})");
        foreach($data as $key => $value){
            $stmt->bindValue(":{$key}", $value);
        }
        return $stmt->execute();
    }

    
    public function updateById(string $table, int $id, array $data): bool {
        $setClause = "";
        foreach($data as $key => $value){
            $setClause .= "{$key} = :{$key}, ";
        }
        $setClause = rtrim($setClause, ", ");
        $stmt = $this->db->prepare("UPDATE {$table} SET {$setClause} WHERE id = :id");
        foreach($data as $key => $value){
            $stmt->bindValue(":{$key}", $value);
        }
        $stmt->bindParam(':id', $id, PDO::PARAM_INT);
        return $stmt->execute();
    }

    public function deleteById(string $table, int $id): bool {
        $stmt = $this->db->prepare("DELETE FROM {$table} WHERE id = :id");
        $stmt->bindParam(':id', $id, PDO::PARAM_INT);
        return $stmt->execute();
    }
}