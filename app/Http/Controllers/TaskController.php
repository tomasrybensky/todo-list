<?php

namespace App\Http\Controllers;

use App\Http\Requests\CreateTaskRequest;
use App\Models\Task;
use App\Models\TaskList;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Response;

class TaskController extends Controller
{
    public function create(TaskList $taskList, CreateTaskRequest $request): RedirectResponse
    {
        if (!auth()->user()->can('update', $taskList)) {
            abort(Response::HTTP_UNAUTHORIZED);
        }

        $taskList->tasks()->create($request->validated());

        return redirect()->back()->with('status', 'task-created');
    }

    public function complete(Task $task): RedirectResponse
    {
        if (!auth()->user()->can('update', $task)) {
            abort(Response::HTTP_UNAUTHORIZED);
        }

        $task->markCompleted();
        return redirect()->back();
    }
}
