<?php

namespace App\Http\Controllers;

use App\Interfaces\UserRepositoryInterface;
use App\Interfaces\TeamRepositoryInterface;
use App\Interfaces\ProjectRepositoryInterface;
use App\Interfaces\InquiryRepositoryInterface;
use Illuminate\Http\Request;

class AdminController extends Controller
{
    private UserRepositoryInterface $userRepository;
    private TeamRepositoryInterface $teamRepository;
    private ProjectRepositoryInterface $projectRepository;
    private InquiryRepositoryInterface $inquiryRepository;

    public function getAdminData(Request $request) {
        $regularEmployees = $this->userRepository->getUsersByRole('member');
        $admins = $this->userRepository->getUsersByRole('admin');
        $teamLeads = $this->userRepository->getUsersByRole('team lead');
        $projectLeads = $this->userRepository->getUsersByRole('project lead');
        $projects = $this->projectRepository->getAllProjects();
        $teams = $this->teamRepository->getAllTeams();
        $inquiries = $this->inquiryRepository->getAllInquiries()->sortBy('startDate');
        return view('admin_page', ['admins' => $admins, 
                                    'regulars' => $regularEmployees, 
                                    'prLeads' => $projectLeads, 
                                    'tmLeads' => $teamLeads,
                                    'projects' => $projects,
                                    'teams' => $teams,
                                    'inquiries' => $inquiries]);
    }
}