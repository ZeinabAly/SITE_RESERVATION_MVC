<?php

require __DIR__ . '/config/config.php';
require __DIR__ . '/Core/Autoloader.php';
\App\Core\Autoloader::register();
use App\Migrations\Seeder;
// require __DIR__ . "/Migrations/Seeder.php";

Seeder::run();