<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Edit Task') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-4xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white shadow-xl sm:rounded-lg p-6">
                <form action="{{ route('tasks.update', $task->id) }}" method="POST">
                    @csrf
                    @method('PUT')

                    {{-- Task Title --}}
                    <div class="mb-4">
                        <label for="title" class="block text-sm font-medium text-gray-700">Title</label>
                        <input type="text" name="title" id="title"
                               value="{{ old('title', $task->title) }}"
                               class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:ring-indigo-500 focus:border-indigo-500"
                               required>
                    </div>

                    {{-- Description --}}
                    <div class="mb-4">
                        <label for="description" class="block text-sm font-medium text-gray-700">Description</label>
                        <textarea name="description" id="description" rows="4"
                                  class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:ring-indigo-500 focus:border-indigo-500"
                                  placeholder="Write task details...">{{ old('description', $task->description) }}</textarea>
                    </div>

                    {{-- Assigned User --}}
                    <div class="mb-4">
                        <label for="assigned_to" class="block text-sm font-medium text-gray-700">Assigned To</label>
                        <select name="assigned_to" id="assigned_to"
                                class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:ring-indigo-500 focus:border-indigo-500">
                            @foreach($users as $user)
                                <option value="{{ $user->id }}" {{ $task->assigned_to == $user->id ? 'selected' : '' }}>
                                    {{ $user->name }}
                                </option>
                            @endforeach
                        </select>
                    </div>

                    {{-- Deadline --}}
                    <div class="mb-4">
                        <label for="deadline" class="block text-sm font-medium text-gray-700">Deadline</label>
                        <input type="date" name="deadline" id="deadline"
                               value="{{ old('deadline', $task->deadline) }}"
                               class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:ring-indigo-500 focus:border-indigo-500">
                    </div>

                    {{-- Status --}}
                    <div class="mb-4">
                        <label for="status" class="block text-sm font-medium text-gray-700">Status</label>
                        <select name="status" id="status"
                                class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:ring-indigo-500 focus:border-indigo-500">
                            <option value="To-Do" {{ $task->status == 'To-Do' ? 'selected' : '' }}>To-Do</option>
                            <option value="In Progress" {{ $task->status == 'In Progress' ? 'selected' : '' }}>In Progress</option>
                            <option value="Done" {{ $task->status == 'Done' ? 'selected' : '' }}>Done</option>
                        </select>
                    </div>

                    {{-- Submit Buttons --}}
                    <div class="flex items-center justify-end space-x-3">
                        <a href="{{ route('tasks.index') }}"
                           class="text-gray-600 hover:text-gray-800">Cancel</a>

                        <button type="submit"
                                class="text-gray-800 bg-indigo-600 hover:bg-indigo-700 px-4 py-2 rounded-md shadow">
                            Update Task
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</x-app-layout>
