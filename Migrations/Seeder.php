<?php
namespace App\Migrations;
use App\Core\Database;

class Seeder{

    public static function run(): void{

        $db = Database::getInstance()->getConnection();

        // ---------------------- USERS ----------------------
        $users = [
            ['name' => 'Alice', 'email' => 'alice@example.com', 'phone' => '623873627', 'password' => password_hash('password', PASSWORD_DEFAULT), 'role' => 'user', 'image' => null],
            ['name' => 'Bob', 'email' => 'bob@example.com', 'phone' => '625875627', 'password' => password_hash('password', PASSWORD_DEFAULT), 'role' => 'admin', 'image' => null],
        ];

        foreach ($users as $u) {
            $stmt = $db->prepare("INSERT INTO users (name, email, password, phone, role, image) VALUES (?, ?, ?, ?, ?, ?)");
            $stmt->execute([$u['name'], $u['email'], $u['password'], $u['phone'], $u['role'] ,$u['image']]);
        }


        // ---------------------- AIRPORTS ----------------------
        $airports = [
            ['code' => 'CDG', 'name' => 'Charles de Gaulle', 'city' => 'Paris', 'country' => 'France'],
            ['code' => 'JFK', 'name' => 'John F. Kennedy', 'city' => 'New York', 'country' => 'USA'],
        ];

        foreach ($airports as $a) {
            $stmt = $db->prepare("INSERT INTO airports (code, name, city, country) VALUES (?, ?, ?, ?)");
            $stmt->execute([$a['code'], $a['name'], $a['city'], $a['country']]);
        }


        // ---------------------- AIRLINES ----------------------
        $airlines = [
            ['name' => 'Air France', 'code' => 'AF', 'country' => 'France', 'logo' => null],
            ['name' => 'Delta Airlines', 'code' => 'DL', 'country' => 'USA', 'logo' => null],
        ];

        foreach ($airlines as $al) {
            $stmt = $db->prepare("INSERT INTO airlines (name, code, country, logo) VALUES (?, ?, ?, ?)");
            $stmt->execute([$al['name'], $al['code'], $al['country'], $al['logo']]);
        }


        // ---------------------- FLIGHTS ----------------------
        $flights = [
            [
                'airline_id' => 1,
                'departure_airport_id' => 1,
                'arrival_airport_id' => 2,
                'departure_time' => '2025-12-10 10:00:00',
                'arrival_time' => '2025-12-10 13:00:00',
                'price' => 350.00
            ],
        ];

        foreach ($flights as $f) {
            $stmt = $db->prepare(
                "INSERT INTO flights (airline_id, departure_airport_id, arrival_airport_id, departure_time, arrival_time, price)
                 VALUES (?, ?, ?, ?, ?, ?)"
            );
            $stmt->execute([
                $f['airline_id'], $f['departure_airport_id'], $f['arrival_airport_id'],
                $f['departure_time'], $f['arrival_time'], $f['price']
            ]);
        }


        // ---------------------- HOTELS ----------------------
        $hotels = [
            ['name' => 'Hotel Paris 1', 'city' => 'Paris', 'address' => '12 Rue de Rivoli', 'stars' => 4, 'description' => 'Un bel hôtel au centre de Paris'],
        ];

        foreach ($hotels as $h) {
            $stmt = $db->prepare("INSERT INTO hotels (name, city, address, stars, description) VALUES (?, ?, ?, ?, ?)");
            $stmt->execute([$h['name'], $h['city'], $h['address'], $h['stars'], $h['description']]);
        }


        // ---------------------- ROOMS ----------------------
        $rooms = [
            ['hotel_id' => 1, 'type' => 'single', 'capacity' => 1, 'price_by_night' => 80.00, 'description' => 'Chambre simple confortable'],
            ['hotel_id' => 1, 'type' => 'double', 'capacity' => 2, 'price_by_night' => 120.00, 'description' => 'Chambre double avec vue'],
        ];

        foreach ($rooms as $r) {
            $stmt = $db->prepare("INSERT INTO rooms (hotel_id, type, capacity, price_by_night, description) VALUES (?, ?, ?, ?, ?)");
            $stmt->execute([$r['hotel_id'], $r['type'], $r['capacity'], $r['price_by_night'], $r['description']]);
        }


        // ---------------------- ACTIVITIES ----------------------
        $activities = [
            ['name' => 'Tour Eiffel Visite', 'city' => 'Paris', 'type' => 'visite', 'description' => 'Visite guidée de la Tour Eiffel', 'price' => 30.00, 'duration' => 120],
            ['name' => 'Musée du Louvre', 'city' => 'Paris', 'type' => 'culture', 'description' => 'Billet coupe-file', 'price' => 20.00, 'duration' => 90],
        ];

        foreach ($activities as $a) {
            $stmt = $db->prepare("INSERT INTO activities (name, city, type, description, price, duration) VALUES (?, ?, ?, ?, ?, ?)");
            $stmt->execute([$a['name'], $a['city'], $a['type'], $a['description'], $a['price'], $a['duration']]);
        }


        // ---------------------- CALENDAR ----------------------
        $calendar = [
            ['item_type' => 'room', 'item_id' => 1, 'date' => '2025-12-15', 'available' => 1],
            ['item_type' => 'activity', 'item_id' => 1, 'date' => '2025-12-15', 'available' => 1],
        ];

        foreach ($calendar as $c) {
            $stmt = $db->prepare("INSERT INTO calendar (item_type, item_id, date, available) VALUES (?, ?, ?, ?)");
            $stmt->execute([$c['item_type'], $c['item_id'], $c['date'], $c['available']]);
        }


        // ---------------------- RESERVATIONS ----------------------
        $reservations = [
            ['user_id' => 1, 'type' => 'room', 'item_id' => 1, 'start_date' => '2025-12-15', 'end_date' => '2025-12-17', 'total_price' => 160.00, 'status' => 'pending'],
        ];

        foreach ($reservations as $r) {
            $stmt = $db->prepare("INSERT INTO reservations (user_id, type, item_id, start_date, end_date, total_price, status) VALUES (?, ?, ?, ?, ?, ?, ?)");
            $stmt->execute([$r['user_id'], $r['type'], $r['item_id'], $r['start_date'], $r['end_date'], $r['total_price'], $r['status']]);
        }


        // ---------------------- TRANSACTIONS ----------------------
        $transactions = [
            ['reservation_id' => 1, 'amount' => 160.00, 'devise' => 'EUR', 'status' => 'pending'],
        ];

        foreach ($transactions as $t) {
            $stmt = $db->prepare("INSERT INTO transactions (reservation_id, amount, devise, status) VALUES (?, ?, ?, ?)");
            $stmt->execute([$t['reservation_id'], $t['amount'], $t['devise'], $t['status']]);
        }


        // ---------------------- PAYMENTS ----------------------
        $payments = [
            ['transaction_id' => 1, 'provider' => 'stripe', 'provider_transaction_id' => 'txn_123456'],
        ];

        foreach ($payments as $p) {
            $stmt = $db->prepare("INSERT INTO payments (transaction_id, provider, provider_transaction_id) VALUES (?, ?, ?)");
            $stmt->execute([$p['transaction_id'], $p['provider'], $p['provider_transaction_id']]);
        }


        // ---------------------- REVIEWS ----------------------
        $reviews = [
            ['user_id' => 1, 'item_type' => 'hotel', 'item_id' => 1, 'rating' => 5, 'comment' => 'Super hôtel !'],
        ];

        foreach ($reviews as $rev) {
            $stmt = $db->prepare("INSERT INTO reviews (user_id, item_type, item_id, rating, comment) VALUES (?, ?, ?, ?, ?)");
            $stmt->execute([$rev['user_id'], $rev['item_type'], $rev['item_id'], $rev['rating'], $rev['comment']]);
        }


        // ---------------------- IMAGES ----------------------
        $images = [
            ['item_type' => 'hotel', 'item_id' => 1, 'url' => 'hotel1.jpg'],
            ['item_type' => 'room', 'item_id' => 1, 'url' => 'room1.jpg'],
        ];

        foreach ($images as $img) {
            $stmt = $db->prepare("INSERT INTO images (item_type, item_id, url) VALUES (?, ?, ?)");
            $stmt->execute([$img['item_type'], $img['item_id'], $img['url']]);
        }


        echo "\n Seed terminé !\n";
    }
}
