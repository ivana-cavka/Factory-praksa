<?php

namespace App\Http\Controllers;

use App\Models\Project;
use App\Models\User;
use App\Models\Inquiry;
use App\Models\Team;
use Illuminate\Http\Request;

class AdminController extends Controller
{
    public function getAdminData(Request $request) {
        $regularEmployees = User::where('role','member')->get();
        $admins = User::where('role','admin')->get();
        $teamLeads = User::where('role','team lead')->get();
        $projectLeads = User::where('role','project lead')->get();
        $projects = Project::all();
        $teams = Team::all();
        $inquiries = Inquiry::all()->sortBy('startDate');
        return view('admin_page', ['admins' => $admins, 
                                    'regulars' => $regularEmployees, 
                                    'prLeads' => $projectLeads, 
                                    'tmLeads' => $teamLeads,
                                    'projects' => $projects,
                                    'teams' => $teams,
                                    'inquiries' => $inquiries]);
    }
}