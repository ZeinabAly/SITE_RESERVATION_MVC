<?php

namespace App\Controllers;
use App\Core\Model;
use App\Validators\UserValidator;

class AuthController extends Model {

    public function render($view, $data = []) {
        // Extraire les variables (par ex. $title)
        extract($data);

        // Inclure directement le layout, qui lui-même inclura la vue
        include "views/layouts/app.php";
    }

    public function login() {
        return $this->render('login', ['title' => 'Login']);
    }

    public function handleLogin() {
        if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
            return $this->login(); 
        }

        $email = $_POST['email'] ?? '';
        $password = $_POST['password'] ?? '';

        
        $user = $this->getByEmail('users', $email); 

        if ($user && password_verify($password, $user['password'])) {
            // AUTHENTIFICATION RÉUSSIE
            if (session_status() === PHP_SESSION_NONE) session_start();
            
            $_SESSION['user'] = [
                'id' => $user['id'],
                'name' => $user['name'],
                'email' => $user['email']
            ];

            header('Location: /home');
            exit;
        } else {
            
            return $this->render('login', [
                'title' => 'Connexion',
                'error' => 'Email ou mot de passe incorrect',
                'old_email' => $email 
            ]);
        }
    }

    public function register() {
        return $this->render('register', ['title' => 'Registrer', 
                                            'errors' => [], 
                                            'old' => []]);
    }

    public function handleRegister() {
        if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
            return $this->register(); 
        }
        $data = $_POST;
        $validator = new UserValidator();

        if ($validator->store($data)) {
            unset($data['csrf_token']);
            unset($data['password_confirm']);
            $data['password'] = password_hash($data['password'], PASSWORD_DEFAULT);
            $this->create('users', $data);
            header('Location: /home');
            exit;
        }else{
            return $this->render('register', [
                'title' => 'Inscription',
                'errors' => $validator->getErrors(), 
                'old' => $data 
            ]);
        }

    }
}
