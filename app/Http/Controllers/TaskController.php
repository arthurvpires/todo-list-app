<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\Response;
use App\Repositories\TaskRepository;
use App\Http\Requests\Task\CreateRequest;
use App\Http\Requests\Task\UpdateRequest;

class TaskController extends Controller
{
    private $taskRepository;

    public function __construct(TaskRepository $taskRepository)
    {
        $this->taskRepository = $taskRepository;
    }

    public function create(CreateRequest $req)
    {
        $response = $this->taskRepository->create($req->all());
        return response()->json(['message' => 'Task created successfully!', $response], Response::HTTP_OK);
    }

    public function list()
    {
        $response = $this->taskRepository->list();
        return response()->json($response, Response::HTTP_OK);
    }

    public function listDetails(Request $req)
    {
        $data = $req->validate([
            'id' => 'required|integer'
        ]);

        $response = $this->taskRepository->listDetails($data['id']);
        return response()->json($response, Response::HTTP_OK);
    }

    public function update(UpdateRequest $req)
    {
        $response = $this->taskRepository->update($req->id, $req->all());
        return response()->json(['message' => 'Task updatede successfully!', $response], Response::HTTP_OK);
    }

    public function destroy(Request $req)
    {
        $response = $this->taskRepository->destroy($req->id);
        return response()->json(['message' => 'Task deleted successfully!'], Response::HTTP_OK);
    }
}
