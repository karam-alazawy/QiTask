<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Facades\TaskServiceFacade as TaskServiceFacade;
use Illuminate\Support\Facades\Validator;

class TaskController extends Controller
{
    public function __construct()
    {
        // Middleware to ensure the user is authenticated for all methods
        $this->middleware('auth:sanctum');
    }

    public function index()
    {
        $user = Auth::user();
        if (!$user) {
            return response()->json(['error' => 'Unauthorized'], 401);
        }

        $tasks = TaskServiceFacade::getPendingTasksGroupedByDate();
        return response()->json($tasks);
    }

    public function show($id)
    {
        $task = TaskServiceFacade::find($id);
        if ($task && $task->user_id === Auth::id()) {
            return response()->json($task);
        }

        return response()->json(['error' => 'Task not found or unauthorized'], 404);
    }

    public function store(Request $request)
    {
        $data=$request->all();
        if ($validator=TaskServiceFacade::validator($request->all())) {
            return response()->json([
                'errors' => $validator
            ], 422); // Unprocessable status code
        }


        $data['user_id'] = Auth::id(); // Add user_id to the validated data
        $task = TaskServiceFacade::create($data);

        return response()->json($task, 201);
    }

    public function update(Request $request, $id)
    {
        $data=$request->all();
        if ($validator=TaskServiceFacade::validator($request->all())) {
            return response()->json([
                'errors' => $validator
            ], 422); // Unprocessable status code
        }
        $task = TaskServiceFacade::find($id);
        if ($task && $task->user_id === Auth::id()) {
            $task = TaskServiceFacade::update($data, $task);
            return response()->json($task);
        }
        return response()->json(['error' => 'Task not found or unauthorized'], 404);
    }

    public function destroy($id)
    {
        $task = TaskServiceFacade::find($id);
        if ($task && $task->user_id === Auth::id()) {
            TaskServiceFacade::delete($id);
            return response()->json(['message' => 'Task deleted successfully']);
        }

        return response()->json(['error' => 'Task not found or unauthorized'], 404);
    }
}
