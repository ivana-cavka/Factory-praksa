<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;

class AdminController extends Controller
{
    public function getAdminData(Request $request) {
        $regularEmployees = User::where('role','member');
        $admins = User::where('role','admin')->get();
        $teamLeads = User::where('role','team lead');
        $projectLeads = User::where('role','project lead');
        return view('admin_page', ['admins' => $admins, 'regulars' => $regularEmployees, 'prLeads' => $projectLeads, 'tmLeads' => $teamLeads]);
    }
}