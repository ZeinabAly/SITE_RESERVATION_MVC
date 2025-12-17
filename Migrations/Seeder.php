<?php
namespace App\Migrations;
use App\Core\Database;

class Seeder {
    public static function run(): void {
        $db = Database::getInstance()->getConnection();

        // 1. USERS (Admin + Divers profils)
        $users = [
            ['Alice', 'alice@test.com', '0601020304', password_hash('password', PASSWORD_DEFAULT), 'user', 'user1.jpg'],
            ['Bob Admin', 'admin@skyreserve.com', '0600000000', password_hash('admin123', PASSWORD_DEFAULT), 'admin', 'admin.jpg'],
            ['Jean Voyage', 'jean@example.com', '0708091011', password_hash('password', PASSWORD_DEFAULT), 'user', null],
        ];
        $stmt = $db->prepare("INSERT INTO users (name, email, phone, password, role, image) VALUES (?, ?, ?, ?, ?, ?)");
        foreach ($users as $u) $stmt->execute($u);

        // 2. AIRPORTS (Expansion internationale)
        $airports = [
            ['CDG', 'Charles de Gaulle', 'Paris', 'France'],
            ['JFK', 'John F. Kennedy', 'New York', 'USA'],
            ['DXB', 'Dubai International', 'Dubai', 'UAE'],
            ['LHR', 'London Heathrow', 'London', 'UK'],
        ];
        $stmt = $db->prepare("INSERT INTO airports (code, name, city, country) VALUES (?, ?, ?, ?)");
        foreach ($airports as $a) $stmt->execute($a);

        // 3. AIRLINES
        $airlines = [
            ['Air France', 'AF', 'France', 'af_logo.png'],
            ['Emirates', 'EK', 'UAE', 'emirates_logo.png'],
            ['Delta', 'DL', 'USA', 'delta_logo.png'],
        ];
        $stmt = $db->prepare("INSERT INTO airlines (name, code, country, logo) VALUES (?, ?, ?, ?)");
        foreach ($airlines as $al) $stmt->execute($al);

        // 4. HOTELS (Différentes gammes)
        $hotels = [
            ['Le Bristol', 'Paris', '112 Rue du Faubourg Saint-Honoré', 5, 'Palace parisien emblématique.'],
            ['Ibis Budget', 'Paris', 'Place de Clichy', 2, 'Hôtel économique et pratique.'],
            ['Burj Al Arab', 'Dubai', 'Jumeirah Beach', 5, 'L’hôtel le plus luxueux au monde.'],
            ['The Standard', 'New York', 'High Line', 4, 'Hôtel branché avec vue sur Hudson.'],
        ];
        $stmt = $db->prepare("INSERT INTO hotels (name, city, address, stars, description) VALUES (?, ?, ?, ?, ?)");
        foreach ($hotels as $h) $stmt->execute($h);

        // 5. ROOMS (Lier aux hôtels insérés)
        $rooms = [
            [1, 'single', 2, 1200.00, 'Luxe absolu, 100m².'],
            [1, 'double', 2, 450.00, 'Confort et élégance.'],
            [2, 'single', 1, 65.00, 'Petit prix, grand confort.'],
            [3, 'double', 2, 5000.00, 'Dormez avec les poissons.'],
        ];
        $stmt = $db->prepare("INSERT INTO rooms (hotel_id, type, capacity, price_by_night, description) VALUES (?, ?, ?, ?, ?)");
        foreach ($rooms as $r) $stmt->execute($r);

        // 6. ACTIVITIES
        $activities = [
            ['Safari Désert', 'Dubai', 'aventure', '4x4 et dîner bédouin', 85.00, 360],
            ['Croisière Seine', 'Paris', 'romantique', 'Dîner aux chandelles sur l\'eau', 120.00, 180],
            ['Top of the Rock', 'New York', 'vue', 'Vue panoramique sur Manhattan', 40.00, 60],
        ];
        $stmt = $db->prepare("INSERT INTO activities (name, city, type, description, price, duration) VALUES (?, ?, ?, ?, ?, ?)");
        foreach ($activities as $act) $stmt->execute($act);

        // 7. IMAGES (Le lien avec les fichiers)
        $images = [
            ['hotel', 1, 'hotel1.png'],
            ['hotel', 1, 'hotel2.png'],
            ['hotel', 3, 'hotel3.png'],
            ['room', 4, 'chambre1.png'],
            ['room', 4, 'chambre2.png'],
            ['room', 4, 'chambre3.png'],
            ['activity', 1, 'safari1.jpg'],
            ['activity', 1, 'safari2.jpg'],
        ];
        $stmt = $db->prepare("INSERT INTO images (item_type, item_id, url) VALUES (?, ?, ?)");
        foreach ($images as $img) $stmt->execute($img);

        echo "\nSeeding terminé avec succès pour SkyReserve !";
    }
}