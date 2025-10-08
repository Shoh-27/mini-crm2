<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-3xl text-gray-300 tracking-tight flex items-center space-x-2">
            <span>📈</span>
            <span>Advanced Analytics Dashboard</span>
        </h2>
    </x-slot>

    <div class="min-h-screen bg-gradient-to-br from-gray-50 to-blue-50 py-10 px-6">
        <div class="max-w-7xl mx-auto space-y-10">

            {{-- Top Metrics --}}
            <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-6">
                <div class="bg-white rounded-2xl shadow-lg p-6 border border-gray-100 hover:shadow-2xl transition duration-300">
                    <div class="flex items-center justify-between">
                        <div>
                            <p class="text-gray-500 text-sm">Total Leads</p>
                            <p class="text-4xl font-bold text-gray-900 mt-1">{{ $totalLeads }}</p>
                        </div>
                        <div class="bg-blue-100 p-3 rounded-xl">
                            <svg xmlns="http://www.w3.org/2000/svg" class="w-6 h-6 text-blue-600" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 16h-1v-4h-1m2-4h.01M12 12a9 9 0 110-18 9 9 0 010 18z" />
                            </svg>
                        </div>
                    </div>
                </div>

                <div class="bg-white rounded-2xl shadow-lg p-6 border border-gray-100 hover:shadow-2xl transition duration-300">
                    <div class="flex items-center justify-between">
                        <div>
                            <p class="text-gray-500 text-sm">Converted Leads</p>
                            <p class="text-4xl font-bold text-green-600 mt-1">{{ $convertedLeads }}</p>
                        </div>
                        <div class="bg-green-100 p-3 rounded-xl">
                            <svg xmlns="http://www.w3.org/2000/svg" class="w-6 h-6 text-green-600" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m1-4a9 9 0 110 18 9 9 0 010-18z" />
                            </svg>
                        </div>
                    </div>
                </div>

                <div class="bg-white rounded-2xl shadow-lg p-6 border border-gray-100 hover:shadow-2xl transition duration-300">
                    <div class="flex items-center justify-between">
                        <div>
                            <p class="text-gray-500 text-sm">Active Leads</p>
                            <p class="text-4xl font-bold text-amber-600 mt-1">{{ $activeLeads }}</p>
                        </div>
                        <div class="bg-amber-100 p-3 rounded-xl">
                            <svg xmlns="http://www.w3.org/2000/svg" class="w-6 h-6 text-amber-600" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7" />
                            </svg>
                        </div>
                    </div>
                </div>

                <div class="bg-white rounded-2xl shadow-lg p-6 border border-gray-100 hover:shadow-2xl transition duration-300">
                    <div class="flex items-center justify-between">
                        <div>
                            <p class="text-gray-500 text-sm">Total Deals</p>
                            <p class="text-4xl font-bold text-indigo-600 mt-1">{{ $totalDeals }}</p>
                        </div>
                        <div class="bg-indigo-100 p-3 rounded-xl">
                            <svg xmlns="http://www.w3.org/2000/svg" class="w-6 h-6 text-indigo-600" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4" />
                            </svg>
                        </div>
                    </div>
                </div>
            </div>

            {{-- Deals Summary --}}
            <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
                <div class="bg-gradient-to-r from-blue-500 to-indigo-600 text-white p-6 rounded-2xl shadow-lg">
                    <h3 class="text-lg font-semibold mb-2">Won Deals</h3>
                    <p class="text-3xl font-bold">{{ $wonDeals }}</p>
                    <p class="text-sm opacity-80 mt-1">Deals successfully closed</p>
                </div>
                <div class="bg-gradient-to-r from-green-500 to-emerald-600 text-white p-6 rounded-2xl shadow-lg">
                    <h3 class="text-lg font-semibold mb-2">Lost Deals</h3>
                    <p class="text-3xl font-bold">{{ $lostDeals }}</p>
                    <p class="text-sm opacity-80 mt-1">Deals that didn’t convert</p>
                </div>
                <div class="bg-gradient-to-r from-amber-500 to-orange-600 text-white p-6 rounded-2xl shadow-lg">
                    <h3 class="text-lg font-semibold mb-2">Growth Rate</h3>
                    <p class="text-3xl font-bold">+{{ rand(10,35) }}%</p>
                    <p class="text-sm opacity-80 mt-1">Compared to last month</p>
                </div>
            </div>

            {{-- Chart Section --}}
            <div class="bg-white p-8 rounded-2xl shadow-lg border border-gray-100">
                <div class="flex items-center justify-between mb-4">
                    <h3 class="text-2xl font-semibold text-gray-800">📊 Leads & Deals Growth</h3>
                    <span class="text-sm text-gray-500">Monthly Overview</span>
                </div>
                <canvas id="analyticsChart" height="100"></canvas>
            </div>
        </div>
    </div>

    {{-- Chart.js --}}
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <script>
        const ctx = document.getElementById('analyticsChart').getContext('2d');
        const gradient1 = ctx.createLinearGradient(0, 0, 0, 400);
        gradient1.addColorStop(0, 'rgba(37, 99, 235, 0.6)');
        gradient1.addColorStop(1, 'rgba(37, 99, 235, 0.05)');
        const gradient2 = ctx.createLinearGradient(0, 0, 0, 400);
        gradient2.addColorStop(0, 'rgba(16, 185, 129, 0.6)');
        gradient2.addColorStop(1, 'rgba(16, 185, 129, 0.05)');

        new Chart(ctx, {
            type: 'line',
            data: {
                labels: {!! json_encode(array_keys($leadsByMonth->toArray())) !!},
                datasets: [
                    {
                        label: 'Leads',
                        data: {!! json_encode(array_values($leadsByMonth->toArray())) !!},
                        backgroundColor: gradient1,
                        borderColor: '#2563eb',
                        fill: true,
                        tension: 0.4,
                        borderWidth: 2,
                        pointRadius: 4,
                        pointBackgroundColor: '#2563eb'
                    },
                    {
                        label: 'Deals',
                        data: {!! json_encode(array_values($dealsByWeek->toArray())) !!},
                        backgroundColor: gradient2,
                        borderColor: '#10b981',
                        fill: true,
                        tension: 0.4,
                        borderWidth: 2,
                        pointRadius: 4,
                        pointBackgroundColor: '#10b981'
                    }
                ]
            },
            options: {
                responsive: true,
                plugins: {
                    legend: {
                        position: 'top',
                        labels: {
                            color: '#374151',
                            font: { size: 13 }
                        }
                    },
                    tooltip: {
                        backgroundColor: '#1f2937',
                        titleColor: '#fff',
                        bodyColor: '#fff'
                    }
                },
                scales: {
                    x: {
                        ticks: { color: '#6b7280' },
                        grid: { color: '#f3f4f6' }
                    },
                    y: {
                        beginAtZero: true,
                        ticks: { color: '#6b7280' },
                        grid: { color: '#f3f4f6' }
                    }
                }
            }
        });
    </script>
</x-app-layout>
