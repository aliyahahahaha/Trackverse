<?php

namespace Tests\Feature;

use App\Models\Project;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class ProjectTest extends TestCase
{
    use RefreshDatabase;

    public function test_user_can_view_projects_index()
    {
        $user = User::factory()->create();

        $response = $this->actingAs($user)->get(route('projects.index'));

        $response->assertStatus(200);
        $response->assertViewIs('projects.index');
    }

    public function test_user_can_create_project()
    {
        $user = User::factory()->create();

        $response = $this->actingAs($user)->post(route('projects.store'), [
            'name' => 'Test Project',
            'description' => 'Test Description',
            'status' => 'active',
        ]);

        $response->assertRedirect(route('projects.index'));
        $this->assertDatabaseHas('projects', [
            'name' => 'Test Project',
            'created_by' => $user->id,
        ]);
        $this->assertDatabaseHas('project_members', [
            'user_id' => $user->id,
        ]);
    }

    public function test_user_can_view_project()
    {
        $this->withoutExceptionHandling();
        $user = User::factory()->create();
        $project = Project::create([
            'name' => 'Test Project',
            'status' => 'active',
            'created_by' => $user->id,
        ]);

        $response = $this->actingAs($user)->get(route('projects.show', $project));

        $response->assertStatus(200);
        // dd($response->content());
        $response->assertSee('Test Project');
    }

    public function test_user_can_update_project()
    {
        $user = User::factory()->create();
        $project = Project::create([
            'name' => 'Old Name',
            'status' => 'active',
            'created_by' => $user->id,
        ]);

        $response = $this->actingAs($user)->put(route('projects.update', $project), [
            'name' => 'New Name',
            'description' => 'New Description',
            'status' => 'completed',
        ]);

        $response->assertRedirect(route('projects.index'));
        $this->assertDatabaseHas('projects', [
            'id' => $project->id,
            'name' => 'New Name',
            'status' => 'completed',
        ]);
    }

    public function test_user_can_delete_project()
    {
        $user = User::factory()->create();
        $project = Project::create([
            'name' => 'Test Project',
            'status' => 'active',
            'created_by' => $user->id,
        ]);

        $response = $this->actingAs($user)->delete(route('projects.destroy', $project));

        $response->assertRedirect(route('projects.index'));
        $this->assertDatabaseMissing('projects', [
            'id' => $project->id,
        ]);
    }
}
