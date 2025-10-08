<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800">
            Analytics Overview
        </h2>
    </x-slot>

    <div class="max-w-7xl mx-auto py-6 px-4">
        <!-- Statistic Cards -->
        <div class="grid grid-cols-1 md:grid-cols-3 gap-6 mb-8">
            <div class="bg-white shadow rounded-lg p-6">
                <h3 class="text-gray-600">Total Leads</h3>
                <p class="text-2xl font-bold text-blue-600">{{ $totalLeads }}</p>
            </div>
            <div class="bg-white shadow rounded-lg p-6">
                <h3 class="text-gray-600">Converted Leads</h3>
                <p class="text-2xl font-bold text-green-600">{{ $convertedLeads }}</p>
            </div>
            <div class="bg-white shadow rounded-lg p-6">
                <h3 class="text-gray-600">Active Leads</h3>
                <p class="text-2xl font-bold text-yellow-600">{{ $activeLeads }}</p>
            </div>
        </div>

        <div class="grid grid-cols-1 md:grid-cols-3 gap-6 mb-8">
            <div class="bg-white shadow rounded-lg p-6">
                <h3 class="text-gray-600">Total Deals</h3>
                <p class="text-2xl font-bold text-blue-600">{{ $totalDeals }}</p>
            </div>
            <div class="bg-white shadow rounded-lg p-6">
                <h3 class="text-gray-600">Won Deals</h3>
                <p class="text-2xl font-bold text-green-600">{{ $wonDeals }}</p>
            </div>
            <div class="bg-white shadow rounded-lg p-6">
                <h3 class="text-gray-600">Lost Deals</h3>
                <p class="text-2xl font-bold text-red-600">{{ $lostDeals }}</p>
            </div>
        </div>

        <!-- Charts -->
        <div class="bg-white shadow rounded-lg p-6">
            <h3 class="text-lg font-semibold text-gray-800 mb-4">Leads & Deals Overview</h3>
            <canvas id="analyticsChart" height="120"></canvas>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <script>
        const ctx = document.getElementById('analyticsChart').getContext('2d');
        new Chart(ctx, {
            type: 'line',
            data: {
                labels: {!! json_encode(array_keys($leadsByMonth->toArray())) !!},
                datasets: [
                    {
                        label: 'Leads per Month',
                        data: {!! json_encode(array_values($leadsByMonth->toArray())) !!},
                        borderColor: 'rgba(37, 99, 235, 1)',
                        tension: 0.3,
                    },
                    {
                        label: 'Deals per Week (Amount)',
                        data: {!! json_encode(array_values($dealsByWeek->toArray())) !!},
                        borderColor: 'rgba(34, 197, 94, 1)',
                        tension: 0.3,
                    }
                ]
            },
            options: {
                responsive: true,
                plugins: {
                    legend: { position: 'bottom' }
                }
            }
        });
    </script>
</x-app-layout>

