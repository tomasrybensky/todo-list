<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Dashboard') }}
        </h2>
    </x-slot>

    <div class="py-6">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">
                    <h3 class="font-semibold text-xl text-gray-800 leading-tight">{{ __('Create list') }}</h3>
                    <form method="post" action="{{ route('task_list.create') }}" class="mt-6 space-y-6">
                        @csrf
                        @method('post')

                        <div>
                            <x-input-label for="create_task_list_name" :value="__('List Name')" />
                            <x-text-input id="create_task_list_name" name="name" type="text" class="mt-1 w-3/4"/>
                            <x-primary-button class="ml-2">{{ __('Create') }}</x-primary-button>

                            @if (session('status') === 'task-list-created')
                                <p
                                    x-data="{ show: true }"
                                    x-show="show"
                                    x-transition
                                    x-init="setTimeout(() => show = false, 2000)"
                                    class="text-sm text-gray-600"
                                >{{ __('Created.') }}</p>
                            @endif

                            <x-input-error :messages="$errors->get('name')" class="mt-2" />
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

    @foreach($lists as $list)
        <div class="py-2">
            <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
                <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                    <div class="flex py-2 px-2">
                        <a href="{{ route('task_list.detail', ['list' => $list]) }}">
                            <h3 class="font-semibold text-xl text-gray-800 leading-tight pt-1 pl-2">{{ $list->{\App\Models\TaskList::NAME} }} ( {{ __('tasks: ') }} {{ $list->tasks_count }} / {{ __('completed: ') }} {{ $list->completed_tasks_count }} ) </h3>
                        </a>
                        <form method="post" action="{{ route('task_list.delete', ['list' => $list]) }}" class="w-1/2">
                            @csrf
                            @method('delete')


                            <x-primary-button class="ml-2">{{ __('Delete') }}</x-primary-button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    @endforeach
</x-app-layout>
