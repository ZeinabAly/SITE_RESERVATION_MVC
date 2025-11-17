<?php

namespace App\Core;

class BluePrint {
    private string $table;
    private array $columns = [];

    public function __construct(string $table){
        $this->table = $table;
    }

    public function id(){
        $this->columns[] = "`id` INT PRIMARY key AUTO_INCREMENT";
    }

    public function string(string $name, int $length = 255){
        $this->columns[] = "`$name` VARCHAR($length)";
    }

    public function integer(string $name){
        $this->columns[] = "`$name` INT";
    }

    public function timestamps(){
        $this->columns[] = "`created_at` TIMESTAMP DEFAULT CURRENT_TIMESTAMP";
        $this->columns[] = "`updated_at` TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP";
        $this->columns[] = "`deleted_at` TIMESTAMP DEFAULT NULL";
    }

    public function buildCreateQuery(){
        $columns = implode(",", $this->columns);
        return "CREATE TABLE IF NOT EXISTS {$this->table } ($columns) ENGINE=INNODB;";
    }

}