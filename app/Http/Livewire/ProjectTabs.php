<?php

namespace App\Http\Livewire;

use Livewire\Component;
use App\Facades\ProjectServiceFacade as ProjectService;
use App\Facades\TaskServiceFacade as TaskService;

class ProjectTabs extends Component
{

    public $activeProject;
    public $projects;

    public function showProject($ProjectId)
    {
        $this->activeProject = $ProjectId;
        $this->emit('showProject', $ProjectId);
    }

    public function render()
    {
        $this->tasks = TaskService::getPendingTasksGroupedByDate();
        $projects = ProjectService::getUserProjects();
        //dd($this->projects);
        return view('livewire.project-tabs', ['projects' => $projects]);
    }
}
