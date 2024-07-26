<?php


namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Facades\ProjectServiceFacade as ProjectServiceFacade; // Use ProjectServiceFacade instead

class ProjectController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth:sanctum'); // Ensure all methods are protected by authentication
    }

    public function index()
    {
        $projects = ProjectServiceFacade::getUserProjects(); // Use ProjectServiceFacade for getting user projects
        return response()->json($projects);
    }

    public function store(Request $request)
    {
        $data=$request->all();
        if ($validator=ProjectServiceFacade::validator($request->all())) {
            return response()->json([
                'errors' => $validator
            ], 422); // Unprocessable status code
        }
        $data['user_id'] = Auth::id();
        $project = ProjectServiceFacade::create($data); // Use ProjectServiceFacade for creating a project
        return response()->json($project, 201);
    }

    public function update(Request $request, $id)
    {
        $data = $request->validate([
            'name' => 'required|max:255',
            'description' => 'required|max:255',
        ]);

        $project = ProjectServiceFacade::find($id); // Use ProjectServiceFacade to find the project
        if ($project) {
            $project = ProjectServiceFacade::update($data, $project); // Use ProjectServiceFacade to update the project
            return response()->json($project);
        }

        return response()->json(['error' => 'Project not found'], 404);
    }

    public function destroy($id)
    {
        $project = ProjectServiceFacade::find($id); // Use ProjectServiceFacade to find the project
        if ($project) {
            ProjectServiceFacade::delete($project); // Use ProjectServiceFacade to delete the project
            return response()->json(['message' => 'Project deleted successfully']);
        }

        return response()->json(['error' => 'Project not found'], 404);
    }
}
