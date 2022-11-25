<?php

namespace App\Repositories;

use App\Interfaces\ProjectRepositoryInterface;
use App\Models\Project;

class ProjectRepository implements ProjectRepositoryInterface 
{
    public function getAllProjects() {
        return Project::all();
    }

    public function getProjectById($id) {
        return Project::findOrFail($id);
    }

    public function deleteProject($id) {
        Project::destroy($id);
    }

    public function saveProject($new) {
        $new->save();
    }
    
    public function updateProject($id, $newDetails) {
        return Project::whereId($id)->update($newDetails);
    }

}