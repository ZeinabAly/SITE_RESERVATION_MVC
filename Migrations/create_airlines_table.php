<?php
namespace App\Migrations;

use App\Core\Schema;

class create_airlines_table{
    public function up()
    {
        Schema::create('airlines', function ($table) {
            $table->id();
            $table->string('name');
            $table->string('logo', nullable: 'NULL');
            $table->timestamps();
        });
    }
}
