<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800">
            Lead Details & Tasks
        </h2>
    </x-slot>

    <div class="max-w-6xl mx-auto py-6 space-y-6">
        {{-- Lead Info --}}
        <div class="bg-white shadow rounded-lg p-6">
            <h3 class="text-2xl font-semibold mb-2">{{ $lead->name }}</h3>
            <p class="text-gray-600 mb-2">Email: <span class="font-medium">{{ $lead->email }}</span></p>
            <p class="text-gray-600 mb-2">Phone: <span class="font-medium">{{ $lead->phone }}</span></p>
            <p class="text-gray-600 mb-2">Status: <span class="font-semibold">{{ $lead->status }}</span></p>
            <div class="flex space-x-4 mt-4">
                <a href="{{ route('leads.edit', $lead) }}" class="px-4 py-2 bg-blue-600 text-white rounded-md">Edit</a>
                <form action="{{ route('leads.destroy', $lead) }}" method="POST" onsubmit="return confirm('Delete this lead?')">
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="px-4 py-2 bg-red-600 text-white rounded-md">Delete</button>
                </form>
            </div>
        </div>

        {{-- Kanban Tasks --}}
        <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
            @php
                $statuses = ['To-Do', 'In Progress', 'Done'];
            @endphp

            @foreach ($statuses as $status)
                <div class="bg-white shadow rounded-lg p-4">
                    <h4 class="font-semibold mb-4 text-center">{{ $status }}</h4>
                    @foreach ($lead->tasks->where('status', $status) as $task)
                        <div class="bg-gray-100 p-3 rounded mb-3">
                            <h5 class="font-medium">{{ $task->title }}</h5>
                            <p class="text-sm text-gray-500">{{ $task->description }}</p>
                            <p class="text-xs text-gray-400 mt-1">
                                Assigned to: {{ $task->assignedTo->name ?? 'N/A' }} <br>
                                Deadline: {{ $task->deadline ?? '—' }}
                            </p>
                            <div class="mt-2 text-right">
                                <a href="{{ route('tasks.edit', $task->id) }}" class="text-indigo-600 hover:text-indigo-800 text-sm">Edit</a>
                            </div>
                        </div>
                    @endforeach
                </div>
            @endforeach
        </div>

        {{-- Add New Task --}}
        <div class="bg-white shadow rounded-lg p-6">
            <h3 class="text-lg font-semibold mb-4">Add New Task</h3>
            <form action="{{ route('tasks.store') }}" method="POST">
                @csrf
                <input type="hidden" name="taskable_type" value="{{ get_class($lead) }}">
                <input type="hidden" name="taskable_id" value="{{ $lead->id }}">

                <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                    <div>
                        <label for="title" class="block text-sm font-medium text-gray-700">Title</label>
                        <input type="text" name="title" id="title" class="mt-1 block w-full border-gray-300 rounded-md shadow-sm" required>
                    </div>

                    <div>
                        <label for="assigned_to" class="block text-sm font-medium text-gray-700">Assign To</label>
                        <select name="assigned_to" id="assigned_to" class="mt-1 block w-full border-gray-300 rounded-md shadow-sm">
                            @foreach($users as $user)
                                <option value="{{ $user->id }}">{{ $user->name }}</option>
                            @endforeach
                        </select>
                    </div>
                </div>

                <div class="mt-4">
                    <label for="deadline" class="block text-sm font-medium text-gray-700">Deadline</label>
                    <input type="date" name="deadline" id="deadline" class="mt-1 block w-full border-gray-300 rounded-md shadow-sm">
                </div>

                <div class="mt-4">
                    <label for="description" class="block text-sm font-medium text-gray-700">Description</label>
                    <textarea name="description" id="description" rows="3" class="mt-1 block w-full border-gray-300 rounded-md shadow-sm"></textarea>
                </div>

                <div class="mt-6 flex justify-end">
                    <button type="submit" class="bg-indigo-600 hover:bg-indigo-700 text-white px-4 py-2 rounded-md shadow">Create Task</button>
                </div>
            </form>
        </div>
    </div>
</x-app-layout>
