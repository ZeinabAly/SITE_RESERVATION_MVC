<?php
namespace App\Core;

class BluePrint {
    private string $table;
    private array $columns = [];
    private array $foreignKeys = [];

    public function __construct(string $table){
        $this->table = $table;
    }

    public function id(){
        $this->columns[] = "`id` INT PRIMARY key AUTO_INCREMENT";
    }

    public function string(string $name, string $nullable = "NOT NULL", int $length = 255){
        $this->columns[] = "`$name` VARCHAR($length) $nullable";
    }

    public function text(string $name, string $nullable = "NOT NULL"){
        $this->columns[] = "`$name` TEXT $nullable";
    }

    public function date(string $name, string $nullable = "NOT NULL"){
        $this->columns[] = "`$name` DATE $nullable";
    }

    public function datetime(string $name, string $nullable = "NOT NULL"){
        $this->columns[] = "`$name` DATETIME DEFAULT CURRENT_TIMESTAMP $nullable";
    }

    public function enum(string $name, array $values, string $default = ""){
        $quoted = array_map(fn($v) => "'$v'", $values);
        $this->columns[] = "`$name` ENUM(" . implode(",", $quoted) . ") $nullable";
    }

    public function integer(string $name, string $nullable = "NOT NULL"){
        $this->columns[] = "`$name` INT $nullable";
    }

    public function foreignId(string $name, string $refTable, string $nullable = "NOT NULL"){ 
        $this->columns[] = "`$name` INT UNSIGNED";
        $this->foreignKeys[] = "FOREIGN KEY (`$name`) REFERENCES `$refTable`(`id`)";
    }



    public function timestamps(){
        $this->columns[] = "`created_at` TIMESTAMP DEFAULT CURRENT_TIMESTAMP";
        $this->columns[] = "`updated_at` TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP";
        $this->columns[] = "`deleted_at` TIMESTAMP DEFAULT NULL";
    }

    public function buildCreateQuery(){
        $columns = implode(",", $this->columns);
        $sql = "
            CREATE TABLE IF NOT EXISTS {$this->table } 
            (\n $columns ";

        if (!empty($this->foreignKeys)) {
            $sql .= ",\n  " . implode(",\n  ", $this->foreignKeys);
        }

        $sql .= "\n) ENGINE=InnoDB;";

        return $sql;
    }

}