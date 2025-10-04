<x-app-layout>
    <div class="py-6 px-4">
        <h1 class="text-2xl font-bold mb-4">Lead Pipeline</h1>
        <a href="{{ route('leads.create') }}">Create lead</a>
        <div class="grid grid-cols-4 gap-4">
            @foreach(App\Models\Lead::STATUSES as $status)
                <div class="bg-gray-100 p-4 rounded-lg shadow">
                    <h2 class="font-semibold mb-2">{{ $status }}</h2>
                    @foreach($leads[$status] ?? [] as $lead)
                        <div class="bg-white p-2 mb-2 rounded shadow">
                            <p class="font-medium">{{ $lead->name }}</p>
                            <p class="text-sm text-gray-500">{{ $lead->company }}</p>
                            <a href="{{ route('leads.edit',$lead) }}" class="text-blue-500 text-sm">Edit</a>
                        </div>
                    @endforeach
                </div>
            @endforeach
        </div>
    </div>
</x-app-layout>
