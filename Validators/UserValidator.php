<?php
namespace App\Validators;

use App\Core\Validator;
use App\Core\Database;
use PDO;

class UserValidator extends Validator {

    public function store(array $data): bool {
        $this->required('name', $data['name']);
        $this->min('name', $data['name'], 3);

        $this->required('email', $data['email']);
        $this->unique('email', $data['email'], 'users');
        $this->email('email', $data['email']);
        
        $this->phone('phone', $data['phone']);
        $this->required('phone', $data['phone']);
        $this->unique('phone', $data['phone'], 'users');
        
        // if (isset($files['image'])){
        //     $this->image('image', $files['image']);
        // }

        $this->password('password', $data['password']);
        $this->password_confirm('password_confirm', $data['password_confirm'], $data['password']);

        return $this->isValid();
    }

    public function update(int $id, array $data): bool {
        if (isset($data['email'])) {
            $this->required('email', $data['email']);
            $this->unique('email', $data['email'], 'users', $id);
            $this->email('email', $data['email']);
        }
        if (isset($data['phone'])) {
            $this->required('phone', $data['phone']);
            $this->unique('phone', $data['phone'], 'users', $id);
            $this->phone('phone', $data['phone']);
        }
        if (isset($data['name'])) {
            $this->required('name', $data['name']);
            $this->min('name', $data['name'], 3);
        }

        return $this->isValid();
    }
}
