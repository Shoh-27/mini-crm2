<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800">
            Edit Deal
        </h2>
    </x-slot>

    <div class="max-w-4xl mx-auto py-6">
        <div class="bg-white shadow rounded-lg p-6">
            <form method="POST" action="{{ route('deals.update', $deal) }}">
                @csrf
                @method('PUT')

                <div class="mb-4">
                    <label class="block text-sm font-medium text-gray-700">Client</label>
                    <select name="client_id" class="w-full border-gray-300 rounded-md">
                        @foreach($clients as $client)
                            <option value="{{ $client->id }}" {{ $deal->client_id == $client->id ? 'selected' : '' }}>
                                {{ $client->name }}
                            </option>
                        @endforeach
                    </select>
                </div>

                <div class="mb-4">
                    <label class="block text-sm font-medium text-gray-700">Title</label>
                    <input type="text" name="title" value="{{ old('title', $deal->title) }}"
                           class="w-full border-gray-300 rounded-md">
                </div>

                <div class="mb-4">
                    <label class="block text-sm font-medium text-gray-700">Amount</label>
                    <input type="number" step="0.01" name="amount" value="{{ old('amount', $deal->amount) }}"
                           class="w-full border-gray-300 rounded-md">
                </div>

                <div class="mb-4">
                    <label class="block text-sm font-medium text-gray-700">Status</label>
                    <select name="status" class="w-full border-gray-300 rounded-md">
                        <option value="Negotiation" {{ $deal->status == 'Negotiation' ? 'selected' : '' }}>Negotiation</option>
                        <option value="Won" {{ $deal->status == 'Won' ? 'selected' : '' }}>Won</option>
                        <option value="Lost" {{ $deal->status == 'Lost' ? 'selected' : '' }}>Lost</option>
                    </select>
                </div>

                <div class="mb-4">
                    <label class="block text-sm font-medium text-gray-700">Deadline</label>
                    <input type="date" name="deadline" value="{{ old('deadline', $deal->deadline) }}"
                           class="w-full border-gray-300 rounded-md">
                </div>

                <div class="flex justify-between">
                    <a href="{{ route('deals.index') }}" class="px-4 py-2 bg-gray-200 text-gray-800 rounded-md">
                        Cancel
                    </a>
                    <button type="submit" class="px-4 py-2 bg-blue-600 text-white rounded-md">
                        Update
                    </button>
                </div>
            </form>
        </div>
    </div>
</x-app-layout>
