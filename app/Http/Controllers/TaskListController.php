<?php

namespace App\Http\Controllers;

use App\Actions\GetListsAction;
use App\Http\Requests\CreateTaskListRequest;
use App\Models\TaskList;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Response;

class TaskListController extends Controller
{
    public function index(): View
    {
        return view('dashboard', [
            'lists' => app()->make(GetListsAction::class)->execute(auth()->user()),
        ]);
    }

    public function create(CreateTaskListRequest $request): RedirectResponse
    {
        auth()->user()->taskLists()->create($request->validated());
        return redirect()->back()->with('status', 'task-list-created');
    }

    public function detail(TaskList $list): View
    {
        if (!auth()->user()->can('view', $list)) {
            abort(Response::HTTP_UNAUTHORIZED);
        }

        return view('list', compact('list'));
    }

    public function delete(TaskList $list): RedirectResponse
    {
        if (!auth()->user()->can('delete', $list)) {
            abort(Response::HTTP_UNAUTHORIZED);
        }

        $list->delete();

        return redirect()->back();
    }
}
