<?php

namespace App\Actions;

use App\Models\Task;
use App\Models\User;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Support\Collection;

class GetListsAction
{
    public function execute(User $user): Collection
    {
        return $user->taskLists()
            ->withCount([
                'tasks',
                'tasks as completed_tasks_count' => function (Builder $query) {
                    $query->where(Task::IS_COMPLETED, true);
                }
            ])
            ->get();
    }
}
