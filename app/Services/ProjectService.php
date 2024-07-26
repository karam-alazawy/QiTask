<?php

namespace App\Services;

use App\Models\Project;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;

class ProjectService
{
    public function create(array $attributes): Project
    {
        return Project::create($attributes);
    }

    public function update(array $attributes, Project $project): Project
    {
        $project->update($attributes);
        return $project;
    }

    public function find(int $id): ?Project
    {
        return Project::find($id);
    }

    public function all(): Collection
    {
        return Project::all();
    }

    public function delete(Project $project): void
    {
        $project->delete();
    }

    public function getUserProjects(): Collection
    {
        $user = auth()->user();
        return $user ? $user->projects : collect();
    }


    public function validator($request)
    {
        $validator = Validator::make($request, [
            'name' => 'required|max:255|unique:projects,name,NULL,id,user_id,' . Auth::id(),
            'description' => 'required|max:255',
        ]);
    
        if ($validator->fails()) {
            return $validator->errors();
        }    
        return 0;

    }
}
