<?php
namespace App\Migrations;

use App\Core\Schema;

class create_users_table{
    public function up()
    {
        Schema::create('users', function($table)
        {
            $table->id();
            $table->string('name');
            $table->string('email')->unique();
            $table->string('password');
            $table->string('phone', nullable: "NULL");
            $table->enum('role', values: ['user', 'admin'], default: "user");
            $table->timestamps();
        });
    }
}
