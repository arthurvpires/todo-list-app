<?php

use App\Models\Task;

beforeEach(function () {
    $this->task = Task::factory()->create();
});

test('create a task', function () {
    $response = $this->postJson('api/task/create', [
        'title' => 'Task Title',
        'description' => 'Task Description',
    ]);

    $response->assertStatus(200)
        ->assertOk()
        ->assertJson([
            'message' => 'Task created successfully!',
        ]);

    $this->assertDatabaseHas('tasks', [
        'title' => 'Task Title',
        'description' => 'Task Description',
        'status' => 'pending'
    ]);
});

test('list all tasks', function () {
    $response = $this->getJson('api/task/list');
    $response->assertStatus(200)
        ->assertJsonFragment([
            'title' => $this->task->title,
            'description' => $this->task->description,
        ])
        ->assertOk();
});

test('list task details', function () {

    $response = $this->getJson("api/task/{$this->task->id}");
    $response->assertStatus(200)
        ->assertJsonFragment([
            'id' => $this->task->id,
            'title' => $this->task->title,
            'description' => $this->task->description,
            'status' => $this->task->status,
        ])
        ->assertOk();
});

test('update task', function () {
    $response = $this->putJson("api/task/update/{$this->task->id}", [
        'id' => $this->task->id,
        "title" => "New title",
        "description" => "New description",
        "status" => Task::STATUS_DONE,
    ]);

    $expectedResponse = [
        'id' => $this->task->id,
        'title' => 'New title',
        'description' => 'New description',
        'status' => Task::STATUS_DONE,
    ];

    $response->assertStatus(200)
        ->assertJsonFragment($expectedResponse)
        ->assertOk();
});

test('destroy task', function () {
    $response = $this->deleteJson("api/task/destroy/{$this->task->id}", [
        'id' => $this->task->id,
    ]);

    $response->assertStatus(200)
        ->assertJson([
            'message' => 'Task deleted successfully!',
        ])
        ->assertOk();
});
