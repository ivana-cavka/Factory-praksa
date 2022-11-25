<?php

namespace App\Repositories;

use App\Interfaces\UserRepositoryInterface;
use App\Models\User;

class UserRepository implements UserRepositoryInterface 
{
    public function getAllUsers() {
        return User::all();
    }

    public function getUserById($id) {
        return User::findOrFail($id);
    }

    public function deleteUser($id) {
        User::destroy($id);
    }

    public function saveUser($new) {
        $new->save();
    }
    
    public function updateUser($id, array $newDetails) {
        return User::whereId($id)->update($newDetails);
    }

    public function getUsersByRole(string $role) {
        return User::where('role', $role);
    }

}