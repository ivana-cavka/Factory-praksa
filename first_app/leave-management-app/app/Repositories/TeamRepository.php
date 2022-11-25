<?php

namespace App\Repositories;

use App\Interfaces\TeamRepositoryInterface;
use App\Models\Team;

class TeamRepository implements TeamRepositoryInterface 
{
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

    public function getTeamMembers($id) {
        //$teamMembers = User::where('role','member' and 'teamId', $team->id)->get();
    }

}