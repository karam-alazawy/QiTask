<?php

namespace App\Http\Livewire;

use App\Facades\ProjectServiceFacade as ProjectService;
use Livewire\Component;

class ProjectList extends Component
{
    protected $listeners = ['projectCreated' => 'refreshProjects'];

    public function refreshProjects()
    {
        // Fetch and update the projects here
        $this->projects = ProjectService::all();
    }

    public function render()
    {
        $projects = ProjectService::getUserProjects(); // Fetch the projects
        return view('livewire.project', ['projects' => $projects]);
    }
}
