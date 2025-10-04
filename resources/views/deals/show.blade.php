<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800">
            Deal Details
        </h2>
    </x-slot>

    <div class="max-w-5xl mx-auto py-6 space-y-6">
        {{-- Deal Info --}}
        <div class="bg-white shadow rounded-lg p-6">
            <div class="mb-6">
                <h3 class="text-2xl font-semibold mb-2">{{ $deal->title }}</h3>
                <p class="text-gray-600">Client: <span class="font-medium">{{ $deal->client->name }}</span></p>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-2 gap-6 mb-6">
                <div>
                    <p class="text-gray-600">Amount:</p>
                    <p class="text-lg font-semibold text-gray-900">${{ number_format($deal->amount, 2) }}</p>
                </div>

                <div>
                    <p class="text-gray-600">Status:</p>
                    @if($deal->status == 'Negotiation')
                        <span class="px-3 py-1 bg-yellow-200 text-yellow-800 rounded-full text-sm">Negotiation</span>
                    @elseif($deal->status == 'Won')
                        <span class="px-3 py-1 bg-green-200 text-green-800 rounded-full text-sm">Won</span>
                    @else
                        <span class="px-3 py-1 bg-red-200 text-red-800 rounded-full text-sm">Lost</span>
                    @endif
                </div>

                <div>
                    <p class="text-gray-600">Deadline:</p>
                    <p class="text-lg font-semibold text-gray-900">
                        {{ $deal->deadline ? \Carbon\Carbon::parse($deal->deadline)->format('d M, Y') : '—' }}
                    </p>
                </div>

                <div>
                    <p class="text-gray-600">Last Updated:</p>
                    <p class="text-lg font-semibold text-gray-900">
                        {{ $deal->updated_at->diffForHumans() }}
                    </p>
                </div>
            </div>

            <div class="flex justify-between mt-6">
                <a href="{{ route('deals.edit', $deal) }}" class="px-4 py-2 bg-blue-600 text-white rounded-md">
                    Edit
                </a>
                <form action="{{ route('deals.destroy', $deal) }}" method="POST" onsubmit="return confirm('Delete this deal?')">
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="px-4 py-2 bg-red-600 text-white rounded-md">
                        Delete
                    </button>
                </form>
            </div>
        </div>

        {{-- Deal Tasks --}}
        <div class="bg-white shadow rounded-lg p-6">
            <h3 class="text-lg font-semibold mb-4">Tasks</h3>

            @if ($deal->tasks->isEmpty())
                <p class="text-gray-500">No tasks assigned yet.</p>
            @else
                <ul class="divide-y divide-gray-200">
                    @foreach ($deal->tasks as $task)
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

        {{-- Add New Task Form --}}
        <div class="bg-white shadow rounded-lg p-6">
            <h3 class="text-lg font-semibold mb-4">Add New Task</h3>
            <form action="{{ route('tasks.store') }}" method="POST">
                @csrf

                <input type="hidden" name="taskable_type" value="{{ get_class($deal) }}">
                <input type="hidden" name="taskable_id" value="{{ $deal->id }}">

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
</x-app-layout>
