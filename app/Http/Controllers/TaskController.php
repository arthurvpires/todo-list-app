<?php

namespace App\Http\Controllers;

use App\Models\Task;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use App\Http\Resources\TaskResource;
use App\Repositories\TaskRepository;
use App\Http\Requests\Task\CreateRequest;
use App\Http\Requests\Task\UpdateRequest;

class TaskController extends Controller
{
    protected $taskRepository;

    public function __construct(TaskRepository $taskRepository)
    {
        $this->taskRepository = $taskRepository;
    }

    public function create(CreateRequest $req)
    {
        $task = $this->taskRepository->create($req->all());
        return response()->json(
            [
                'message' => 'Task created successfully!',
                'task' => new TaskResource($task),
            ],
            Response::HTTP_OK
        );
    }

    public function list()
    {
        $tasks = $this->taskRepository->list();

        return response()->json(
            TaskResource::collection($tasks),
            Response::HTTP_OK
        );
    }

    public function details(int $id)
    {
        return new TaskResource(Task::findOrFail($id));
    }

    public function update(UpdateRequest $req)
    {
        $task = $this->taskRepository->update($req->id, $req->validated());
        return response()->json(
            [
                'message' => 'Task updatede successfully!',
                new TaskResource($task)
            ],
            Response::HTTP_OK
        );
    }

    public function destroy(Request $req)
    {
        $this->taskRepository->destroy($req->id);
        return response()->json(['message' => 'Task deleted successfully!'], Response::HTTP_OK);
    }
}
