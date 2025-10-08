<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-2xl text-white">
            Deals
        </h2>
    </x-slot>

    <div class="max-w-7xl mx-auto py-8 sm:px-6 lg:px-8">
        <!-- Add Deal button -->
        <a href="{{ route('deals.create') }}"
           class="inline-block mb-6 px-5 py-2.5 bg-blue-600 hover:bg-blue-700 text-white font-semibold rounded-lg shadow transition">
            + New Deal
        </a>

        <!-- Deals table -->
        <div class="bg-gradient-to-br from-gray-800 to-gray-900 text-gray-100 rounded-2xl shadow-xl p-6 overflow-hidden border border-gray-700">
            <table class="min-w-full table-auto border-collapse">
                <thead>
                <tr class="bg-blue-700 text-white text-left text-sm uppercase tracking-wider">
                    <th class="px-4 py-3">Client</th>
                    <th class="px-4 py-3">Title</th>
                    <th class="px-4 py-3">Amount</th>
                    <th class="px-4 py-3">Status</th>
                    <th class="px-4 py-3">Deadline</th>
                    <th class="px-4 py-3 text-center">Actions</th>
                </tr>
                </thead>
                <tbody class="divide-y divide-gray-700">
                @forelse ($deals as $deal)
                    <tr class="hover:bg-gray-800 transition">
                        <td class="px-4 py-3">{{ $deal->client->name }}</td>
                        <td class="px-4 py-3 font-medium text-gray-200">{{ $deal->title }}</td>
                        <td class="px-4 py-3">${{ number_format($deal->amount, 2) }}</td>
                        <td class="px-4 py-3">
                            @if($deal->status == 'Negotiation')
                                <span class="px-2 py-1 bg-yellow-500/20 text-yellow-400 rounded-md text-xs font-semibold">
                                        Negotiation
                                    </span>
                            @elseif($deal->status == 'Won')
                                <span class="px-2 py-1 bg-green-500/20 text-green-400 rounded-md text-xs font-semibold">
                                        Won
                                    </span>
                            @else
                                <span class="px-2 py-1 bg-red-500/20 text-red-400 rounded-md text-xs font-semibold">
                                        Lost
                                    </span>
                            @endif
                        </td>
                        <td class="px-4 py-3 text-gray-400">{{ $deal->deadline }}</td>
                        <td class="px-4 py-3 text-center space-x-3">
                            <a href="{{ route('deals.show', $deal) }}" class="text-blue-400 hover:text-blue-300 font-medium">View</a>
                            <a href="{{ route('deals.edit', $deal) }}" class="text-green-400 hover:text-green-300 font-medium">Edit</a>
                            <form action="{{ route('deals.destroy', $deal) }}" method="POST" class="inline">
                                @csrf @method('DELETE')
                                <button class="text-red-400 hover:text-red-300 font-medium"
                                        onclick="return confirm('Delete this deal?')">
                                    Delete
                                </button>
                            </form>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="6" class="text-center py-6 text-gray-400">
                            No deals found.
                        </td>
                    </tr>
                @endforelse
                </tbody>
            </table>
        </div>
    </div>
</x-app-layout>
