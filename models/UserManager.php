<?php

namespace App\Models;

class User {
    private $conn;

    public function __construct(){
        $this->conn = Database::getInstance();
    }

    public function getAll(){
        $smt = $this->conn->getConnection()->prepare("SELECT * FROM users");
        $smt->execute();
        return $smt->fetchAll(PDO::FETCH_ASSOC);
    }
}