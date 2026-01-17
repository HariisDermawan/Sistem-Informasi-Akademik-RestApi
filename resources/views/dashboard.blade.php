<!-- dashboard.blade.php -->
@extends('layouts.app')

@section('content')
    <div class="max-w-7xl mx-auto">
        <!-- Welcome Banner dengan Jam Realtime -->
        <div class="mb-8">
            <div
                class="bg-gradient-to-r from-blue-500 to-purple-600 rounded-2xl p-6 md:p-8 shadow-lg relative overflow-hidden">
                <!-- Background Pattern -->
                <div class="absolute top-0 right-0 w-64 h-64 opacity-10">
                    <svg viewBox="0 0 200 200" xmlns="http://www.w3.org/2000/svg">
                        <path fill="white"
                            d="M45.8,-45.8C58.5,-33.1,67.5,-16.5,67.4,-0.1C67.2,16.4,57.9,32.7,45.2,45.2C32.7,57.9,16.4,67.2,0,67.2C-16.4,67.2,-32.7,57.9,-45.2,45.2C-57.9,32.7,-67.2,16.4,-67.2,0C-67.2,-16.4,-57.9,-32.7,-45.2,-45.2C-32.7,-57.9,-16.4,-67.2,0,-67.2C16.4,-67.2,32.7,-57.9,45.8,-45.8Z"
                            transform="translate(100 100)" />
                    </svg>
                </div>

                <div class="flex flex-col md:flex-row md:items-center justify-between relative z-10">
                    <div>

                        <h1 class="text-2xl md:text-3xl font-bold text-white mb-4">Selamat Datang, Admin! 👋</h1>
                        <p class="text-blue-100 max-w-2xl">Pantau dan kelola data akademik dengan mudah. Sistem telah
                            berjalan selama <span class="font-semibold">24 jam</span> tanpa gangguan.</p>
                    </div>

                    <!-- Jam Realtime Dashboard -->
                    <div class="mt-6 md:mt-0">
                        <div class="bg-white/20 backdrop-blur-sm rounded-xl p-5 clock-container">
                            <div class="text-center">
                                <div id="dashboardTime" class="text-4xl md:text-5xl font-bold text-white mb-2 clock-digit">
                                    <span id="dashboardHours">00</span>
                                    <span class="clock-colon">:</span>
                                    <span id="dashboardMinutes">00</span>
                                    <span class="clock-colon">:</span>
                                    <span id="dashboardSeconds">00</span>
                                </div>
                                <div class="text-white/90">
                                    <span id="dashboardDay" class="font-medium">Senin</span>,
                                    <span id="dashboardDate">1 Januari 2024</span>
                                </div>
                            </div>
                        </div>
                    </div>



                </div>
            </div>
        </div>

        <!-- System Status -->
        <div class="grid grid-cols-1 md:grid-cols-3 gap-6 mb-8">
            <div class="bg-white rounded-xl shadow-lg p-6 card-hover transition-all duration-300">
                <div class="flex items-center justify-between">
                    <div>
                        <p class="text-gray-500 text-sm font-medium mb-2">Server Status</p>
                        <h3 class="text-2xl font-bold text-gray-900">Online</h3>
                        <div class="flex items-center mt-3">
                            <span class="w-2 h-2 bg-green-500 rounded-full mr-2 animate-pulse"></span>
                            <span class="text-sm text-gray-600">Response: <span id="responseTime">125ms</span></span>
                        </div>
                    </div>
                    <div class="bg-green-100 p-4 rounded-xl">
                        <svg class="w-8 h-8 text-green-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path>
                        </svg>
                    </div>
                </div>
            </div>

            <div class="bg-white rounded-xl shadow-lg p-6 card-hover transition-all duration-300">
                <div class="flex items-center justify-between">
                    <div>
                        <p class="text-gray-500 text-sm font-medium mb-2">Last Update</p>
                        <h3 class="text-2xl font-bold text-gray-900" id="lastUpdateTime">00:00:00</h3>
                        <div class="flex items-center mt-3">
                            <span class="w-2 h-2 bg-blue-500 rounded-full mr-2"></span>
                            <span class="text-sm text-gray-600">Auto-sync active</span>
                        </div>
                    </div>
                    <div class="bg-blue-100 p-4 rounded-xl">
                        <svg class="w-8 h-8 text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M4 4v5h.582m15.356 2A8.001 8.001 0 004.582 9m0 0H9m11 11v-5h-.581m0 0a8.003 8.003 0 01-15.357-2m15.357 2H15">
                            </path>
                        </svg>
                    </div>
                </div>
            </div>

            <div class="bg-white rounded-xl shadow-lg p-6 card-hover transition-all duration-300">
                <div class="flex items-center justify-between">
                    <div>
                        <p class="text-gray-500 text-sm font-medium mb-2">Live Sessions</p>
                        <h3 class="text-2xl font-bold text-gray-900" id="liveSessions">1</h3>
                        <div class="flex items-center mt-3">
                            <span class="w-2 h-2 bg-purple-500 rounded-full mr-2"></span>
                            <span class="text-sm text-gray-600">You're online</span>
                        </div>
                    </div>
                    <div class="bg-purple-100 p-4 rounded-xl">
                        <svg class="w-8 h-8 text-purple-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M13 10V3L4 14h7v7l9-11h-7z"></path>
                        </svg>
                    </div>
                </div>
            </div>
        </div>

        <!-- Quick Stats -->
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6 mb-8">
            <!-- Total Mahasiswa -->
            <div class="bg-white rounded-xl shadow-lg p-6 card-hover transition-all duration-300">
                <div class="flex items-center justify-between">
                    <div>
                        <p class="text-gray-500 text-sm font-medium mb-2">Total Mahasiswa</p>
                        <h3 class="text-3xl font-bold text-gray-900">{{ $mahasiswaCount }}</h3>
                        <div class="flex items-center mt-3">
                            <span class="w-2 h-2 bg-green-500 rounded-full mr-2"></span>
                            <span class="text-sm text-gray-600">Aktif</span>
                        </div>
                    </div>
                    <div class="bg-blue-100 p-4 rounded-xl">
                        <svg class="w-8 h-8 text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197m13.5 1.5a9 9 0 11-18 0 9 9 0 0118 0z">
                            </path>
                        </svg>
                    </div>
                </div>
            </div>

            <!-- Total Dosen -->
            <div class="bg-white rounded-xl shadow-lg p-6 card-hover transition-all duration-300">
                <div class="flex items-center justify-between">
                    <div>
                        <p class="text-gray-500 text-sm font-medium mb-2">Total Dosen</p>
                        <h3 class="text-3xl font-bold text-gray-900">{{ $dosenCount }}</h3>
                        <div class="flex items-center mt-3">
                            <span class="w-2 h-2 bg-blue-500 rounded-full mr-2"></span>
                            <span class="text-sm text-gray-600">Pengajar</span>
                        </div>
                    </div>
                    <div class="bg-purple-100 p-4 rounded-xl">
                        <svg class="w-8 h-8 text-purple-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z">
                            </path>
                        </svg>
                    </div>
                </div>
            </div>

            <!-- Quick Actions -->
            <div class="bg-white rounded-xl shadow-lg p-6 card-hover transition-all duration-300 lg:col-span-2">
                <h3 class="font-semibold text-gray-900 mb-4">Quick Actions</h3>
                <div class="grid grid-cols-2 gap-4">
                    <a href="{{ url('/mahasiswa/create') }}"
                        class="bg-gradient-to-r from-blue-500 to-blue-600 text-white p-4 rounded-lg flex items-center justify-center space-x-2 hover:shadow-lg transition-shadow">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M12 6v6m0 0v6m0-6h6m-6 0H6"></path>
                        </svg>
                        <span>Tambah Mahasiswa</span>
                    </a>
                    <a href="{{ url('/dosen/create') }}"
                        class="bg-gradient-to-r from-purple-500 to-purple-600 text-white p-4 rounded-lg flex items-center justify-center space-x-2 hover:shadow-lg transition-shadow">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M12 6v6m0 0v6m0-6h6m-6 0H6"></path>
                        </svg>
                        <span>Tambah Dosen</span>
                    </a>
                </div>
            </div>
        </div>

        <!-- Recent Data Section -->
        <div class="grid grid-cols-1 lg:grid-cols-2 gap-8">
            <!-- Recent Mahasiswa -->
            <div class="bg-white rounded-xl shadow-lg overflow-hidden">
                <div class="p-6 border-b border-gray-100">
                    <div class="flex items-center justify-between">
                        <div class="flex items-center space-x-3">
                            <div class="bg-blue-100 p-2 rounded-lg">
                                <svg class="w-5 h-5 text-blue-600" fill="none" stroke="currentColor"
                                    viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197m13.5 1.5a9 9 0 11-18 0 9 9 0 0118 0z">
                                    </path>
                                </svg>
                            </div>
                            <div>
                                <h2 class="text-xl font-bold text-gray-900">Mahasiswa Terbaru</h2>
                                <p class="text-sm text-gray-500">{{ count($recentMahasiswa) }} data terbaru • Update: <span
                                        id="mahasiswaUpdateTime">00:00:00</span></p>
                            </div>
                        </div>
                        <a href="{{ url('/mahasiswa') }}"
                            class="text-blue-600 hover:text-blue-800 font-medium text-sm flex items-center">
                            Lihat semua
                            <svg class="w-4 h-4 ml-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7">
                                </path>
                            </svg>
                        </a>
                    </div>
                </div>
                <div class="overflow-x-auto">
                    <table class="w-full">
                        <thead>
                            <tr class="bg-gray-50">
                                <th class="py-3 px-6 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                    NIM</th>
                                <th class="py-3 px-6 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                    Nama</th>
                                <th class="py-3 px-6 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                    Aksi</th>
                            </tr>
                        </thead>
                        <tbody class="divide-y divide-gray-100">
                            @foreach ($recentMahasiswa as $m)
                                <tr class="table-row-hover transition-colors duration-200">
                                    <td class="py-4 px-6">
                                        <div class="flex items-center">
                                            <div
                                                class="bg-blue-100 text-blue-800 text-xs font-medium px-3 py-1 rounded-full">
                                                {{ $m->nim }}
                                            </div>
                                        </div>
                                    </td>
                                    <td class="py-4 px-6">
                                        <div class="flex items-center">
                                            <div
                                                class="w-8 h-8 bg-gradient-to-br from-blue-400 to-blue-600 rounded-full flex items-center justify-center text-white text-sm font-bold mr-3">
                                                {{ substr($m->nama, 0, 1) }}
                                            </div>
                                            <div>
                                                <p class="font-medium text-gray-900">{{ $m->nama }}</p>
                                                <p class="text-xs text-gray-500">{{ $m->jurusan }}</p>
                                            </div>
                                        </div>
                                    </td>
                                    <td class="py-4 px-6">
                                        <div class="flex space-x-2">
                                            <button
                                                class="text-blue-600 hover:text-blue-800 p-2 hover:bg-blue-50 rounded-lg transition-colors">
                                                <svg class="w-4 h-4" fill="none" stroke="currentColor"
                                                    viewBox="0 0 24 24">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                        d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"></path>
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                        d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z">
                                                    </path>
                                                </svg>
                                            </button>
                                            <button
                                                class="text-green-600 hover:text-green-800 p-2 hover:bg-green-50 rounded-lg transition-colors">
                                                <svg class="w-4 h-4" fill="none" stroke="currentColor"
                                                    viewBox="0 0 24 24">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                        d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z">
                                                    </path>
                                                </svg>
                                            </button>
                                        </div>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>

            <!-- Recent Dosen -->
            <div class="bg-white rounded-xl shadow-lg overflow-hidden">
                <div class="p-6 border-b border-gray-100">
                    <div class="flex items-center justify-between">
                        <div class="flex items-center space-x-3">
                            <div class="bg-purple-100 p-2 rounded-lg">
                                <svg class="w-5 h-5 text-purple-600" fill="none" stroke="currentColor"
                                    viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z">
                                    </path>
                                </svg>
                            </div>
                            <div>
                                <h2 class="text-xl font-bold text-gray-900">Dosen Terbaru</h2>
                                <p class="text-sm text-gray-500">{{ count($recentDosen) }} data terbaru • Update: <span
                                        id="dosenUpdateTime">00:00:00</span></p>
                            </div>
                        </div>
                        <a href="{{ url('/dosen') }}"
                            class="text-purple-600 hover:text-purple-800 font-medium text-sm flex items-center">
                            Lihat semua
                            <svg class="w-4 h-4 ml-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7">
                                </path>
                            </svg>
                        </a>
                    </div>
                </div>
                <div class="overflow-x-auto">
                    <table class="w-full">
                        <thead>
                            <tr class="bg-gray-50">
                                <th class="py-3 px-6 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                    NIP</th>
                                <th class="py-3 px-6 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                    Nama</th>
                                <th class="py-3 px-6 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                    Aksi</th>
                            </tr>
                        </thead>
                        <tbody class="divide-y divide-gray-100">
                            @foreach ($recentDosen as $d)
                                <tr class="table-row-hover transition-colors duration-200">
                                    <td class="py-4 px-6">
                                        <div class="flex items-center">
                                            <div
                                                class="bg-purple-100 text-purple-800 text-xs font-medium px-3 py-1 rounded-full">
                                                {{ $d->nip }}
                                            </div>
                                        </div>
                                    </td>
                                    <td class="py-4 px-6">
                                        <div class="flex items-center">
                                            <div
                                                class="w-8 h-8 bg-gradient-to-br from-purple-400 to-purple-600 rounded-full flex items-center justify-center text-white text-sm font-bold mr-3">
                                                {{ substr($d->nama, 0, 1) }}
                                            </div>
                                            <div>
                                                <p class="font-medium text-gray-900">{{ $d->nama }}</p>
                                                <p class="text-xs text-gray-500">{{ $d->jurusan }}</p>
                                            </div>
                                        </div>
                                    </td>
                                    <td class="py-4 px-6">
                                        <div class="flex space-x-2">
                                            <button
                                                class="text-blue-600 hover:text-blue-800 p-2 hover:bg-blue-50 rounded-lg transition-colors">
                                                <svg class="w-4 h-4" fill="none" stroke="currentColor"
                                                    viewBox="0 0 24 24">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                        d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"></path>
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                        d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z">
                                                    </path>
                                                </svg>
                                            </button>
                                            <button
                                                class="text-green-600 hover:text-green-800 p-2 hover:bg-green-50 rounded-lg transition-colors">
                                                <svg class="w-4 h-4" fill="none" stroke="currentColor"
                                                    viewBox="0 0 24 24">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                        d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z">
                                                    </path>
                                                </svg>
                                            </button>
                                        </div>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>

        <!-- Live Activity -->
        <div class="mt-8 bg-white rounded-xl shadow-lg p-6">
            <div class="flex items-center justify-between mb-6">
                <h2 class="text-xl font-bold text-gray-900">Live Activity Monitor</h2>
                <div class="flex items-center space-x-2">
                    <span class="w-2 h-2 bg-green-500 rounded-full animate-pulse"></span>
                    <span class="text-sm text-gray-600">Live</span>
                </div>
            </div>
            <div class="space-y-4">
                <div class="flex items-center justify-between p-4 bg-gray-50 rounded-lg">
                    <div class="flex items-center space-x-3">
                        <div class="bg-blue-100 p-2 rounded-lg">
                            <svg class="w-5 h-5 text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M12 15v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2zm10-10V7a4 4 0 00-8 0v4h8z">
                                </path>
                            </svg>
                        </div>
                        <div>
                            <p class="font-medium text-gray-900">System Status</p>
                            <p class="text-sm text-gray-500">All systems operational</p>
                        </div>
                    </div>
                    <div class="text-right">
                        <p class="text-sm font-medium text-gray-900" id="uptimeCounter">24:05:33</p>
                        <p class="text-xs text-gray-500">Uptime</p>
                    </div>
                </div>
                <div class="grid grid-cols-1 md:grid-cols-3 gap-4">
                    <div class="p-4 border border-gray-200 rounded-lg">
                        <p class="text-sm text-gray-500 mb-1">Memory Usage</p>
                        <div class="flex items-center justify-between">
                            <p class="text-lg font-bold text-gray-900">62%</p>
                            <div class="w-24 h-2 bg-gray-200 rounded-full overflow-hidden">
                                <div class="h-full bg-green-500 rounded-full" style="width: 62%"></div>
                            </div>
                        </div>
                    </div>
                    <div class="p-4 border border-gray-200 rounded-lg">
                        <p class="text-sm text-gray-500 mb-1">CPU Load</p>
                        <div class="flex items-center justify-between">
                            <p class="text-lg font-bold text-gray-900">28%</p>
                            <div class="w-24 h-2 bg-gray-200 rounded-full overflow-hidden">
                                <div class="h-full bg-blue-500 rounded-full" style="width: 28%"></div>
                            </div>
                        </div>
                    </div>
                    <div class="p-4 border border-gray-200 rounded-lg">
                        <p class="text-sm text-gray-500 mb-1">Active Users</p>
                        <div class="flex items-center justify-between">
                            <p class="text-lg font-bold text-gray-900" id="activeUsers">15</p>
                            <div class="w-24 h-2 bg-gray-200 rounded-full overflow-hidden">
                                <div class="h-full bg-purple-500 rounded-full" style="width: 45%"></div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script>
        // Function untuk update update times
        function updateTimestamps() {
            const now = new Date();
            const timeString = now.toLocaleTimeString('id-ID', {
                hour12: false
            });

            // Update last update time
            const lastUpdateTime = document.getElementById('lastUpdateTime');
            if (lastUpdateTime) {
                lastUpdateTime.textContent = timeString;
            }

            // Update mahasiswa update time
            const mahasiswaUpdateTime = document.getElementById('mahasiswaUpdateTime');
            if (mahasiswaUpdateTime) {
                mahasiswaUpdateTime.textContent = timeString;
            }

            // Update dosen update time
            const dosenUpdateTime = document.getElementById('dosenUpdateTime');
            if (dosenUpdateTime) {
                dosenUpdateTime.textContent = timeString;
            }

            // Update response time secara acak (simulasi)
            const responseTime = document.getElementById('responseTime');
            if (responseTime) {
                const randomTime = Math.floor(Math.random() * 50) + 75;
                responseTime.textContent = `${randomTime}ms`;
            }

            // Update active users secara acak (simulasi)
            const activeUsers = document.getElementById('activeUsers');
            if (activeUsers) {
                const randomUsers = Math.floor(Math.random() * 5) + 12;
                activeUsers.textContent = randomUsers;
            }

            // Update live sessions
            const liveSessions = document.getElementById('liveSessions');
            if (liveSessions) {
                const randomSessions = Math.floor(Math.random() * 3) + 1;
                liveSessions.textContent = randomSessions;
            }
        }

        // Function untuk update uptime counter
        function updateUptimeCounter() {
            const uptimeCounter = document.getElementById('uptimeCounter');
            if (uptimeCounter) {
                // Simulasi uptime bertambah
                const current = uptimeCounter.textContent.split(':');
                let hours = parseInt(current[0]);
                let minutes = parseInt(current[1]);
                let seconds = parseInt(current[2]);

                seconds++;
                if (seconds >= 60) {
                    seconds = 0;
                    minutes++;
                    if (minutes >= 60) {
                        minutes = 0;
                        hours++;
                    }
                }

                uptimeCounter.textContent =
                    String(hours).padStart(2, '0') + ':' +
                    String(minutes).padStart(2, '0') + ':' +
                    String(seconds).padStart(2, '0');
            }
        }

        // Inisialisasi update times
        updateTimestamps();
        setInterval(updateTimestamps, 5000); // Update setiap 5 detik
        setInterval(updateUptimeCounter, 1000); // Update uptime setiap detik

        // Tambahkan efek pada greeting berdasarkan waktu
        function updateGreetingEffects() {
            const greeting = document.getElementById('greeting');
            if (greeting) {
                const hour = new Date().getHours();
                let emoji = "🌅";

                if (hour < 11) emoji = "🌅";
                else if (hour < 15) emoji = "☀️";
                else if (hour < 19) emoji = "🌇";
                else emoji = "🌙";

                const greetingText = greeting.textContent.replace(/^[^\s]+\s/, emoji + ' ');
                greeting.textContent = greetingText;
            }
        }

        updateGreetingEffects();
        setInterval(updateGreetingEffects, 60000); // Update setiap menit
    </script>
@endsection
