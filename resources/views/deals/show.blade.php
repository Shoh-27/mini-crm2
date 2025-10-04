<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800">
            Deal Details
        </h2>
    </x-slot>

    <div class="max-w-5xl mx-auto py-6">
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
    </div>
</x-app-layout>

