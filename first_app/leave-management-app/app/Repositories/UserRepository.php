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
        return User::where('role', $role)->get();
    }

    public function getTeamMembers($teamId) {
        return User::where([['role','member'],['teamId', $teamId]])->orWhere([['role','project lead'],['teamId', $teamId]])->get();
    }

    public function getTeamLead($teamId) {
        return User::where('teamId', $teamId and 'role','team lead')->first();
    }

    public function getProjectMembers($projectId) {
        return User::where([['role','member'],['projectId', $projectId]])->orWhere([['role','team lead'],['projectId', $projectId]])->get();
    }

    public function getProjectLead($projectId) {
        return User::where('projectId', $projectId and 'role','project lead')->first();
    }
}