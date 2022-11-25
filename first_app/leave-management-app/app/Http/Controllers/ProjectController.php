<?php

namespace App\Http\Controllers;

use App\Models\Project;
use App\Interfaces\ProjectRepositoryInterface;
use Illuminate\Http\Request;

class ProjectController extends Controller
{
    private ProjectRepositoryInterface $projectRepository;

    public function getAllProjects(Request $request) {
        $projects = $this->projectRepository->getAllProjects();
        return view('projects', ['projects' => $projects]);
    }

    public function saveProject(Request $request) {
        $project = new Project;
        $project->title = $request->title;
        $this->projectRepository->saveProject($project);
        return redirect('admin')->with('status', 'New Project Has Been inserted');
    }
}