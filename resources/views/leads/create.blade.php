<x-app-layout>
    <div class="max-w-md mx-auto py-6">
        <h1 class="text-xl font-bold mb-4">Add Lead</h1>
        <form method="POST" action="{{ route('leads.store') }}" class="space-y-4">
            @csrf
            <input type="text" name="name" placeholder="Name" class="w-full border p-2 rounded" required>
            <input type="email" name="email" placeholder="Email" class="w-full border p-2 rounded">
            <input type="text" name="phone" placeholder="Phone" class="w-full border p-2 rounded">
            <input type="text" name="company" placeholder="Company" class="w-full border p-2 rounded">
            <button type="submit" class="bg-blue-500 text-white px-4 py-2 rounded">Save</button>
        </form>
    </div>
</x-app-layout>
