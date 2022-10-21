<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class TodoTest extends TestCase
{
    use RefreshDatabase;

    public function setUp(): void
    {
        parent::setUp();

        $this->initDatabase();
    }

    public function tearDown(): void
    {
        $this->resetDatabase();

        parent::tearDown();
    }

    /**
     * @test
     */
    public function get_all_todos(): void
    {
        $this->getJson('/todos')
            ->assertOk()
            ->assertJsonCount(6);
    }

    /**
     * @test
     */
    public function create_a_todo(): void
    {
        $this->postJson('/todos', ['body' => 'dummy text', 'done' => false])
            ->assertCreated()
            ->assertJson([
                'id' => 7,
                'body' => 'dummy text',
                'done' => false,
            ]);

        $this->getJson('/todos')
            ->assertJsonCount(7);
    }

    /**
     * @test
     */
    public function complete_all_todos(): void
    {
        $this->put('/todos/complete')
            ->assertOK();

        $response = $this->getJson('/todos')
            ->assertJson([
                [
                    'id' => 1,
                    'done' => true,
                ]
            ]);

        $this->assertFalse($response->original->contains('done', false));
    }

    /**
     * @test
     */
    public function toggle_todo_done(): void
    {
        $doneTodo = $this->getJson('/todos')->original->where('done', true)->first();

        $this->put('/todos/'. $doneTodo->id)
            ->assertOK();

        $this->assertEquals(0, $this->getJson('/todos')->original->where('id', $doneTodo->id)->first()->done);
    }

    /**
     * @test
     */
    public function delete_todo(): void
    {
        $todo = $this->getJson('/todos')->original->first();

        $this->delete('/todos/'. $todo->id)
            ->assertOK();

        $response = $this->getJson('/todos')->assertJsonCount(5);

        $response->assertJsonMissingExact(['id' => 1]);
    }
}
