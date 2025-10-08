<x-app-layout>
    <div class="max-w-7xl mx-auto py-8 px-4">
        <div class="flex justify-between items-center mb-8">
            <h1 class="text-3xl font-bold text-white tracking-wide">Task Management (Kanban Board)</h1>
            <a href="{{ route('tasks.create') }}"
               class="inline-block px-5 py-2.5 bg-blue-600 hover:bg-blue-700 text-white font-semibold rounded-lg shadow transition">
                + Create Task
            </a>
        </div>

        <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
            @foreach(['To-Do' => 'from-yellow-600 to-yellow-700',
                      'In Progress' => 'from-blue-600 to-blue-700',
                      'Done' => 'from-green-600 to-green-700'] as $status => $gradient)

                <div class="bg-gradient-to-br {{ $gradient }} rounded-2xl shadow-lg p-4 border border-gray-700">
                    <h3 class="text-lg font-semibold text-white mb-4 border-b border-gray-500 pb-2">
                        {{ $status }}
                    </h3>

                    @forelse($tasks->where('status', $status) as $task)
                        <div class="bg-gray-900/80 hover:bg-gray-800 transition rounded-xl p-4 mb-3 shadow-md">
                            <h4 class="font-semibold text-gray-100">{{ $task->title }}</h4>
                            <p class="text-sm text-gray-400">{{ $task->user->name }}</p>
                            <p class="text-xs text-gray-500 mt-1">
                                Deadline: {{ $task->deadline ?? '—' }}
                            </p>

                            <div class="mt-3 flex justify-between text-sm">
                                <a href="{{ route('tasks.edit', $task) }}" class="text-blue-400 hover:text-blue-300 font-medium">Edit</a>
                                <form action="{{ route('tasks.destroy', $task) }}" method="POST"
                                      onsubmit="return confirm('Delete this task?')">
                                    @csrf @method('DELETE')
                                    <button type="submit" class="text-red-400 hover:text-red-300 font-medium">
                                        Delete
                                    </button>
                                </form>
                            </div>
                        </div>
                    @empty
                        <p class="text-gray-300 text-sm italic">No tasks in this column</p>
                    @endforelse
                </div>
            @endforeach
        </div>
    </div>
</x-app-layout>
