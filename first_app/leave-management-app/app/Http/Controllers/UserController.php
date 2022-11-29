<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use App\Interfaces\UserRepositoryInterface;
use App\Interfaces\ProjectRepositoryInterface;
use App\Interfaces\TeamRepositoryInterface;
use App\Interfaces\InquiryRepositoryInterface;
use App\Repositories\InquiryRepository;
use App\Repositories\ProjectRepository;
use App\Repositories\TeamRepository;
use App\Repositories\UserRepository;

class UserController extends Controller
{
    private UserRepositoryInterface $userRepository;
    private TeamRepositoryInterface $teamRepository;
    private ProjectRepositoryInterface $projectRepository;
    private InquiryRepositoryInterface $inquiryRepository;

    public function __construct() {
        $this->userRepository = new UserRepository;
        $this->projectRepository = new ProjectRepository;
        $this->teamRepository = new TeamRepository;
        $this->inquiryRepository = new InquiryRepository;
    }
    
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
            $teamMembers = $this->userRepository->getTeamMembers($user->teamId);
            
            foreach ($teamMembers as $member) {
                $inquiriesByTeamMembers[$member->id] = $this->inquiryRepository->getInquiriesByEmployee($member->id);
            }
        } elseif ($user->role == 'project lead') {
            $projectMembers = $this->userRepository->getProjectMembers($user->projectId);
            foreach ($projectMembers as $member) {
                $inquiriesByProjectMembers[$member->id] = $this->inquiryRepository->getInquiriesByEmployee($member->id);
            }
        }
        $teamLead = $this->userRepository->getTeamLead($team->id);
        $projectLead = $this->userRepository->getProjectLead($project->id);
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