<?php

namespace Tests\Feature;

use App\Models\Category;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;
use Tymon\JWTAuth\Facades\JWTAuth;

class CategoryTest extends TestCase
{
    protected User $user;
    
    use RefreshDatabase;

    protected function setUp():void
    {
        parent::setUp();

        $this->user = User::factory()->create();
    }

    public function test_must_return_all_categories(): void
    {
        $token = JWTAuth::fromUser($this->user);

        Category::create([
            'name' => 'Test category 1',
            'user_id' => $this->user->id
        ]);

        $this->get('/api/categories', [
            'Authorization' => "Bearer $token"
        ])
        ->assertStatus(200)
        ->assertJsonFragment(['name' => 'Test category 1']);
    }    

    public function test_must_create_a_new_category(): void
    {
        $token = JWTAuth::fromUser($this->user);

        $payload = [
            'name' => 'Test category 2',
            'user_id' => $this->user->id,
        ];

        $response = $this->post('/api/categories/create', $payload, [
            'Authorization' => "Bearer $token",
        ])
        ->assertStatus(201)
        ->assertJsonFragment([
            'name' => 'Test category 2'
        ]);

        $data = $response->json('data');

        $this->assertDatabaseHas('categories',[
            'id' => $data['id'],
            'name' => $data['name'], 
        ]);
    }

    public function test_must_update_a_category_by_id(): void
    {
        $token = JWTAuth::fromUser($this->user);

        $category = Category::create([
            'name' => 'Test category 3',
            'user_id' => $this->user->id,
        ]);

        $payload = [
            'name' => 'Test category 3 updated'
        ];

        $this->put("api/categories/update/$category->id", $payload, [
            'Authorization' => "Bearer $token",
        ])
        ->assertStatus(200)
        ->assertJsonFragment([
            'name' => $payload['name']
        ]);

        $this->assertDatabaseHas('categories', [
            'id' => $category->id,
            'name' => $payload['name']
        ]);
    }

    public function test_must_delete_a_category_by_id(): void
    {
        $token = JWTAuth::fromUser($this->user);

        $category = Category::create([
            'name' => 'Test category 3',
            'user_id' => $this->user->id,
        ]);

        $this->assertDatabaseHas('categories', [
            'id' => $category->id,
            'name' => $category->name
        ]);

        $this->delete("api/categories/delete/$category->id", [], [
            'Authorization' => "Bearer $token",
        ])
        ->assertNoContent();

        $this->assertSoftDeleted('categories', [
            'id' => $category->id,
        ]);
    }
}
