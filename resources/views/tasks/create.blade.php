<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800">
            Create New Task
        </h2>
    </x-slot>

    <div class="max-w-4xl mx-auto py-6">
        <div class="bg-white p-6 shadow rounded-lg">
            <form method="POST" action="{{ route('tasks.store') }}">
                @csrf

                <div class="mb-4">
                    <label class="block font-medium text-gray-700">Title</label>
                    <input type="text" name="title" class="w-full border-gray-300 rounded-md" required>
                </div>

                <div class="mb-4">
                    <label class="block font-medium text-gray-700">Description</label>
                    <textarea name="description" class="w-full border-gray-300 rounded-md"></textarea>
                </div>

                <div class="mb-4">
                    <label class="block font-medium text-gray-700">Assign To</label>
                    <select name="assigned_to" class="w-full border-gray-300 rounded-md" required>
                        <option value="">Select User</option>
                        @foreach($users as $user)
                            <option value="{{ $user->id }}">{{ $user->name }}</option>
                        @endforeach
                    </select>
                </div>

                <div class="mb-4">
                    <label class="block font-medium text-gray-700">Task Type</label>
                    <select name="taskable_type" class="w-full border-gray-300 rounded-md">
                        <option value="App\Models\Lead">Lead</option>
                        <option value="App\Models\Deal">Deal</option>
                    </select>
                </div>

                <div class="mb-4">
                    <label class="block font-medium text-gray-700">Task Reference ID</label>
                    <input type="number" name="taskable_id" class="w-full border-gray-300 rounded-md" placeholder="Lead/Deal ID">
                </div>

                <div class="mb-4">
                    <label class="block font-medium text-gray-700">Status</label>
                    <select name="status" class="w-full border-gray-300 rounded-md">
                        <option value="To-Do">To-Do</option>
                        <option value="In Progress">In Progress</option>
                        <option value="Done">Done</option>
                    </select>
                </div>

                <div class="mb-4">
                    <label class="block font-medium text-gray-700">Deadline</label>
                    <input type="date" name="deadline" class="w-full border-gray-300 rounded-md">
                </div>

                <div class="flex justify-between">
                    <a href="{{ route('tasks.index') }}" class="px-4 py-2 bg-gray-200 text-gray-800 rounded-md">Cancel</a>
                    <button type="submit" class="px-4 py-2 bg-blue-600 text-white rounded-md">Create</button>
                </div>
            </form>
        </div>
    </div>
</x-app-layout>
