<?php
namespace Tests\Unit;

use App\Models\Project;
use App\Models\User;
use App\Facades\ProjectServiceFacade as ProjectService;;
use Tests\TestCase;

class ProjectServiceTest extends TestCase
{

    public function setUp(): void
    {
        parent::setUp();

    }

    public function test_create_group()
    {
        // Create a user and project data
        $user = User::factory()->create();
        $projectData = [
            'name' => 'Test Project',
            'description' => 'This is a test project.',
            'user_id' => $user->id,
        ];

        // Create a project using the service
        $project = ProjectService::create($projectData);

        // Assert that the project exists in the database
        $this->assertDatabaseHas('projects', $projectData);

        // Assert individual attributes
        $this->assertEquals($projectData['name'], $project->name);
        $this->assertEquals($projectData['description'], $project->description);
        $this->assertEquals($projectData['user_id'], $project->user_id);
    }

    public function test_get_project_by_id()
    {
        $project = Project::factory()->create();
    
        $retrievedProject = ProjectService::find($project->id);
    
        $this->assertTrue($project->is($retrievedProject));
    }

    public function test_update_group()
    {
        $project = Project::factory()->create();

        $projectData = [
            'name' => 'New Name',
            'description' => 'New Description',
        ];

        ProjectService::update($projectData, $project);

        $this->assertDatabaseHas('projects', $projectData);

        $updatedProject = ProjectService::find($project->id);

        $this->assertEquals($projectData['name'], $updatedProject->name);
        $this->assertEquals($projectData['description'], $updatedProject->description);
    }

    public function test_get_all_groups()
    {
        $projects = Project::factory(3)->create();

        $retrievedProjects = ProjectService::all();

        $this->assertGreaterThanOrEqual($projects->count(), $retrievedProjects->count());
    }
    
}
