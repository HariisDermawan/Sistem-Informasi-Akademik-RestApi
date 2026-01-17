<!-- layouts/app.blade.php -->
<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>Sistem Akademik</title>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    <script src="https://cdn.tailwindcss.com"></script>
    <style>
        * {
            font-family: 'Inter', sans-serif;
        }

        .sidebar-item.active {
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            color: white;
            box-shadow: 0 4px 6px -1px rgba(102, 126, 234, 0.2);
        }

        .sidebar-item.active .sidebar-icon {
            color: white;
        }

        .sidebar-item:hover:not(.active) {
            background-color: #f8fafc;
            transform: translateX(4px);
        }

        .card-hover:hover {
            transform: translateY(-4px);
            box-shadow: 0 20px 25px -5px rgba(0, 0, 0, 0.1), 0 10px 10px -5px rgba(0, 0, 0, 0.04);
        }

        .avatar-gradient {
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
        }

        .stat-gradient-blue {
            background: linear-gradient(135deg, #3b82f6 0%, #1d4ed8 100%);
        }

        .stat-gradient-purple {
            background: linear-gradient(135deg, #8b5cf6 0%, #7c3aed 100%);
        }

        .table-row-hover:hover {
            background: linear-gradient(90deg, rgba(59, 130, 246, 0.05) 0%, rgba(59, 130, 246, 0.02) 100%);
        }

        .mobile-menu {
            backdrop-filter: blur(10px);
            background: rgba(255, 255, 255, 0.95);
        }

        .clock-container {
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            color: white;
            box-shadow: 0 10px 15px -3px rgba(102, 126, 234, 0.3);
        }

        .clock-digit {
            font-variant-numeric: tabular-nums;
            text-shadow: 0 2px 4px rgba(0, 0, 0, 0.3);
        }

        .clock-colon {
            animation: blink 1s infinite;
        }

        @keyframes blink {

            0%,
            100% {
                opacity: 1;
            }

            50% {
                opacity: 0.3;
            }
        }

        .time-update {
            animation: fadeIn 0.5s ease-in-out;
        }

        @keyframes fadeIn {
            from {
                opacity: 0;
                transform: translateY(-5px);
            }

            to {
                opacity: 1;
                transform: translateY(0);
            }
        }
    </style>
</head>

<body class="bg-gray-50">
    <!-- Mobile Menu Button -->
    <div class="lg:hidden fixed top-4 left-4 z-50">
        <button id="mobileMenuButton" class="bg-white p-3 rounded-xl shadow-lg">
            <svg class="w-6 h-6 text-gray-700" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16">
                </path>
            </svg>
        </button>
    </div>

    <!-- Sidebar -->
    <div id="sidebar"
        class="fixed left-0 top-0 h-full w-64 bg-white shadow-xl transform -translate-x-full lg:translate-x-0 transition-transform duration-300 z-40">
        <!-- Logo -->
        <!-- Logo & Header -->
        <div class="p-6 border-b border-gray-100">
            <div class="flex items-center space-x-3">
                <!-- Logo Image -->
                <div class="w-16 h-16 flex items-center justify-center">
                    <img src="{{ asset('img/unpam.png') }}" alt="UNPAM Logo" class="object-contain h-full w-full">
                </div>
                <!-- Judul & Subjudul -->
                <div>
                    <h2 class="text-xl font-bold text-gray-900">Sistem Akademik</h2>
                </div>
            </div>
        </div>


        <!-- Navigation Menu -->
        <div class="p-4">
            <nav class="space-y-2">
                <a href="{{ url('/dashboard') }}"
                    class="sidebar-item flex items-center space-x-3 p-3 rounded-xl transition-all duration-200 active">
                    <div class="sidebar-icon">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6">
                            </path>
                        </svg>
                    </div>
                    <span class="font-medium">Dashboard</span>
                </a>

                <a href="{{ url('/mahasiswa') }}"
                    class="sidebar-item flex items-center space-x-3 p-3 rounded-xl transition-all duration-200">
                    <div class="sidebar-icon text-blue-600">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197m13.5 1.5a9 9 0 11-18 0 9 9 0 0118 0z">
                            </path>
                        </svg>
                    </div>
                    <span class="font-medium text-gray-700">Mahasiswa</span>
                    <span
                        class="ml-auto bg-blue-100 text-blue-800 text-xs font-medium px-2 py-1 rounded-full">{{ $mahasiswaCount ?? 0 }}</span>
                </a>

                <a href="{{ url('/dosen') }}"
                    class="sidebar-item flex items-center space-x-3 p-3 rounded-xl transition-all duration-200">
                    <div class="sidebar-icon text-purple-600">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z">
                            </path>
                        </svg>
                    </div>
                    <span class="font-medium text-gray-700">Dosen</span>
                    <span
                        class="ml-auto bg-purple-100 text-purple-800 text-xs font-medium px-2 py-1 rounded-full">{{ $dosenCount ?? 0 }}</span>
                </a>
            </nav>
        </div>


<!-- Footer Sidebar dengan Logout Button -->
<div class="absolute bottom-0 w-full p-6 border-t border-gray-100 bg-white">
    <div class="flex items-center justify-between">
        <!-- Settings Link -->
        <a href="#" class="flex items-center space-x-2 p-2 rounded-lg hover:bg-gray-100 transition-colors group">
            <div class="w-8 h-8 bg-gray-100 rounded-lg flex items-center justify-center group-hover:bg-blue-50 group-hover:text-blue-600 transition-colors">
                <svg class="w-4 h-4 text-gray-600 group-hover:text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                        d="M10.325 4.317c.426-1.756 2.924-1.756 3.35 0a1.724 1.724 0 002.573 1.066c1.543-.94 3.31.826 2.37 2.37a1.724 1.724 0 001.065 2.572c1.756.426 1.756 2.924 0 3.35a1.724 1.724 0 00-1.066 2.573c.94 1.543-.826 3.31-2.37 2.37a1.724 1.724 0 00-2.572 1.065c-.426 1.756-2.924 1.756-3.35 0a1.724 1.724 0 00-2.573-1.066c-1.543.94-3.31-.826-2.37-2.37a1.724 1.724 0 00-1.065-2.572c-1.756-.426-1.756-2.924 0-3.35a1.724 1.724 0 001.066-2.573c-.94-1.543.826-3.31 2.37-2.37.996.608 2.296.07 2.572-1.065z">
                    </path>
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                        d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"></path>
                </svg>
            </div>
            <span class="text-sm text-gray-600 group-hover:text-gray-900 font-medium">Settings</span>
        </a>
        
        <!-- Logout Button -->
        <form id="logout-form" action="{{ route('logout') }}" method="POST">
            @csrf
            <button type="submit"
                    onclick="return confirm('Apakah Anda yakin ingin logout?');"
                    class="flex items-center space-x-2 px-4 py-2 bg-red-50 text-red-600 hover:bg-red-100 rounded-lg transition-colors group">
                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                        d="M17 16l4-4m0 0l-4-4m4 4H7m6 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h4a3 3 0 013 3v1">
                    </path>
                </svg>
                <span class="text-sm font-medium">Logout</span>
            </button>
        </form>
    </div>
</div>

        
    </div>

    <!-- Main Content -->
    <div class="lg:ml-64">
        <!-- Top Navbar -->
        <div class="bg-white shadow-sm border-b border-gray-100 sticky top-0 z-30">
            <div class="px-6 py-4">
                <div class="flex items-center justify-between">
                    <div class="flex items-center space-x-4">
                        <h1 class="text-2xl font-bold text-gray-900">Dashboard</h1>
                        <div class="hidden md:flex items-center space-x-2">
                            <span class="text-gray-400">•</span>
                            <span class="text-sm text-gray-600">Sistem Informasi Akademik</span>
                        </div>
                    </div>

                    <div class="flex items-center space-x-4">
                        <!-- Notifications -->
                        <button class="relative p-2 text-gray-600 hover:text-gray-900 hover:bg-gray-100 rounded-lg">
                            <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M15 17h5l-1.405-1.405A2.032 2.032 0 0118 14.158V11a6.002 6.002 0 00-4-5.659V5a2 2 0 10-4 0v.341C7.67 6.165 6 8.388 6 11v3.159c0 .538-.214 1.055-.595 1.436L4 17h5m6 0v1a3 3 0 11-6 0v-1m6 0H9">
                                </path>
                            </svg>
                            <span class="absolute top-1 right-1 w-2 h-2 bg-red-500 rounded-full"></span>
                        </button>

                        <!-- Search -->
                        <div class="relative hidden md:block">
                            <input type="text" placeholder="Search..."
                                class="pl-10 pr-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500 w-64">
                            <svg class="absolute left-3 top-2.5 w-5 h-5 text-gray-400" fill="none"
                                stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"></path>
                            </svg>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Main Content Area -->
        <main class="p-6">
            @yield('content')
        </main>
    </div>

    <!-- Mobile Menu Overlay -->
    <div id="mobileOverlay" class="fixed inset-0 bg-black bg-opacity-50 z-30 hidden lg:hidden"></div>

    <script>
        // Function untuk update jam realtime
        function updateDashboardClock() {
            const now = new Date();

            // Format waktu
            const hours = String(now.getHours()).padStart(2, '0');
            const minutes = String(now.getMinutes()).padStart(2, '0');
            const seconds = String(now.getSeconds()).padStart(2, '0');

            // Format tanggal
            const days = ['Minggu', 'Senin', 'Selasa', 'Rabu', 'Kamis', 'Jumat', 'Sabtu'];
            const months = ['Januari', 'Februari', 'Maret', 'April', 'Mei', 'Juni', 'Juli', 'Agustus', 'September',
                'Oktober', 'November', 'Desember'
            ];

            const day = days[now.getDay()];
            const date = now.getDate();
            const month = months[now.getMonth()];
            const year = now.getFullYear();

            // Update element
            document.getElementById('dashboardHours').textContent = hours;
            document.getElementById('dashboardMinutes').textContent = minutes;
            document.getElementById('dashboardSeconds').textContent = seconds;
            document.getElementById('dashboardDay').textContent = day;
            document.getElementById('dashboardDate').textContent = `${date} ${month} ${year}`;
        }

        // Inisialisasi dan update setiap detik
        updateDashboardClock();
        setInterval(updateDashboardClock, 1000);

        // Mobile Menu Toggle
        const mobileMenuButton = document.getElementById('mobileMenuButton');
        const sidebar = document.getElementById('sidebar');
        const mobileOverlay = document.getElementById('mobileOverlay');

        mobileMenuButton.addEventListener('click', () => {
            sidebar.classList.toggle('-translate-x-full');
            mobileOverlay.classList.toggle('hidden');
        });

        mobileOverlay.addEventListener('click', () => {
            sidebar.classList.add('-translate-x-full');
            mobileOverlay.classList.add('hidden');
        });

        // Active menu item
        document.addEventListener('DOMContentLoaded', function() {
            const currentPath = window.location.pathname;
            const menuItems = document.querySelectorAll('.sidebar-item');

            menuItems.forEach(item => {
                item.classList.remove('active');
                if (item.getAttribute('href') === currentPath) {
                    item.classList.add('active');
                }
            });

            // Update greeting
            updateRealtimeClock();
        });

        // Smooth transitions
        document.querySelectorAll('a').forEach(anchor => {
            anchor.addEventListener('click', function(e) {
                if (this.hash !== "") {
                    e.preventDefault();
                    const target = document.querySelector(this.hash);
                    if (target) {
                        target.scrollIntoView({
                            behavior: 'smooth'
                        });
                    }
                }
            });
        });
    </script>
    @stack('scripts')
</body>

</html>
