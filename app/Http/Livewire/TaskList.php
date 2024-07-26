<?php

namespace App\Http\Livewire;

use App\Facades\TaskServiceFacade as TaskService;
use Livewire\Component;

class TaskList extends Component
{
    public $tasks; // Store the pending tasks grouped by date
    public $processing = false; // Indicates if a task is being marked as completed

    public function mount()
    {
        $this->tasks = TaskService::getPendingTasksGroupedByDate();
    }

    public function markAsCompleted($taskId)
    {
        $this->processing = true; 
        TaskService::markAsCompleted($taskId); 


        $this->emit('taskCompleted'); 
        $this->processing = false; 

        session()->flash('success', 'Task marked as completed.');
    }

    public function deleteTask($taskId)
    {
        $task = TaskService::find($taskId);
        if ($task) {
            $task->delete();
            session()->flash('success', 'Task deleted successfully.');
        } else {
            session()->flash('failed', 'Task not found.');
        }
    }

    protected $listeners = ['taskCreated' => 'refreshTasks'];

    public function refreshTasks()
    {
        $this->tasks = TaskService::all();
    }

    public function render()
    {   
        $this->tasks = TaskService::getPendingTasksGroupedByDate();
        return view('livewire.task-list');
    }


}
