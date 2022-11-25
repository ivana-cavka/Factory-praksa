<?php

namespace App\Interfaces;

interface ProjectRepositoryInterface 
{
    public function getAllProjects();
    public function getProjectById($id);
    public function deleteProject($id);
    public function saveProject($new);
    public function updateProject($id, array $newDetails);
}