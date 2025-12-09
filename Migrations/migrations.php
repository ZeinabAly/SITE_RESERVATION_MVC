<?php
namespace App\Migrations;
use App\Core\Schema;


// SUPPRIMER TOUTES LES TABLES

Schema::drop('users');
Schema::drop('airports');
Schema::drop('airlines');
Schema::drop('flights');
Schema::drop('hotels');
Schema::drop('rooms');
Schema::drop('activities');
Schema::drop('calendar');
Schema::drop('reservations');
Schema::drop('transactions');
Schema::drop('payments');
Schema::drop('reviews');
Schema::drop('images');


// USERS
Schema::create("users", "
    id INT AUTO_INCREMENT PRIMARY KEY,
    name VARCHAR(255) NOT NULL,
    email VARCHAR(255) UNIQUE NOT NULL,
    phone VARCHAR(9) UNIQUE NOT NULL,
    password VARCHAR(255) NOT NULL,
    role ENUM('user', 'admin') DEFAULT 'user',
    image VARCHAR(150) NULL
");


// AIRPORTS
Schema::create("airports", "
    id INT AUTO_INCREMENT PRIMARY KEY,
    code VARCHAR(10) UNIQUE NOT NULL,
    name VARCHAR(255) NOT NULL,
    city VARCHAR(255) NOT NULL,
    country VARCHAR(255) NOT NULL
");

Schema::create("airlines", "
    id INT AUTO_INCREMENT PRIMARY KEY,
    name VARCHAR(255) NOT NULL,
    code VARCHAR(10) UNIQUE NOT NULL,  -- AF, TK, EK, BA...
    country VARCHAR(100),
    logo VARCHAR(255) NULL
");


// FLIGHTS
Schema::create("flights", "
    id INT AUTO_INCREMENT PRIMARY KEY,
    airline_id INT NOT NULL,
    departure_airport_id INT NOT NULL,
    arrival_airport_id INT NOT NULL,
    departure_time DATETIME NOT NULL,
    arrival_time DATETIME NOT NULL,
    price DECIMAL(10,2) NOT NULL,

    FOREIGN KEY (departure_airport_id) REFERENCES airports(id) ON DELETE CASCADE,
    FOREIGN KEY (arrival_airport_id) REFERENCES airports(id) ON DELETE CASCADE,
    FOREIGN KEY (airline_id) REFERENCES airlines(id) ON DELETE CASCADE
");


// HOTELS
Schema::create("hotels", "
    id INT AUTO_INCREMENT PRIMARY KEY,
    name VARCHAR(255) NOT NULL,
    city VARCHAR(255) NOT NULL,
    address VARCHAR(255),
    stars INT DEFAULT 0,
    description TEXT
");


// ROOMS
Schema::create("rooms", "
    id INT AUTO_INCREMENT PRIMARY KEY,
    hotel_id INT NOT NULL,
    type ENUM('single', 'double', 'suite'),
    capacity INT NOT NULL,
    price_by_night DECIMAL(10,2) NOT NULL,
    description TEXT NULL,

    FOREIGN KEY (hotel_id) REFERENCES hotels(id) ON DELETE CASCADE
");


// ACTIVITIES
Schema::create("activities", "
    id INT AUTO_INCREMENT PRIMARY KEY,
    name VARCHAR(255) NOT NULL,
    city VARCHAR(255) NOT NULL,
    type VARCHAR(100),
    description TEXT NULL,
    price DECIMAL(10,2) NOT NULL,
    duration INT NULL
");


// CALENDAR (un système flexible : item_type + item_id) pour gérer les disponibilités
Schema::create("calendar", "
    id INT AUTO_INCREMENT PRIMARY KEY,
    item_type ENUM('flight', 'room', 'activity') NOT NULL,
    item_id INT NOT NULL,
    date DATE NOT NULL,
    available INT DEFAULT 1
");


// RESERVATIONS
Schema::create("reservations", "
    id INT AUTO_INCREMENT PRIMARY KEY,
    user_id INT NOT NULL,
    type ENUM('flight', 'room', 'activity') NOT NULL,
    item_id INT NOT NULL,
    start_date DATE,
    end_date DATE,
    total_price DECIMAL(10,2) NOT NULL,
    status ENUM('pending', 'paid', 'cancelled') DEFAULT 'pending',

    FOREIGN KEY (user_id) REFERENCES users(id) ON DELETE CASCADE
");


// TRANSACTIONS : se declenche dès que la réservation s'engage
Schema::create("transactions", "
    id INT AUTO_INCREMENT PRIMARY KEY,
    reservation_id INT NOT NULL,
    amount DECIMAL(10,2) NOT NULL,
    devise VARCHAR(50) NOT NULL,
    status ENUM('pending', 'success', 'failed') DEFAULT 'pending',

    FOREIGN KEY (reservation_id) REFERENCES reservations(id) ON DELETE CASCADE
");


// PAYMENTS
// PROVIDERS (stripe, paypal, orange_money, ...)
// provider_transaction_id: l’identifiant renvoyé par le provider (ex: ch_1Q7fdJDzeGHZ90)
Schema::create("payments", "
    id INT AUTO_INCREMENT PRIMARY KEY,
    transaction_id INT NOT NULL,
    provider VARCHAR(50) NOT NULL,
    provider_transaction_id VARCHAR(255),

    FOREIGN KEY (transaction_id) REFERENCES transactions(id) ON DELETE CASCADE
");


// REVIEWS
Schema::create("reviews", "
    id INT AUTO_INCREMENT PRIMARY KEY,
    user_id INT NOT NULL,
    item_type ENUM('hotel', 'room', 'flight', 'airport', 'activity') NOT NULL,
    item_id INT NOT NULL,
    rating INT CHECK (rating >= 1 AND rating <= 5),
    comment TEXT,

    FOREIGN KEY (user_id) REFERENCES users(id) ON DELETE CASCADE
");


// IMAGES
Schema::create("images", "
    id INT AUTO_INCREMENT PRIMARY KEY,
    item_type ENUM('hotel', 'flight', 'airport', 'room', 'activity') NOT NULL,
    url VARCHAR(255) NOT NULL,
    item_id INT NOT NULL
");
