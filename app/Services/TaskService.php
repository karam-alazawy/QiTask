<?php

namespace App\Services;

use App\Models\Task;
use Illuminate\Support\Collection;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;

class TaskService
{
    public function create(array $attributes): Task
    {
        return Task::create($attributes);
    }

    public function update(array $attributes, Task $task): Task
    {
        $task->update($attributes);
        return $task;
    }

    public function find(int $id): ?Task
    {
        return Task::find($id);
    }

    public function all(): Collection
    {
        return Task::all();
    }

    public function delete(int $taskId): void
    {
        $task = $this->find($taskId);
        if ($task) {
            $task->delete();
        }
    }

    public function getPendingTasksGroupedByDate(): array
    {
        $tasks = Task::where('completed', false)->get();
        $groupedTasks = [];

        foreach ($tasks as $task) {
            $group = $this->determineTaskTimeGroup($task->due_date);
            $groupedTasks[$group][] = $task;
        }

        return $groupedTasks;
    }

    private function determineTaskTimeGroup(Carbon $dueDate): string
    {
        $today = now()->startOfDay();
        $tomorrow = now()->addDay()->startOfDay();
        $nextWeek = now()->addWeek()->startOfDay();

        if ($dueDate <= $today) {
            return 'Tasks Today';
        } elseif ($dueDate <= $tomorrow) {
            return 'Tasks Tomorrow';
        } elseif ($dueDate <= $nextWeek) {
            return 'Tasks Next Week';
        } elseif ($dueDate <= $nextWeek->addWeeks(3)) {
            return 'Tasks in the Near Future';
        } else {
            return 'Tasks in the Future';
        }
    }

    public function markAsCompleted(int $taskId): void
    {
        $task = $this->find($taskId);
        if ($task) {
            $task->update(['completed' => true]);
        }
    }

    public function getDueDate(string $startDate, int $duration): string
    {
        return Carbon::parse($startDate)->addDays($duration)->startOfDay()->toDateTimeString();
    }


    public function validator($request)
    {
        $validator = Validator::make($request, [
            'project_id' => 'required|exists:projects,id',
            'name' => 'required|max:255|unique:tasks,name,NULL,id,user_id,' . Auth::id(),
            'description' => 'nullable|string',
            'duration' => 'required|numeric|min:1',
            'start_date' => 'required|date',
            'due_date' => 'required|date',
            'completed' => 'nullable|boolean',
        ]);
    
        if ($validator->fails()) {
            return $validator->errors();
        }    
        return 0;

    }
    
}
