<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Inquiry;
use App\Models\Project;
use App\Models\Team;
use Illuminate\Http\Request;
use App\Interfaces\UserRepositoryInterface;
use App\Interfaces\ProjectRepositoryInterface;
use App\Interfaces\TeamRepositoryInterface;
use App\Interfaces\InquiryRepositoryInterface;

class UserController extends Controller
{
    private UserRepositoryInterface $userRepository;
    private TeamRepositoryInterface $teamRepository;
    private ProjectRepositoryInterface $projectRepository;
    private InquiryRepositoryInterface $inquiryRepository;

    public function getAllUsers(Request $request) {
        $users = $this->userRepository->getAllUsers();
        //dd($users[0]->name); //dump and die
        return view('users', ['users' => $users]);
    }

    public function saveUser(Request $request) {
        $user = new User;
        $user->name = $request->name;
        $user->email = $request->email;
        $user->password = $request->password;
        $user->role = $request->role;
        $user->projectId = $request->projectId;
        $user->teamId = $request->teamId;
        $user->maxLeaveDays = $user->leaveDaysLeft = $request->maxLeaveDays;
        $this->userRepository->saveUser($user);
        return redirect('admin')->with('status', 'New Employee Has Been inserted');
    }

    public function getUserData(Request $request, $id) {
        //$user = Auth::user();
        $user = $this->userRepository->getUserById($id);
        $project = $this->projectRepository->getProjectById($user->projectId);
        $team = $this->teamRepository->getTeamById($user->teamId);
        $inquiries = $this->inquiryRepository->getInquiriesByEmployee($id);
        $teamMembers = $projectMembers = $inquiriesByProjectMembers = $inquiriesByTeamMembers = null;
        if ($user->role == 'team lead') {
            $teamMembers = User::where('role','member' and 'teamId', $team->id)->get();
            foreach ($teamMembers as $member) {
                $inquiriesByTeamMembers[$member->id] = Inquiry::where('employeeId', $member->id)->get();
            }
        } elseif ($user->role == 'project lead') {
            $projectMembers = User::where('role','member' and 'projectId', $project->id)->get();
            foreach ($projectMembers as $member) {
                $inquiriesByProjectMembers[$member->id] = Inquiry::where('employeeId', $member->id)->get();
            }
        }
        $teamLead = User::where('teamId', $team->id and 'role','team lead')->first();
        $projectLead = User::where('projectId', $project->id and 'role','project lead')->first();
        return view('member_page', ['user' => $user, 
                                    'project' => $project,
                                    'team' => $team,
                                    'inquiries' => $inquiries,
                                    'teamMembers' => $teamMembers,
                                    'projectMembers' => $projectMembers,
                                    'inquiriesByTeamMembers' => $inquiriesByTeamMembers,
                                    'inquiriesByProjectMembers' => $inquiriesByProjectMembers,
                                    'projectLead' => $projectLead,
                                    'teamLead' => $teamLead, ]);
    }
}