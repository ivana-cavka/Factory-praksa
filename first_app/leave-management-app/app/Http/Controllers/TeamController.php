<?php

namespace App\Http\Controllers;

use App\Models\Team;
use App\Interfaces\TeamRepositoryInterface;
use Illuminate\Http\Request;

class TeamController extends Controller
{
    private TeamRepositoryInterface $teamRepository;

    public function getAllTeams(Request $request) {
        $teams = $this->teamRepository->getAllTeams();
        return view('teams', ['teams' => $teams]);
    }

    public function saveTeam(Request $request) {
        $team = new Team;
        $team->title = $request->title;
        $this->teamRepository->saveTeam($team);
        return redirect('admin')->with('status', 'New Team Has Been inserted');
    }
}