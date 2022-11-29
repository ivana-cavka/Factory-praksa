<?php

namespace App\Interfaces;

interface UserRepositoryInterface 
{
    public function getAllUsers();
    public function getUserById($id);
    public function deleteUser($id);
    public function saveUser($new);
    public function updateUser($id, array $newDetails);
    public function getUsersByRole(string $role);
    public function getTeamMembers($teamId);
    public function getTeamLead($teamId);
    public function getProjectMembers($projectId);
    public function getProjectLead($projectId);
}