<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800">
            Deals
        </h2>
    </x-slot>

    <div class="max-w-7xl mx-auto py-6 sm:px-6 lg:px-8">
        <a href="{{ route('deals.create') }}"
           class="px-4 py-2 bg-blue-600 text-white rounded-md mb-4 inline-block">+ New Deal</a>

        <div class="bg-white shadow rounded-lg p-6">
            <table class="min-w-full table-auto">
                <thead>
                <tr class="bg-gray-100">
                    <th class="px-4 py-2">Client</th>
                    <th class="px-4 py-2">Title</th>
                    <th class="px-4 py-2">Amount</th>
                    <th class="px-4 py-2">Status</th>
                    <th class="px-4 py-2">Deadline</th>
                    <th class="px-4 py-2">Actions</th>
                </tr>
                </thead>
                <tbody>
                @foreach ($deals as $deal)
                    <tr class="border-b">
                        <td class="px-4 py-2">{{ $deal->client->name }}</td>
                        <td class="px-4 py-2">{{ $deal->title }}</td>
                        <td class="px-4 py-2">${{ number_format($deal->amount, 2) }}</td>
                        <td class="px-4 py-2">
                            @if($deal->status == 'Negotiation')
                                <span class="px-2 py-1 bg-yellow-200 text-yellow-800 rounded">Negotiation</span>
                            @elseif($deal->status == 'Won')
                                <span class="px-2 py-1 bg-green-200 text-green-800 rounded">Won</span>
                            @else
                                <span class="px-2 py-1 bg-red-200 text-red-800 rounded">Lost</span>
                            @endif
                        </td>
                        <td class="px-4 py-2">{{ $deal->deadline }}</td>
                        <td class="px-4 py-2 space-x-2">
                            <a href="{{ route('deals.show', $deal) }}" class="text-blue-600">View</a>
                            <a href="{{ route('deals.edit', $deal) }}" class="text-green-600">Edit</a>
                            <form action="{{ route('deals.destroy', $deal) }}" method="POST" class="inline">
                                @csrf @method('DELETE')
                                <button class="text-red-600" onclick="return confirm('Delete this deal?')">Delete</button>
                            </form>
                        </td>
                    </tr>
                @endforeach
                </tbody>
            </table>
        </div>
    </div>
</x-app-layout>

