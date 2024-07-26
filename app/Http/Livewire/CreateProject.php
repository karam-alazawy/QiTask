<?php

namespace App\Http\Livewire;

use Illuminate\Support\Facades\Auth;
use Livewire\Component;
use App\Facades\ProjectServiceFacade as ProjectService;

class CreateProject extends Component
{
    public $name;
    public $description;

    public function render()
    {
        return view('livewire.create-project');
    }

    
    public function createProject()
    {
        $this->validate();

        try {
            ProjectService::create([
                'user_id' => Auth::id(),
                'name' => $this->name,
                'description' => $this->description,
            ]);

            $this->reset(); // Reset all public properties
            $this->emit('projectCreated'); // Notify parent component or listeners
            session()->flash('success', 'Project created successfully.');
        } catch (\Exception $e) {
            session()->flash('failed', 'An error occurred: ' . $e->getMessage());
        }
    }

    protected function rules(): array
    {
        return [
            'name' => 'required|max:255|unique:projects,name,NULL,id,user_id,' . Auth::id(),
            'description' => 'required|max:255',
        ];
    }
}
