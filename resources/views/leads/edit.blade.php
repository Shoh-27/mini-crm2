<x-app-layout>
    <div class="max-w-md mx-auto py-6">
        <h1 class="text-xl font-bold mb-4">Edit Lead</h1>
        <form method="POST" action="{{ route('leads.update',$lead) }}" class="space-y-4">
            @csrf
            @method('PUT')
            <input type="text" name="name" value="{{ $lead->name }}" class="w-full border p-2 rounded" required>
            <input type="email" name="email" value="{{ $lead->email }}" class="w-full border p-2 rounded">
            <input type="text" name="phone" value="{{ $lead->phone }}" class="w-full border p-2 rounded">
            <input type="text" name="company" value="{{ $lead->company }}" class="w-full border p-2 rounded">
            <select name="status" class="w-full border p-2 rounded">
                @foreach(App\Models\Lead::STATUSES as $status)
                    <option value="{{ $status }}" @if($lead->status==$status) selected @endif>{{ $status }}</option>
                @endforeach
            </select>
            <button type="submit" class="bg-blue-500 text-white px-4 py-2 rounded">Update</button>
        </form>
    </div>
</x-app-layout>
