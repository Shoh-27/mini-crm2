<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Lead Details') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-5xl mx-auto sm:px-6 lg:px-8 space-y-6">
            {{-- Lead Info --}}
            <div class="bg-white shadow-sm sm:rounded-lg p-6">
                <h3 class="text-lg font-semibold mb-2">{{ $lead->name }}</h3>
                <p class="text-gray-600">{{ $lead->email }} — {{ $lead->phone }}</p>
                <p class="mt-2"><strong>Status:</strong> {{ $lead->status }}</p>
            </div>

            {{-- Task List --}}
            <div class="bg-white shadow-sm sm:rounded-lg p-6">
                <h3 class="text-lg font-semibold mb-4">Tasks</h3>

                @if ($lead->tasks->isEmpty())
                    <p class="text-gray-500">No tasks assigned yet.</p>
                @else
                    <ul class="divide-y divide-gray-200">
                        @foreach ($lead->tasks as $task)
                            <li class="py-3 flex justify-between items-center">
                                <div>
                                    <h4 class="font-medium text-gray-800">{{ $task->title }}</h4>
                                    <p class="text-sm text-gray-500">{{ $task->description }}</p>
                                    <p class="text-xs text-gray-400 mt-1">
                                        Status: <span class="font-semibold">{{ $task->status }}</span> |
                                        Assigned to: {{ $task->assignedTo->name ?? 'N/A' }} |
                                        Deadline: {{ $task->deadline ?? '—' }}
                                    </p>
                                </div>
                                <a href="{{ route('tasks.edit', $task->id) }}"
                                   class="text-indigo-600 hover:text-indigo-800 text-sm font-medium">
                                    Edit
                                </a>
                            </li>
                        @endforeach
                    </ul>
                @endif
            </div>

            {{-- Add Task Form --}}
            <div class="bg-white shadow-sm sm:rounded-lg p-6">
                <h3 class="text-lg font-semibold mb-4">Add New Task</h3>
                <form action="{{ route('tasks.store') }}" method="POST">
                    @csrf

                    <input type="hidden" name="taskable_type" value="{{ get_class($lead) }}">
                    <input type="hidden" name="taskable_id" value="{{ $lead->id }}">

                    <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                        <div>
                            <label for="title" class="block text-sm font-medium text-gray-700">Title</label>
                            <input type="text" name="title" id="title"
                                   class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:ring-indigo-500 focus:border-indigo-500"
                                   required>
                        </div>

                        <div>
                            <label for="assigned_to" class="block text-sm font-medium text-gray-700">Assign To</label>
                            <select name="assigned_to" id="assigned_to"
                                    class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:ring-indigo-500 focus:border-indigo-500">
                                @foreach($users as $user)
                                    <option value="{{ $user->id }}">{{ $user->name }}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>

                    <div class="mt-4">
                        <label for="deadline" class="block text-sm font-medium text-gray-700">Deadline</label>
                        <input type="date" name="deadline" id="deadline"
                               class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:ring-indigo-500 focus:border-indigo-500">
                    </div>

                    <div class="mt-4">
                        <label for="description" class="block text-sm font-medium text-gray-700">Description</label>
                        <textarea name="description" id="description" rows="3"
                                  class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:ring-indigo-500 focus:border-indigo-500"></textarea>
                    </div>

                    <div class="mt-6 flex justify-end">
                        <button type="submit"
                                class="bg-indigo-600 hover:bg-indigo-700 text-white px-4 py-2 rounded-md shadow">
                            Create Task
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</x-app-layout>

