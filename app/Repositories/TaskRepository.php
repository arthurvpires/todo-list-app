<?php

namespace App\Repositories;

use App\Models\Task;
use Illuminate\Database\Eloquent\Collection;

class TaskRepository
{
    public function create(array $data): ?Task
    {
        if (!$data['title'] || !$data['description']) {
            throw new \Exception('Title and description are required');
        }

        return Task::create([
            'title' => $data['title'],
            'description' => $data['description'],
        ]);
    }

    public function list(?int $perPage = null): ?Collection
    {
        return $perPage ? Task::paginate($perPage) : Task::all();
    }

    public function listDetails(int $id): ?Task
    {
        return Task::find($id);
    }

    public function update(int $id, array $data): ?Task
    {
        $task = Task::find($id);

        if (!$task) {
            throw new \Exception('Task not found');
        }

        $updateData = [
            'title' => $data['title'],
            'description' => $data['description'],
        ];

        if (isset($data['status'])) {
            $updateData['status'] = $data['status'];
        }

        $task->update($updateData);
        return $task;
    }

    public function destroy(int $id): ?bool
    {
        return Task::destroy($id);
    }

}
