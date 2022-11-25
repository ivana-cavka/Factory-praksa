<?php

namespace App\Interfaces;

interface TeamRepositoryInterface 
{
    public function getAllTeams();
    public function getTeamById($id);
    public function deleteTeam($id);
    public function saveTeam($newTeam);
    public function updateTeam($id, array $newDetails);
}