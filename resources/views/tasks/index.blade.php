<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800">
            Task Management (Kanban Board)
        </h2>
    </x-slot>

    <div class="max-w-7xl mx-auto py-6 grid grid-cols-1 md:grid-cols-3 gap-6">
        @foreach(['To-Do' => 'bg-yellow-50', 'In Progress' => 'bg-blue-50', 'Done' => 'bg-green-50'] as $status => $color)
            <div class="{{ $color }} p-4 rounded-lg shadow">
                <h3 class="font-semibold text-lg mb-3 text-gray-700">{{ $status }}</h3>

                @foreach($tasks->where('status', $status) as $task)
                    <div class="bg-white shadow p-3 mb-3 rounded-lg">
                        <h4 class="font-semibold">{{ $task->title }}</h4>
                        <p class="text-sm text-gray-600">{{ $task->user->name }}</p>
                        <p class="text-xs text-gray-500">
                            Deadline: {{ $task->deadline ?? '—' }}
                        </p>
                        <div class="mt-2 flex justify-between text-sm">
                            <a href="{{ route('tasks.edit', $task) }}" class="text-blue-600 hover:underline">Edit</a>
                            <form action="{{ route('tasks.destroy', $task) }}" method="POST" onsubmit="return confirm('Delete task?')">
                                @csrf @method('DELETE')
                                <button type="submit" class="text-red-600 hover:underline">Delete</button>
                            </form>
                        </div>
                    </div>
                @endforeach
            </div>
        @endforeach
    </div>
</x-app-layout>
