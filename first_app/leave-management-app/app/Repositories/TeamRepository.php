<?php

namespace App\Repositories;

use App\Interfaces\TeamRepositoryInterface;
use App\Interfaces\UserRepositoryInterface;
use App\Models\Team;

class TeamRepository implements TeamRepositoryInterface 
{
    private UserRepositoryInterface $userRepository;

    public function getAllTeams() {
        return Team::all();
    }

    public function getTeamById($id) {
        return Team::findOrFail($id);
    }

    public function deleteTeam($id) {
        Team::destroy($id);
    }

    public function saveTeam($new) {
        $new->save();
    }

    public function updateTeam($id, array $newDetails) {
        return Team::whereId($id)->update($newDetails);
    }

}