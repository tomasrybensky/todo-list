<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ $list->{\App\Models\TaskList::NAME}  }}
        </h2>
    </x-slot>

    <div class="py-6">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">
                    <form method="post" action="{{ route('task.create', ['taskList' => $list]) }}" class="mt-6 space-y-6">
                        @csrf
                        @method('post')

                        <div>
                            <x-input-label for="create_task_list_name" :value="__('Add Task')" />
                            <x-text-input id="create_task_list_name" name="name" type="text" class="mt-1 w-3/4"/>
                            <x-primary-button class="ml-2">{{ __('Create') }}</x-primary-button>

                            @if (session('status') === 'task-created')
                                <p
                                    x-data="{ show: true }"
                                    x-show="show"
                                    x-transition
                                    x-init="setTimeout(() => show = false, 2000)"
                                    class="text-sm text-gray-600"
                                >{{ __('Added.') }}</p>
                            @endif

                            <x-input-error :messages="$errors->get('name')" class="mt-2" />
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

    @foreach($list->tasks as $task)
        <div class="py-1">
            <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
                <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                    <div class="p-3 text-gray-900">
                        <div class="flex">
                            @if($task->{\App\Models\Task::IS_COMPLETED})
                                <s><h3 class="font-semibold text-lg text-gray-600 pt-1">{{ $task->{\App\Models\Task::NAME} }}</h3></s>
                            @else
                                <h4 class="font-semibold text-lg text-gray-600 pt-1">{{ $task->{\App\Models\Task::NAME} }}</h4>

                                <form method="post" action="{{ route('task.complete', ['task' => $task]) }}" class="w-1/2">
                                    @csrf
                                    @method('post')


                                    <x-primary-button class="ml-2">{{ __('Completed') }}</x-primary-button>
                                </form>
                            @endif
                        </div>
                    </div>
                </div>
            </div>
        </div>
    @endforeach
</x-app-layout>
