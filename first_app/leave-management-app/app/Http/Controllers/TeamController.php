<?php

namespace App\Http\Controllers;

use App\Models\Team;
use Illuminate\Http\Request;

class TeamController extends Controller
{
    public function getAllTeams(Request $request) {
        $teams = Team::paginate(8);
        return view('teams', ['teams' => $teams]);
    }
}