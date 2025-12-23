<?php

namespace App\Controllers\Admin;

use App\Core\Model;
class AdminDashController extends Model {

    public function render($view, $data = []) {
        // Extraire les variables (par ex. $title)
        extract($data);

        // Inclure directement le layout, qui lui-même inclura la vue
        include_once "views/layouts/admin.php";
    }

    public function index() {
        $users = $this->getAll('users');
        $countVols = count($this->getAll('flights'));
        $countReservations = count($this->getAll('reservations'));
        $countHotels = count($this->getAll('hotels'));
        $countRooms = count($this->getAll('rooms'));

        return $this->render('dashboard', [
            'title' => 'Admin Dashboard',
            'users' => $users,
            'countVols' => $countVols,
            'countResers' => $countReservations,
            'countRooms' => $countRooms,
            'countHotels' => $countHotels,
        ]);
    }

}
