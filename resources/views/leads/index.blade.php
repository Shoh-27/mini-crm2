<x-app-layout>
    <div class="max-w-7xl mx-auto py-8 px-4">
        <div class="flex justify-between items-center mb-6">
            <h1 class="text-3xl font-bold text-white tracking-wide">Lead Pipeline</h1>
            <a href="{{ route('leads.create') }}"
               class="inline-block px-5 py-2.5 bg-blue-600 hover:bg-blue-700 text-white font-semibold rounded-lg shadow transition">
                + Create Lead
            </a>
        </div>

        <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-4 gap-6">
            @foreach(App\Models\Lead::STATUSES as $status)
                <div class="bg-gradient-to-br from-gray-800 to-gray-900 border border-gray-700 rounded-2xl shadow-lg p-4">
                    <h2 class="text-lg font-semibold text-blue-400 mb-3 border-b border-gray-700 pb-2">
                        {{ ucfirst($status) }}
                    </h2>

                    @forelse($leads[$status] ?? [] as $lead)
                        <div class="bg-gray-800/70 hover:bg-gray-700 transition rounded-lg p-3 mb-3 shadow-sm">
                            <p class="font-medium text-gray-100">{{ $lead->name }}</p>
                            <p class="text-sm text-gray-400 mb-2">{{ $lead->company }}</p>

                            <div class="flex space-x-3 text-sm">
                                <a href="{{ route('leads.show', $lead) }}"
                                   class="text-blue-400 hover:text-blue-300 font-medium">View</a>
                                <a href="{{ route('leads.edit', $lead) }}"
                                   class="text-green-400 hover:text-green-300 font-medium">Edit</a>
                            </div>
                        </div>
                    @empty
                        <p class="text-gray-500 text-sm italic">No leads yet</p>
                    @endforelse
                </div>
            @endforeach
        </div>
    </div>
</x-app-layout>
