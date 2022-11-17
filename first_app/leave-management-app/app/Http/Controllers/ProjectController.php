<?php

namespace App\Http\Controllers;

use App\Models\Project;
use Illuminate\Http\Request;

class ProjectController extends Controller
{
    public function getAllProjects(Request $request) {
        $projects = Project::paginate(8);
        return view('projects', ['projects' => $projects]);
    }

    public function saveProject(Request $request) {
        $project = new Project;
        $project->title = $request->title;
        $project->save();
        return redirect('admin')->with('status', 'New Project Has Been inserted');
    }
}