<?php
namespace App\Migrations;

use App\Core\Schema;

class create_airports_table{
    public function up()
    {
        Schema::create('airports', function ($table) {
            $table->id();
            $table->string('name');
            $table->string('city');
            $table->string('country');
            $table->string('code', 5); // CDG, JFK
            $table->timestamps();
        });
    }
}
