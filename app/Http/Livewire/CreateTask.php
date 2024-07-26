<?php

namespace App\Http\Livewire;

use App\Facades\ProjectServiceFacade as ProjectService;
use App\Facades\TaskServiceFacade as TaskService;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\Rule;
use Livewire\Component;

class CreateTask extends Component
{
    public $project_id;
    public $name;
    public $description;
    public $duration = 5;
    public $start_date;
    public $completed;
    public $creatingTask = false;
    public $projects;

    public function mount()
    {
        $this->projects = ProjectService::getUserProjects();
    }

    public function createTask()
    {
        $validatedData = $this->validate();

        $this->creatingTask = true;

        $validatedData['due_date'] = TaskService::getDueDate($this->start_date, $this->duration);

        try {
            TaskService::create([
                'project_id' => $validatedData['project_id'],
                'user_id' => Auth::id(),
                'name' => $validatedData['name'],
                'description' => $validatedData['description'],
                'duration' => $validatedData['duration'],
                'start_date' => $validatedData['start_date'],
                'due_date' => $validatedData['due_date'],
                'completed' => $validatedData['completed'] ?? false,
            ]);

            $this->reset(['name', 'description']);
            $this->emit('taskCreated');
            session()->flash('success', 'Task created successfully.');

        } catch (\Exception $e) {
            session()->flash('failed', $e->getMessage());
        } finally {
            $this->creatingTask = false;
        }
    }

    public function render()
    {
        return view('livewire.create-task');
    }

    protected function rules(): array
    {
        return [
            'project_id' => ['required', 'exists:projects,id'],
            'name' => [
                'required',
                'max:255',
                function ($attribute, $value, $fail) {
                    $exists = \DB::table('tasks')
                        ->where('name', $value)
                        ->where('user_id', Auth::id())
                        ->where(function ($query) {
                            $query->whereNull('completed')
                                  ->orWhere('completed', false);
                        })
                        ->exists();
    
                    if ($exists) {
                        $fail('The task name has already been used.');
                    }
                }
            ],
            'description' => ['nullable', 'string'],
            'duration' => ['required', 'numeric', 'min:1'],
            'start_date' => ['required', 'date'],
            'completed' => ['nullable', 'boolean'],
        ];
    }
    
}
