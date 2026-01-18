<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Panel | Universitas Digital</title>
    <!-- Tailwind CSS CDN -->
    <script src="https://cdn.tailwindcss.com"></script>
    <!-- Font Awesome untuk ikon -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <!-- Google Fonts -->
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    <style>
        /* Custom styling untuk desain modern */
        :root {
            --primary: #4f46e5;
            --primary-dark: #4338ca;
            --secondary: #10b981;
            --dark: #1f2937;
            --light: #f9fafb;
        }

        * {
            font-family: 'Inter', sans-serif;
        }

        /* Smooth scrolling */
        html {
            scroll-behavior: smooth;
        }

        /* Custom scrollbar */
        ::-webkit-scrollbar {
            width: 8px;
            height: 8px;
        }

        ::-webkit-scrollbar-track {
            background: #f1f1f1;
            border-radius: 10px;
        }

        ::-webkit-scrollbar-thumb {
            background: linear-gradient(45deg, #4f46e5, #7c3aed);
            border-radius: 10px;
        }

        ::-webkit-scrollbar-thumb:hover {
            background: linear-gradient(45deg, #4338ca, #6d28d9);
        }

        /* Animasi untuk card hover */
        .card-hover {
            transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
        }

        .card-hover:hover {
            transform: translateY(-5px);
            box-shadow: 0 20px 40px rgba(0, 0, 0, 0.08);
        }

        /* Gradient background */
        .gradient-bg {
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
        }

        /* Active menu item */
        .active-menu {
            background: linear-gradient(90deg, rgba(79, 70, 229, 0.1) 0%, rgba(79, 70, 229, 0.05) 100%);
            border-right: 4px solid var(--primary);
            color: var(--primary);
            font-weight: 600;
        }

        /* Animasi fade in */
        @keyframes fadeIn {
            from {
                opacity: 0;
                transform: translateY(10px);
            }

            to {
                opacity: 1;
                transform: translateY(0);
            }
        }

        .fade-in {
            animation: fadeIn 0.4s ease-out;
        }

        /* Glassmorphism effect */
        .glass {
            background: rgba(255, 255, 255, 0.7);
            backdrop-filter: blur(10px);
            border: 1px solid rgba(255, 255, 255, 0.2);
        }

        /* Modern button styles */
        .btn-primary {
            background: linear-gradient(90deg, var(--primary), #7c3aed);
            color: white;
            transition: all 0.3s ease;
        }

        .btn-primary:hover {
            background: linear-gradient(90deg, var(--primary-dark), #6d28d9);
            transform: translateY(-2px);
            box-shadow: 0 10px 20px rgba(79, 70, 229, 0.3);
        }

        /* Chart container */
        .chart-container {
            position: relative;
            height: 300px;
        }

        /* Modern table design */
        .modern-table {
            border-collapse: separate;
            border-spacing: 0 10px;
        }

        .modern-table tbody tr {
            background: white;
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.05);
            border-radius: 10px;
            transition: all 0.3s ease;
        }

        .modern-table tbody tr:hover {
            box-shadow: 0 10px 15px rgba(0, 0, 0, 0.08);
            transform: translateY(-2px);
        }

        /* Badge styles */
        .badge {
            padding: 4px 12px;
            border-radius: 20px;
            font-size: 12px;
            font-weight: 600;
        }

        .badge-success {
            background-color: #d1fae5;
            color: #065f46;
        }

        .badge-warning {
            background-color: #fef3c7;
            color: #92400e;
        }

        .badge-info {
            background-color: #dbeafe;
            color: #1e40af;
        }
    </style>
</head>

<body class="bg-gray-50 text-gray-800">
    <div class="flex h-screen overflow-hidden">
        <!-- Sidebar -->
        <div class="hidden md:flex flex-col w-64 bg-white shadow-xl z-20">
            <!-- Logo -->
            <div class="p-6 border-b">
                <div class="flex items-center space-x-3">
                    <div class="gradient-bg w-10 h-10 rounded-lg flex items-center justify-center">
                        <i class="fas fa-university text-white text-lg"></i>
                    </div>
                    <div>
                        <h1 class="text-xl font-bold text-gray-900">UniDigital</h1>
                        <p class="text-xs text-gray-500">Admin Panel</p>
                    </div>
                </div>
            </div>

            <!-- Navigation -->
            <nav class="flex-1 p-4 space-y-2 overflow-y-auto">
                <a href="#" class="flex items-center p-3 rounded-lg text-gray-700 hover:bg-gray-100 active-menu"
                    data-menu="dashboard">
                    <i class="fas fa-chart-pie w-5 mr-3 text-gray-500"></i>
                    <span>Dashboard</span>
                </a>

                <a href="#" class="flex items-center p-3 rounded-lg text-gray-700 hover:bg-gray-100"
                    data-menu="mahasiswa">
                    <i class="fas fa-user-graduate w-5 mr-3 text-gray-500"></i>
                    <span>Mahasiswa</span>
                </a>

                <a href="#" class="flex items-center p-3 rounded-lg text-gray-700 hover:bg-gray-100"
                    data-menu="dosen">
                    <i class="fas fa-chalkboard-teacher w-5 mr-3 text-gray-500"></i>
                    <span>Dosen</span>
                </a>
            </nav>

            <!-- Logout button -->
            <div class="p-6 border-t">
                <button id="logoutBtn"
                    class="flex items-center justify-center w-full p-3 text-gray-700 rounded-lg border border-gray-300 hover:bg-gray-100 transition-colors">
                    <i class="fas fa-sign-out-alt mr-2"></i>
                    <span>Keluar</span>
                </button>
            </div>
        </div>

        <!-- Mobile sidebar overlay -->
        <div id="mobileSidebar" class="fixed inset-0 bg-gray-900 bg-opacity-50 z-30 hidden md:hidden"></div>

        <!-- Mobile sidebar -->
        <div id="mobileSidebarMenu"
            class="fixed inset-y-0 left-0 w-64 bg-white shadow-xl z-40 transform -translate-x-full transition-transform md:hidden">
            <!-- Mobile sidebar content (sama dengan desktop) -->
            <div class="p-6 border-b">
                <div class="flex items-center space-x-3">
                    <div class="gradient-bg w-10 h-10 rounded-lg flex items-center justify-center">
                        <i class="fas fa-university text-white text-lg"></i>
                    </div>
                    <div>
                        <h1 class="text-xl font-bold text-gray-900">UniDigital</h1>
                        <p class="text-xs text-gray-500">Admin Panel</p>
                    </div>
                </div>
            </div>

            <nav class="p-4 space-y-2">
                <!-- Menu items sama seperti desktop -->
                <a href="#" class="flex items-center p-3 rounded-lg text-gray-700 hover:bg-gray-100 active-menu"
                    data-menu="dashboard">
                    <i class="fas fa-chart-pie w-5 mr-3 text-gray-500"></i>
                    <span>Dashboard</span>
                </a>

                <a href="#" class="flex items-center p-3 rounded-lg text-gray-700 hover:bg-gray-100"
                    data-menu="mahasiswa">
                    <i class="fas fa-user-graduate w-5 mr-3 text-gray-500"></i>
                    <span>Mahasiswa</span>
                </a>

                <a href="#" class="flex items-center p-3 rounded-lg text-gray-700 hover:bg-gray-100"
                    data-menu="dosen">
                    <i class="fas fa-chalkboard-teacher w-5 mr-3 text-gray-500"></i>
                    <span>Dosen</span>
                </a>



                <button id="mobileLogoutBtn"
                    class="flex items-center w-full p-3 rounded-lg text-gray-700 hover:bg-gray-100 mt-8">
                    <i class="fas fa-sign-out-alt w-5 mr-3 text-gray-500"></i>
                    <span>Keluar</span>
                </button>
            </nav>
        </div>

        <!-- Main content -->
        <div class="flex-1 flex flex-col overflow-hidden">
            <!-- Header -->
            <header class="glass border-b">
                <div class="flex items-center justify-between px-6 py-4">
                    <div class="flex items-center">
                        <!-- Mobile menu button -->
                        <button id="mobileMenuBtn" class="text-gray-600 hover:text-gray-900 mr-4 md:hidden">
                            <i class="fas fa-bars text-xl"></i>
                        </button>

                        <!-- Search bar -->
                        <div class="relative hidden md:block">
                            <i
                                class="fas fa-search absolute left-3 top-1/2 transform -translate-y-1/2 text-gray-400"></i>
                            <input type="text" placeholder="Cari..."
                                class="pl-10 pr-4 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent w-64">
                        </div>
                    </div>

                    <div class="flex items-center space-x-4">
                        <!-- Notifications -->
                        <div class="relative">
                            <button
                                class="relative p-2 text-gray-600 hover:text-gray-900 rounded-full hover:bg-gray-100">
                                <i class="fas fa-bell text-xl"></i>
                                <span class="absolute top-1 right-1 w-2 h-2 bg-red-500 rounded-full"></span>
                            </button>
                        </div>

                        <!-- User dropdown -->
                        <div class="relative">
                            <button id="userDropdownBtn" class="flex items-center space-x-2 focus:outline-none">
                                <div
                                    class="w-10 h-10 rounded-full gradient-bg flex items-center justify-center text-white font-bold">
                                    <i class="fas fa-user"></i>
                                </div>
                                <span class="hidden md:block font-medium">Administrator</span>
                                <i class="fas fa-chevron-down hidden md:block"></i>
                            </button>

                            <!-- Dropdown menu -->
                            <div id="userDropdown"
                                class="absolute right-0 mt-2 w-48 bg-white rounded-lg shadow-lg border hidden z-10">
                                <div class="p-4 border-b">
                                    <p class="font-semibold">Administrator</p>
                                    <p class="text-sm text-gray-500">admin@unidigital.ac.id</p>
                                </div>
                                <div class="p-2">
                                    <a href="#"
                                        class="flex items-center p-2 text-gray-700 hover:bg-gray-100 rounded">
                                        <i class="fas fa-user mr-3"></i>
                                        <span>Profil Saya</span>
                                    </a>

                                    <button id="headerLogoutBtn"
                                        class="flex items-center w-full p-2 text-red-600 hover:bg-red-50 rounded">
                                        <i class="fas fa-sign-out-alt mr-3"></i>
                                        <span>Keluar</span>
                                    </button>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </header>


            <!-- Main content area -->
            <main class="flex-1 overflow-y-auto p-4 md:p-6">
                <!-- Dashboard Content -->
                <div id="dashboardContent" class="content-section space-y-6 fade-in">
                    <!-- Stats cards -->
                    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6">
                        <div class="bg-white rounded-2xl shadow-sm p-6 card-hover border border-gray-100">
                            <div class="flex items-center justify-between">
                                <div>
                                    <p class="text-gray-500 text-sm font-medium">Total Mahasiswa</p>
                                    <h3 class="text-3xl font-bold mt-2">1,248</h3>
                                    <div class="flex items-center mt-2">
                                        <span class="text-green-500 text-sm font-medium flex items-center">
                                            <i class="fas fa-arrow-up mr-1"></i> 12.5%
                                        </span>
                                        <span class="text-gray-500 text-sm ml-2">dari bulan lalu</span>
                                    </div>
                                </div>
                                <div class="p-4 rounded-xl bg-blue-50 text-blue-600">
                                    <i class="fas fa-user-graduate text-2xl"></i>
                                </div>
                            </div>
                        </div>

                        <div class="bg-white rounded-2xl shadow-sm p-6 card-hover border border-gray-100">
                            <div class="flex items-center justify-between">
                                <div>
                                    <p class="text-gray-500 text-sm font-medium">Total Dosen</p>
                                    <h3 class="text-3xl font-bold mt-2">84</h3>
                                    <div class="flex items-center mt-2">
                                        <span class="text-green-500 text-sm font-medium flex items-center">
                                            <i class="fas fa-arrow-up mr-1"></i> 5.2%
                                        </span>
                                        <span class="text-gray-500 text-sm ml-2">dari bulan lalu</span>
                                    </div>
                                </div>
                                <div class="p-4 rounded-xl bg-green-50 text-green-600">
                                    <i class="fas fa-chalkboard-teacher text-2xl"></i>
                                </div>
                            </div>
                        </div>

                        <div class="bg-white rounded-2xl shadow-sm p-6 card-hover border border-gray-100">
                            <div class="flex items-center justify-between">
                                <div>
                                    <p class="text-gray-500 text-sm font-medium">Mata Kuliah</p>
                                    <h3 class="text-3xl font-bold mt-2">42</h3>
                                    <div class="flex items-center mt-2">
                                        <span class="text-blue-500 text-sm font-medium flex items-center">
                                            <i class="fas fa-minus mr-1"></i> 0%
                                        </span>
                                        <span class="text-gray-500 text-sm ml-2">tidak berubah</span>
                                    </div>
                                </div>
                                <div class="p-4 rounded-xl bg-purple-50 text-purple-600">
                                    <i class="fas fa-book text-2xl"></i>
                                </div>
                            </div>
                        </div>

                        <div class="bg-white rounded-2xl shadow-sm p-6 card-hover border border-gray-100">
                            <div class="flex items-center justify-between">
                                <div>
                                    <p class="text-gray-500 text-sm font-medium">Kehadiran</p>
                                    <h3 class="text-3xl font-bold mt-2">92%</h3>
                                    <div class="flex items-center mt-2">
                                        <span class="text-green-500 text-sm font-medium flex items-center">
                                            <i class="fas fa-arrow-up mr-1"></i> 3.1%
                                        </span>
                                        <span class="text-gray-500 text-sm ml-2">dari minggu lalu</span>
                                    </div>
                                </div>
                                <div class="p-4 rounded-xl bg-orange-50 text-orange-600">
                                    <i class="fas fa-calendar-check text-2xl"></i>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="grid grid-cols-1 lg:grid-cols-2 gap-6">

                        <!-- CARD MAHASISWA -->
                        <div class="bg-white rounded-2xl shadow-md border border-gray-100">
                            <!-- Header -->
                            <div class="flex items-center justify-between px-6 py-4 border-b">
                                <div>
                                    <h3 class="text-lg font-semibold text-gray-800">Data Mahasiswa</h3>
                                    <p class="text-sm text-gray-500">Daftar mahasiswa terdaftar</p>
                                </div>
                            </div>

                            <!-- Table -->
                            <div class="overflow-x-auto">
                                <table class="min-w-full text-sm">
                                    <thead class="bg-gray-50 text-gray-600 uppercase text-xs">
                                        <tr>
                                            <th class="px-6 py-3 text-left">No</th>
                                            <th class="px-6 py-3 text-left">Nama</th>
                                            <th class="px-6 py-3 text-left">NIM</th>
                                            <th class="px-6 py-3 text-left">Prodi</th>
                                            <th class="px-6 py-3 text-center">Aksi</th>
                                        </tr>
                                    </thead>
                                    <tbody class="divide-y">
                                        @foreach ($mhs as $data )
                                            <tr class="hover:bg-gray-50">
                                            <td class="px-6 py-4">{{ $data->id }}</td>
                                            <td class="px-6 py-4 font-medium">{{ $data->nama }}</td>
                                            <td class="px-6 py-4">{{ $data->nim }}</td>
                                            <td class="px-6 py-4">
                                                <span class="px-3 py-1 text-xs rounded-full bg-blue-100 text-blue-700">
                                                    {{ $data->jurusan }}
                                                </span>
                                            </td>
                                            <td class="px-6 py-4 text-center">
                                                <div class="flex justify-center gap-2">
                                                    <a href="#" class="btn-edit px-3 py-1.5 text-xs font-medium rounded-lg bg-yellow-100 text-yellow-700 hover:bg-yellow-200 transition">Edit</a>
                                                    <button class="btn-delete px-3 py-1.5 text-xs font-medium rounded-lg bg-red-100 text-red-700 hover:bg-red-200 transition">Delete</button>
                                                </div>
                                            </td>
                                        </tr>
                                        @endforeach
                                        
                                    </tbody>
                                </table>
                            </div>
                        </div>
                        <!-- CARD DOSEN -->
                        <div class="bg-white rounded-2xl shadow-md border border-gray-100">
                            <!-- Header -->
                            <div class="flex items-center justify-between px-6 py-4 border-b">
                                <div>
                                    <h3 class="text-lg font-semibold text-gray-800">Data Dosen</h3>
                                    <p class="text-sm text-gray-500">Daftar dosen aktif</p>
                                </div>
                                
                            </div>
                            <!-- Table -->
                            <div class="overflow-x-auto">
                                <table class="min-w-full text-sm">
                                    <thead class="bg-gray-50 text-gray-600 uppercase text-xs">
                                        <tr>
                                            <th class="px-6 py-3 text-left">No</th>
                                            <th class="px-6 py-3 text-left">Nama</th>
                                            <th class="px-6 py-3 text-left">NIP</th>
                                            <th class="px-6 py-3 text-left">Fakultas</th>
                                            <th class="px-6 py-3 text-center">Aksi</th>
                                        </tr>
                                    </thead>
                                    <tbody class="divide-y">
                                        @foreach ($dns as $item)
                                            <tr class="hover:bg-gray-50">
                                            <td class="px-6 py-4">{{ $item->id }}</td>
                                            <td class="px-6 py-4 font-medium">{{ $item->nama }}</td>
                                            <td class="px-6 py-4">{{ $item->nip }}</td>
                                            <td class="px-6 py-4">
                                                <span
                                                    class="px-3 py-1 text-xs rounded-full bg-green-100 text-green-700">
                                                    Teknik
                                                </span>
                                            </td>
                                            <td class="px-6 py-4 text-center">
                                                <div class="flex justify-center gap-2">
                                                    <a href="#" class="btn-edit px-3 py-1.5 text-xs font-medium rounded-lg bg-yellow-100 text-yellow-700 hover:bg-yellow-200 transition">Edit</a>
                                                    <button class="btn-delete px-3 py-1.5 text-xs font-medium rounded-lg bg-red-100 text-red-700 hover:bg-red-200 transition">Delete</button>
                                                </div>
                                            </td>
                                        </tr>
                                        @endforeach
                                        
                                    </tbody>
                                </table>
                            </div>
                        </div>

                    </div>

                </div>

                <!-- Mahasiswa Content -->
                <div id="mahasiswaContent" class="content-section hidden fade-in">
                    <div class="flex flex-col md:flex-row md:items-center justify-between mb-6">

                        <div class="flex space-x-3 mt-4 md:mt-0">

                            <button id="addMahasiswaBtn" class="btn-primary px-4 py-2 rounded-lg flex items-center">
                                <i class="fas fa-plus mr-2"></i>Tambah Mahasiswa
                            </button>
                        </div>
                    </div>

                    <div class="bg-white rounded-2xl shadow-sm overflow-hidden border border-gray-100">
                        <div class="overflow-x-auto">
                            <table class="modern-table w-full">
                                <thead class="bg-gray-50">
                                    <tr>
                                        <th
                                            class="px-6 py-4 text-left text-xs font-semibold text-gray-700 uppercase tracking-wider">
                                            Mahasiswa</th>
                                        <th
                                            class="px-6 py-4 text-left text-xs font-semibold text-gray-700 uppercase tracking-wider">
                                            Program Studi</th>
                                        <th
                                            class="px-6 py-4 text-left text-xs font-semibold text-gray-700 uppercase tracking-wider">
                                            Status</th>
                                        <th
                                            class="px-6 py-4 text-left text-xs font-semibold text-gray-700 uppercase tracking-wider">
                                            Aksi</th>
                                    </tr>
                                </thead>
                                <tbody id="mahasiswaTableBody">
                                    <!-- Data mahasiswa akan dimuat di sini -->
                                </tbody>
                            </table>
                        </div>

                        <div class="px-6 py-4 border-t flex flex-col md:flex-row md:items-center justify-between">
                            <p class="text-gray-500 text-sm">Menampilkan <span class="font-medium">5</span> dari <span
                                    class="font-medium">1,248</span> mahasiswa</p>
                            <div class="flex items-center space-x-2 mt-2 md:mt-0">
                                <button
                                    class="w-10 h-10 flex items-center justify-center border border-gray-300 rounded-lg hover:bg-gray-50">
                                    <i class="fas fa-chevron-left"></i>
                                </button>
                                <button
                                    class="w-10 h-10 flex items-center justify-center border border-blue-600 bg-blue-50 text-blue-600 rounded-lg font-medium">1</button>
                                <button
                                    class="w-10 h-10 flex items-center justify-center border border-gray-300 rounded-lg hover:bg-gray-50">2</button>
                                <button
                                    class="w-10 h-10 flex items-center justify-center border border-gray-300 rounded-lg hover:bg-gray-50">3</button>
                                <button
                                    class="w-10 h-10 flex items-center justify-center border border-gray-300 rounded-lg hover:bg-gray-50">
                                    <i class="fas fa-chevron-right"></i>
                                </button>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Dosen Content -->
                <div id="dosenContent" class="content-section hidden fade-in">
                    <div class="flex flex-col md:flex-row md:items-center justify-between mb-6">

                        <div class="flex space-x-3 mt-4 md:mt-0">
                            <button id="addDosenBtn" class="btn-primary px-4 py-2 rounded-lg flex items-center">
                                <i class="fas fa-plus mr-2"></i>Tambah Dosen
                            </button>
                        </div>
                    </div>

                    <div class="bg-white rounded-2xl shadow-sm overflow-hidden border border-gray-100">
                        <div class="overflow-x-auto">
                            <table class="modern-table w-full">
                                <thead class="bg-gray-50">
                                    <tr>
                                        <th
                                            class="px-6 py-4 text-left text-xs font-semibold text-gray-700 uppercase tracking-wider">
                                            Dosen</th>
                                        <th
                                            class="px-6 py-4 text-left text-xs font-semibold text-gray-700 uppercase tracking-wider">
                                            Jabatan</th>
                                        <th
                                            class="px-6 py-4 text-left text-xs font-semibold text-gray-700 uppercase tracking-wider">
                                            Status</th>
                                        <th
                                            class="px-6 py-4 text-left text-xs font-semibold text-gray-700 uppercase tracking-wider">
                                            Aksi</th>
                                    </tr>
                                </thead>
                                <tbody id="dosenTableBody">
                                    <!-- Data dosen akan dimuat di sini -->
                                </tbody>
                            </table>
                        </div>

                        <div class="px-6 py-4 border-t flex flex-col md:flex-row md:items-center justify-between">
                            <p class="text-gray-500 text-sm">Menampilkan <span class="font-medium">4</span> dari <span
                                    class="font-medium">84</span> dosen</p>
                            <div class="flex items-center space-x-2 mt-2 md:mt-0">
                                <button
                                    class="w-10 h-10 flex items-center justify-center border border-gray-300 rounded-lg hover:bg-gray-50">
                                    <i class="fas fa-chevron-left"></i>
                                </button>
                                <button
                                    class="w-10 h-10 flex items-center justify-center border border-blue-600 bg-blue-50 text-blue-600 rounded-lg font-medium">1</button>
                                <button
                                    class="w-10 h-10 flex items-center justify-center border border-gray-300 rounded-lg hover:bg-gray-50">2</button>
                                <button
                                    class="w-10 h-10 flex items-center justify-center border border-gray-300 rounded-lg hover:bg-gray-50">3</button>
                                <button
                                    class="w-10 h-10 flex items-center justify-center border border-gray-300 rounded-lg hover:bg-gray-50">
                                    <i class="fas fa-chevron-right"></i>
                                </button>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Settings Content -->
                <div id="settingsContent" class="content-section hidden fade-in">
                    <div class="bg-white rounded-2xl shadow-sm p-6 border border-gray-100">
                        <h3 class="text-2xl font-bold text-gray-900 mb-6">Pengaturan Sistem</h3>
                        <div class="grid grid-cols-1 lg:grid-cols-3 gap-6">
                            <div class="lg:col-span-2">
                                <div class="space-y-6">
                                    <div>
                                        <h4 class="text-lg font-semibold mb-4">Pengaturan Umum</h4>
                                        <div class="space-y-4">
                                            <div
                                                class="flex items-center justify-between p-4 border border-gray-200 rounded-xl">
                                                <div>
                                                    <p class="font-medium">Notifikasi Email</p>
                                                    <p class="text-gray-500 text-sm">Kirim notifikasi melalui email</p>
                                                </div>
                                                <label class="relative inline-flex items-center cursor-pointer">
                                                    <input type="checkbox" class="sr-only peer" checked>
                                                    <div
                                                        class="w-11 h-6 bg-gray-200 peer-focus:outline-none peer-focus:ring-4 peer-focus:ring-blue-300 rounded-full peer peer-checked:after:translate-x-full peer-checked:after:border-white after:content-[''] after:absolute after:top-[2px] after:left-[2px] after:bg-white after:border-gray-300 after:border after:rounded-full after:h-5 after:w-5 after:transition-all peer-checked:bg-blue-600">
                                                    </div>
                                                </label>
                                            </div>

                                            <div
                                                class="flex items-center justify-between p-4 border border-gray-200 rounded-xl">
                                                <div>
                                                    <p class="font-medium">Mode Gelap</p>
                                                    <p class="text-gray-500 text-sm">Aktifkan tampilan mode gelap</p>
                                                </div>
                                                <label class="relative inline-flex items-center cursor-pointer">
                                                    <input type="checkbox" class="sr-only peer">
                                                    <div
                                                        class="w-11 h-6 bg-gray-200 peer-focus:outline-none peer-focus:ring-4 peer-focus:ring-blue-300 rounded-full peer peer-checked:after:translate-x-full peer-checked:after:border-white after:content-[''] after:absolute after:top-[2px] after:left-[2px] after:bg-white after:border-gray-300 after:border after:rounded-full after:h-5 after:w-5 after:transition-all peer-checked:bg-blue-600">
                                                    </div>
                                                </label>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="bg-gradient-to-br from-blue-50 to-indigo-50 p-6 rounded-xl">
                                <h4 class="text-lg font-semibold mb-4">Informasi Sistem</h4>
                                <div class="space-y-4">
                                    <div>
                                        <p class="text-sm text-gray-500">Versi Sistem</p>
                                        <p class="font-medium">v2.5.1</p>
                                    </div>
                                    <div>
                                        <p class="text-sm text-gray-500">Lisensi</p>
                                        <p class="font-medium">Enterprise</p>
                                    </div>
                                    <div>
                                        <p class="text-sm text-gray-500">Pembaruan Terakhir</p>
                                        <p class="font-medium">15 Juni 2023</p>
                                    </div>
                                    <button
                                        class="w-full mt-6 bg-white border border-blue-600 text-blue-600 hover:bg-blue-50 py-2 rounded-lg font-medium transition-colors">
                                        <i class="fas fa-sync-alt mr-2"></i>Periksa Pembaruan
                                    </button>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </main>
        </div>
    </div>

    <!-- Modal untuk Form Mahasiswa -->
    <div id="mahasiswaModal"
        class="fixed inset-0 bg-gray-900 bg-opacity-50 overflow-y-auto h-full w-full hidden z-50">
        <div
            class="relative top-20 mx-auto p-5 border w-11/12 md:w-1/2 max-w-2xl shadow-2xl rounded-2xl bg-white modal-animation">
            <div class="flex justify-between items-center pb-4 border-b">
                <div>
                    <h3 class="text-2xl font-bold text-gray-900" id="mahasiswaModalTitle">Tambah Mahasiswa</h3>
                    <p class="text-gray-500 text-sm mt-1">Lengkapi data mahasiswa baru</p>
                </div>
                <button id="closeMahasiswaModal" class="text-gray-400 hover:text-gray-600">
                    <i class="fas fa-times text-2xl"></i>
                </button>
            </div>

            <form id="mahasiswaForm" class="mt-6 space-y-6">
                <input type="hidden" id="mahasiswaId">
                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                    <div>
                        <label for="nim" class="block text-sm font-medium text-gray-700 mb-2">NIM *</label>
                        <input type="text" id="nim" name="nim"
                            class="w-full px-4 py-3 border border-gray-300 rounded-xl focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent"
                            required>
                    </div>
                    <div>
                        <label for="namaMahasiswa" class="block text-sm font-medium text-gray-700 mb-2">Nama Lengkap
                            *</label>
                        <input type="text" id="namaMahasiswa" name="namaMahasiswa"
                            class="w-full px-4 py-3 border border-gray-300 rounded-xl focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent"
                            required>
                    </div>
                    <div>
                        <label for="prodi" class="block text-sm font-medium text-gray-700 mb-2">Program Studi
                            *</label>
                        <select id="prodi" name="prodi"
                            class="w-full px-4 py-3 border border-gray-300 rounded-xl focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent"
                            required>
                            <option value="">Pilih Program Studi</option>
                            <option value="Teknik Informatika">Teknik Informatika</option>
                            <option value="Sistem Informasi">Sistem Informasi</option>
                            <option value="Teknik Elektro">Teknik Elektro</option>
                            <option value="Manajemen">Manajemen</option>
                            <option value="Akuntansi">Akuntansi</option>
                        </select>
                    </div>
                    <div>
                        <label for="semester" class="block text-sm font-medium text-gray-700 mb-2">Semester *</label>
                        <select id="semester" name="semester"
                            class="w-full px-4 py-3 border border-gray-300 rounded-xl focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent"
                            required>
                            <option value="">Pilih Semester</option>
                            <option value="1">Semester 1</option>
                            <option value="2">Semester 2</option>
                            <option value="3">Semester 3</option>
                            <option value="4">Semester 4</option>
                            <option value="5">Semester 5</option>
                            <option value="6">Semester 6</option>
                            <option value="7">Semester 7</option>
                            <option value="8">Semester 8</option>
                        </select>
                    </div>
                    <div>
                        <label for="emailMahasiswa" class="block text-sm font-medium text-gray-700 mb-2">Email
                            *</label>
                        <input type="email" id="emailMahasiswa" name="emailMahasiswa"
                            class="w-full px-4 py-3 border border-gray-300 rounded-xl focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent"
                            required>
                    </div>
                    <div>
                        <label for="teleponMahasiswa" class="block text-sm font-medium text-gray-700 mb-2">No. Telepon
                            *</label>
                        <input type="text" id="teleponMahasiswa" name="teleponMahasiswa"
                            class="w-full px-4 py-3 border border-gray-300 rounded-xl focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent"
                            required>
                    </div>
                </div>

                <div class="pt-6 border-t flex justify-end space-x-3">
                    <button type="button" id="cancelMahasiswaBtn"
                        class="px-6 py-3 border border-gray-300 rounded-xl text-gray-700 hover:bg-gray-50 font-medium">Batal</button>
                    <button type="submit" class="btn-primary px-6 py-3 rounded-xl font-medium flex items-center">
                        <i class="fas fa-save mr-2"></i>Simpan Data
                    </button>
                </div>
            </form>
        </div>
    </div>

    <!-- Modal untuk Form Dosen -->
    <div id="dosenModal" class="fixed inset-0 bg-gray-900 bg-opacity-50 overflow-y-auto h-full w-full hidden z-50">
        <div
            class="relative top-20 mx-auto p-5 border w-11/12 md:w-1/2 max-w-2xl shadow-2xl rounded-2xl bg-white modal-animation">
            <div class="flex justify-between items-center pb-4 border-b">
                <div>
                    <h3 class="text-2xl font-bold text-gray-900" id="dosenModalTitle">Tambah Dosen</h3>
                    <p class="text-gray-500 text-sm mt-1">Lengkapi data dosen baru</p>
                </div>
                <button id="closeDosenModal" class="text-gray-400 hover:text-gray-600">
                    <i class="fas fa-times text-2xl"></i>
                </button>
            </div>

            <form id="dosenForm" class="mt-6 space-y-6">
                <input type="hidden" id="dosenId">
                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                    <div>
                        <label for="nidn" class="block text-sm font-medium text-gray-700 mb-2">NIDN *</label>
                        <input type="text" id="nidn" name="nidn"
                            class="w-full px-4 py-3 border border-gray-300 rounded-xl focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent"
                            required>
                    </div>
                    <div>
                        <label for="namaDosen" class="block text-sm font-medium text-gray-700 mb-2">Nama Lengkap
                            *</label>
                        <input type="text" id="namaDosen" name="namaDosen"
                            class="w-full px-4 py-3 border border-gray-300 rounded-xl focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent"
                            required>
                    </div>
                    <div>
                        <label for="jabatan" class="block text-sm font-medium text-gray-700 mb-2">Jabatan *</label>
                        <select id="jabatan" name="jabatan"
                            class="w-full px-4 py-3 border border-gray-300 rounded-xl focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent"
                            required>
                            <option value="">Pilih Jabatan</option>
                            <option value="Asisten Ahli">Asisten Ahli</option>
                            <option value="Lektor">Lektor</option>
                            <option value="Lektor Kepala">Lektor Kepala</option>
                            <option value="Guru Besar">Guru Besar</option>
                        </select>
                    </div>
                    <div>
                        <label for="bidangIlmu" class="block text-sm font-medium text-gray-700 mb-2">Bidang Ilmu
                            *</label>
                        <input type="text" id="bidangIlmu" name="bidangIlmu"
                            class="w-full px-4 py-3 border border-gray-300 rounded-xl focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent"
                            required>
                    </div>
                    <div>
                        <label for="emailDosen" class="block text-sm font-medium text-gray-700 mb-2">Email *</label>
                        <input type="email" id="emailDosen" name="emailDosen"
                            class="w-full px-4 py-3 border border-gray-300 rounded-xl focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent"
                            required>
                    </div>
                    <div>
                        <label for="teleponDosen" class="block text-sm font-medium text-gray-700 mb-2">No. Telepon
                            *</label>
                        <input type="text" id="teleponDosen" name="teleponDosen"
                            class="w-full px-4 py-3 border border-gray-300 rounded-xl focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent"
                            required>
                    </div>
                </div>

                <div class="pt-6 border-t flex justify-end space-x-3">
                    <button type="button" id="cancelDosenBtn"
                        class="px-6 py-3 border border-gray-300 rounded-xl text-gray-700 hover:bg-gray-50 font-medium">Batal</button>
                    <button type="submit" class="btn-primary px-6 py-3 rounded-xl font-medium flex items-center">
                        <i class="fas fa-save mr-2"></i>Simpan Data
                    </button>
                </div>
            </form>
        </div>
    </div>

    <!-- Modal Logout -->
    <div id="logoutModal" class="fixed inset-0 bg-gray-900 bg-opacity-50 overflow-y-auto h-full w-full hidden z-50">
        <div
            class="relative top-20 mx-auto p-5 border w-11/12 md:w-1/3 max-w-md shadow-2xl rounded-2xl bg-white modal-animation">
            <div class="text-center p-4">
                <div
                    class="mx-auto flex items-center justify-center h-16 w-16 rounded-full bg-gradient-to-br from-red-50 to-red-100 mb-6">
                    <i class="fas fa-sign-out-alt text-red-600 text-2xl"></i>
                </div>
                <h3 class="text-xl font-bold text-gray-900 mb-2">Konfirmasi Logout</h3>
                <p class="text-gray-500 mb-8">Apakah Anda yakin ingin keluar dari sistem?</p>

                <div class="flex justify-center space-x-4">
                    <button id="cancelLogoutBtn"
                        class="px-6 py-3 border border-gray-300 rounded-xl text-gray-700 hover:bg-gray-50 font-medium w-32">Batal</button>
                    <button id="confirmLogoutBtn"
                        class="px-6 py-3 bg-gradient-to-r from-red-500 to-red-600 text-white rounded-xl hover:from-red-600 hover:to-red-700 font-medium w-32 flex items-center justify-center">
                        <i class="fas fa-sign-out-alt mr-2"></i>Logout
                    </button>
                </div>
            </div>
        </div>
    </div>

    <!-- Notifikasi -->
    <div id="notification"
        class="fixed top-4 right-4 bg-gradient-to-r from-green-500 to-emerald-600 text-white px-6 py-4 rounded-xl shadow-lg transform transition-all duration-300 translate-x-full hidden z-50 max-w-sm">
        <div class="flex items-center">
            <div class="flex-shrink-0">
                <i class="fas fa-check-circle text-xl"></i>
            </div>
            <div class="ml-4">
                <p class="font-medium" id="notificationTitle">Berhasil!</p>
                <p class="text-sm opacity-90 mt-1" id="notificationText">Data berhasil disimpan</p>
            </div>
        </div>
        <button id="closeNotification" class="absolute top-2 right-2 text-white opacity-70 hover:opacity-100">
            <i class="fas fa-times"></i>
        </button>
    </div>

    <script>
        // Data contoh untuk mahasiswa
        const mahasiswaData = [{
                id: 1,
                nim: "20210001",
                nama: "Budi Santoso",
                prodi: "Teknik Informatika",
                semester: "5",
                email: "budi@example.com",
                telepon: "081234567890",
                status: "Aktif"
            },
            {
                id: 2,
                nim: "20210002",
                nama: "Siti Rahayu",
                prodi: "Sistem Informasi",
                semester: "4",
                email: "siti@example.com",
                telepon: "081234567891",
                status: "Aktif"
            },
            {
                id: 3,
                nim: "20210003",
                nama: "Ahmad Fauzi",
                prodi: "Teknik Elektro",
                semester: "6",
                email: "ahmad@example.com",
                telepon: "081234567892",
                status: "Cuti"
            },
            {
                id: 4,
                nim: "20210004",
                nama: "Dewi Lestari",
                prodi: "Manajemen",
                semester: "3",
                email: "dewi@example.com",
                telepon: "081234567893",
                status: "Aktif"
            },
            {
                id: 5,
                nim: "20210005",
                nama: "Rizki Pratama",
                prodi: "Akuntansi",
                semester: "7",
                email: "rizki@example.com",
                telepon: "081234567894",
                status: "Aktif"
            }
        ];

        // Data contoh untuk dosen
        const dosenData = [{
                id: 1,
                nidn: "0012345601",
                nama: "Prof. Dr. Surya Wijaya",
                jabatan: "Guru Besar",
                bidang: "Kecerdasan Buatan",
                email: "surya@example.com",
                telepon: "081298765432",
                status: "Aktif"
            },
            {
                id: 2,
                nidn: "0012345602",
                nama: "Dr. Maya Indah, M.Kom",
                jabatan: "Lektor Kepala",
                bidang: "Data Science",
                email: "maya@example.com",
                telepon: "081298765433",
                status: "Aktif"
            },
            {
                id: 3,
                nidn: "0012345603",
                nama: "Rizki Maulana, M.T.",
                jabatan: "Lektor",
                bidang: "Jaringan Komputer",
                email: "rizki@example.com",
                telepon: "081298765434",
                status: "Aktif"
            },
            {
                id: 4,
                nidn: "0012345604",
                nama: "Anita Sari, M.Si.",
                jabatan: "Asisten Ahli",
                bidang: "Sistem Informasi",
                email: "anita@example.com",
                telepon: "081298765435",
                status: "Izin"
            }
        ];

        // Inisialisasi halaman
        document.addEventListener('DOMContentLoaded', function() {
            // Load data mahasiswa
            loadMahasiswaData();

            // Load data dosen
            loadDosenData();

            // Mobile menu toggle
            document.getElementById('mobileMenuBtn').addEventListener('click', function() {
                document.getElementById('mobileSidebarMenu').classList.remove('-translate-x-full');
                document.getElementById('mobileSidebar').classList.remove('hidden');
            });

            // Close mobile menu when clicking overlay
            document.getElementById('mobileSidebar').addEventListener('click', function() {
                document.getElementById('mobileSidebarMenu').classList.add('-translate-x-full');
                document.getElementById('mobileSidebar').classList.add('hidden');
            });

            // User dropdown toggle
            document.getElementById('userDropdownBtn').addEventListener('click', function() {
                document.getElementById('userDropdown').classList.toggle('hidden');
            });

            // Close dropdown when clicking outside
            document.addEventListener('click', function(e) {
                if (!e.target.closest('#userDropdownBtn') && !e.target.closest('#userDropdown')) {
                    document.getElementById('userDropdown').classList.add('hidden');
                }
            });

            // Menu navigasi
            const menuItems = document.querySelectorAll('nav a');
            const pageTitles = {
                'dashboard': {
                    title: 'Dashboard',
                    subtitle: 'Ringkasan dan statistik sistem'
                },
                'settings': {
                    title: 'Pengaturan Sistem',
                    subtitle: 'Kelola pengaturan aplikasi'
                }
            };

            menuItems.forEach(item => {
                item.addEventListener('click', function(e) {
                    e.preventDefault();

                    // Hapus kelas aktif dari semua menu
                    menuItems.forEach(menu => menu.classList.remove('active-menu'));

                    // Tambahkan kelas aktif ke menu yang dipilih
                    this.classList.add('active-menu');

                    // Sembunyikan semua konten
                    const contentSections = document.querySelectorAll('.content-section');
                    contentSections.forEach(section => {
                        section.classList.add('hidden');
                        section.classList.remove('fade-in');
                    });

                    // Tampilkan konten yang sesuai
                    const menuType = this.getAttribute('data-menu');
                    const contentSection = document.getElementById(menuType + 'Content');
                    contentSection.classList.remove('hidden');
                    setTimeout(() => {
                        contentSection.classList.add('fade-in');
                    }, 10);

                    // Update judul halaman
                    const pageData = pageTitles[menuType] || {
                        title: menuType,
                        subtitle: ''
                    };
                    document.getElementById('pageTitle').textContent = pageData.title;
                    document.getElementById('pageSubtitle').textContent = pageData.subtitle;
                    document.getElementById('breadcrumb').textContent = pageData.title;

                    // Tutup sidebar di mobile setelah memilih menu
                    if (window.innerWidth < 768) {
                        document.getElementById('mobileSidebarMenu').classList.add(
                            '-translate-x-full');
                        document.getElementById('mobileSidebar').classList.add('hidden');
                    }
                });
            });

            // Tombol tambah mahasiswa
            document.getElementById('addMahasiswaBtn').addEventListener('click', function() {
                document.getElementById('mahasiswaModalTitle').textContent = 'Tambah Mahasiswa';
                document.getElementById('mahasiswaForm').reset();
                document.getElementById('mahasiswaId').value = '';
                document.getElementById('mahasiswaModal').classList.remove('hidden');
            });

            // Tombol tambah dosen
            document.getElementById('addDosenBtn').addEventListener('click', function() {
                document.getElementById('dosenModalTitle').textContent = 'Tambah Dosen';
                document.getElementById('dosenForm').reset();
                document.getElementById('dosenId').value = '';
                document.getElementById('dosenModal').classList.remove('hidden');
            });

            // Tutup modal mahasiswa
            document.getElementById('closeMahasiswaModal').addEventListener('click', closeMahasiswaModal);
            document.getElementById('cancelMahasiswaBtn').addEventListener('click', closeMahasiswaModal);

            // Tutup modal dosen
            document.getElementById('closeDosenModal').addEventListener('click', closeDosenModal);
            document.getElementById('cancelDosenBtn').addEventListener('click', closeDosenModal);

            // Submit form mahasiswa
            document.getElementById('mahasiswaForm').addEventListener('submit', function(e) {
                e.preventDefault();

                const id = document.getElementById('mahasiswaId').value;
                const nim = document.getElementById('nim').value;
                const nama = document.getElementById('namaMahasiswa').value;
                const prodi = document.getElementById('prodi').value;
                const semester = document.getElementById('semester').value;
                const email = document.getElementById('emailMahasiswa').value;
                const telepon = document.getElementById('teleponMahasiswa').value;

                if (id) {
                    // Edit data
                    const index = mahasiswaData.findIndex(m => m.id == id);
                    if (index !== -1) {
                        mahasiswaData[index] = {
                            id: parseInt(id),
                            nim,
                            nama,
                            prodi,
                            semester,
                            email,
                            telepon,
                            status: mahasiswaData[index].status
                        };
                    }
                    showNotification('Data mahasiswa berhasil diperbarui!');
                } else {
                    // Tambah data baru
                    const newId = mahasiswaData.length > 0 ? Math.max(...mahasiswaData.map(m => m.id)) + 1 :
                        1;
                    mahasiswaData.push({
                        id: newId,
                        nim,
                        nama,
                        prodi,
                        semester,
                        email,
                        telepon,
                        status: 'Aktif'
                    });
                    showNotification('Mahasiswa baru berhasil ditambahkan!');
                }

                loadMahasiswaData();
                closeMahasiswaModal();
            });

            // Submit form dosen
            document.getElementById('dosenForm').addEventListener('submit', function(e) {
                e.preventDefault();

                const id = document.getElementById('dosenId').value;
                const nidn = document.getElementById('nidn').value;
                const nama = document.getElementById('namaDosen').value;
                const jabatan = document.getElementById('jabatan').value;
                const bidang = document.getElementById('bidangIlmu').value;
                const email = document.getElementById('emailDosen').value;
                const telepon = document.getElementById('teleponDosen').value;

                if (id) {
                    // Edit data
                    const index = dosenData.findIndex(d => d.id == id);
                    if (index !== -1) {
                        dosenData[index] = {
                            id: parseInt(id),
                            nidn,
                            nama,
                            jabatan,
                            bidang,
                            email,
                            telepon,
                            status: dosenData[index].status
                        };
                    }
                    showNotification('Data dosen berhasil diperbarui!');
                } else {
                    // Tambah data baru
                    const newId = dosenData.length > 0 ? Math.max(...dosenData.map(d => d.id)) + 1 : 1;
                    dosenData.push({
                        id: newId,
                        nidn,
                        nama,
                        jabatan,
                        bidang,
                        email,
                        telepon,
                        status: 'Aktif'
                    });
                    showNotification('Dosen baru berhasil ditambahkan!');
                }

                loadDosenData();
                closeDosenModal();
            });

            // Logout buttons
            document.getElementById('logoutBtn').addEventListener('click', showLogoutModal);
            document.getElementById('mobileLogoutBtn').addEventListener('click', showLogoutModal);
            document.getElementById('headerLogoutBtn').addEventListener('click', showLogoutModal);

            // Cancel logout
            document.getElementById('cancelLogoutBtn').addEventListener('click', function() {
                document.getElementById('logoutModal').classList.add('hidden');
            });

            // Confirm logout
            document.getElementById('confirmLogoutBtn').addEventListener('click', function() {
                showNotification('Logout berhasil!', 'Sampai jumpa kembali.');
                document.getElementById('logoutModal').classList.add('hidden');
            });

            // Close notification
            document.getElementById('closeNotification').addEventListener('click', function() {
                hideNotification();
            });

            // Tutup modal dengan klik di luar
            window.addEventListener('click', function(e) {
                if (e.target.id === 'mahasiswaModal') {
                    closeMahasiswaModal();
                }
                if (e.target.id === 'dosenModal') {
                    closeDosenModal();
                }
                if (e.target.id === 'logoutModal') {
                    document.getElementById('logoutModal').classList.add('hidden');
                }
            });

            // Fungsi untuk menutup modal mahasiswa
            function closeMahasiswaModal() {
                document.getElementById('mahasiswaModal').classList.add('hidden');
            }

            // Fungsi untuk menutup modal dosen
            function closeDosenModal() {
                document.getElementById('dosenModal').classList.add('hidden');
            }

            // Fungsi untuk menampilkan modal logout
            function showLogoutModal() {
                document.getElementById('logoutModal').classList.remove('hidden');
            }

            // Fungsi untuk memuat data mahasiswa ke tabel
            function loadMahasiswaData() {
                const tableBody = document.getElementById('mahasiswaTableBody');
                tableBody.innerHTML = '';

                mahasiswaData.forEach(mahasiswa => {
                    const statusClass = mahasiswa.status === 'Aktif' ? 'badge-success' :
                        mahasiswa.status === 'Cuti' ? 'badge-warning' : 'badge-info';

                    const row = document.createElement('tr');
                    row.innerHTML = `
                        <td class="px-6 py-4">
                            <div class="flex items-center">
                                <div class="flex-shrink-0 w-10 h-10 rounded-full bg-gradient-to-br from-blue-100 to-blue-200 flex items-center justify-center text-blue-600 font-bold">
                                    ${mahasiswa.nama.charAt(0)}
                                </div>
                                <div class="ml-4">
                                    <div class="font-medium text-gray-900">${mahasiswa.nama}</div>
                                    <div class="text-gray-500">${mahasiswa.nim}</div>
                                </div>
                            </div>
                        </td>
                        <td class="px-6 py-4">
                            <div class="text-gray-900">${mahasiswa.prodi}</div>
                            <div class="text-gray-500">Semester ${mahasiswa.semester}</div>
                        </td>
                        <td class="px-6 py-4">
                            <span class="${statusClass} badge">${mahasiswa.status}</span>
                        </td>
                        <td class="px-6 py-4">
                            <div class="flex items-center space-x-3">
                                <button class="text-blue-600 hover:text-blue-900 edit-mahasiswa" data-id="${mahasiswa.id}">
                                    <i class="fas fa-edit"></i>
                                </button>
                                <button class="text-red-600 hover:text-red-900 delete-mahasiswa" data-id="${mahasiswa.id}">
                                    <i class="fas fa-trash"></i>
                                </button>
                                <button class="text-gray-600 hover:text-gray-900 view-mahasiswa" data-id="${mahasiswa.id}">
                                    <i class="fas fa-eye"></i>
                                </button>
                            </div>
                        </td>
                    `;
                    tableBody.appendChild(row);
                });

                // Tambahkan event listener untuk tombol edit dan hapus
                document.querySelectorAll('.edit-mahasiswa').forEach(button => {
                    button.addEventListener('click', function() {
                        const id = this.getAttribute('data-id');
                        editMahasiswa(id);
                    });
                });

                document.querySelectorAll('.delete-mahasiswa').forEach(button => {
                    button.addEventListener('click', function() {
                        const id = this.getAttribute('data-id');
                        deleteMahasiswa(id);
                    });
                });
            }

            // Fungsi untuk memuat data dosen ke tabel
            function loadDosenData() {
                const tableBody = document.getElementById('dosenTableBody');
                tableBody.innerHTML = '';

                dosenData.forEach(dosen => {
                    const statusClass = dosen.status === 'Aktif' ? 'badge-success' :
                        dosen.status === 'Izin' ? 'badge-warning' : 'badge-info';

                    const row = document.createElement('tr');
                    row.innerHTML = `
                        <td class="px-6 py-4">
                            <div class="flex items-center">
                                <div class="flex-shrink-0 w-10 h-10 rounded-full bg-gradient-to-br from-green-100 to-green-200 flex items-center justify-center text-green-600 font-bold">
                                    ${dosen.nama.charAt(0)}
                                </div>
                                <div class="ml-4">
                                    <div class="font-medium text-gray-900">${dosen.nama}</div>
                                    <div class="text-gray-500">${dosen.nidn}</div>
                                </div>
                            </div>
                        </td>
                        <td class="px-6 py-4">
                            <div class="text-gray-900">${dosen.jabatan}</div>
                            <div class="text-gray-500">${dosen.bidang}</div>
                        </td>
                        <td class="px-6 py-4">
                            <span class="${statusClass} badge">${dosen.status}</span>
                        </td>
                        <td class="px-6 py-4">
                            <div class="flex items-center space-x-3">
                                <button class="text-green-600 hover:text-green-900 edit-dosen" data-id="${dosen.id}">
                                    <i class="fas fa-edit"></i>
                                </button>
                                <button class="text-red-600 hover:text-red-900 delete-dosen" data-id="${dosen.id}">
                                    <i class="fas fa-trash"></i>
                                </button>
                                <button class="text-gray-600 hover:text-gray-900 view-dosen" data-id="${dosen.id}">
                                    <i class="fas fa-eye"></i>
                                </button>
                            </div>
                        </td>
                    `;
                    tableBody.appendChild(row);
                });

                // Tambahkan event listener untuk tombol edit dan hapus
                document.querySelectorAll('.edit-dosen').forEach(button => {
                    button.addEventListener('click', function() {
                        const id = this.getAttribute('data-id');
                        editDosen(id);
                    });
                });

                document.querySelectorAll('.delete-dosen').forEach(button => {
                    button.addEventListener('click', function() {
                        const id = this.getAttribute('data-id');
                        deleteDosen(id);
                    });
                });
            }

            // Fungsi untuk mengedit mahasiswa
            function editMahasiswa(id) {
                const mahasiswa = mahasiswaData.find(m => m.id == id);
                if (mahasiswa) {
                    document.getElementById('mahasiswaModalTitle').textContent = 'Edit Mahasiswa';
                    document.getElementById('mahasiswaId').value = mahasiswa.id;
                    document.getElementById('nim').value = mahasiswa.nim;
                    document.getElementById('namaMahasiswa').value = mahasiswa.nama;
                    document.getElementById('prodi').value = mahasiswa.prodi;
                    document.getElementById('semester').value = mahasiswa.semester;
                    document.getElementById('emailMahasiswa').value = mahasiswa.email;
                    document.getElementById('teleponMahasiswa').value = mahasiswa.telepon;

                    document.getElementById('mahasiswaModal').classList.remove('hidden');
                }
            }

            // Fungsi untuk menghapus mahasiswa
            function deleteMahasiswa(id) {
                if (confirm('Apakah Anda yakin ingin menghapus data mahasiswa ini?')) {
                    const index = mahasiswaData.findIndex(m => m.id == id);
                    if (index !== -1) {
                        mahasiswaData.splice(index, 1);
                        loadMahasiswaData();
                        showNotification('Data mahasiswa berhasil dihapus!', 'Data telah dihapus dari sistem.');
                    }
                }
            }

            // Fungsi untuk mengedit dosen
            function editDosen(id) {
                const dosen = dosenData.find(d => d.id == id);
                if (dosen) {
                    document.getElementById('dosenModalTitle').textContent = 'Edit Dosen';
                    document.getElementById('dosenId').value = dosen.id;
                    document.getElementById('nidn').value = dosen.nidn;
                    document.getElementById('namaDosen').value = dosen.nama;
                    document.getElementById('jabatan').value = dosen.jabatan;
                    document.getElementById('bidangIlmu').value = dosen.bidang;
                    document.getElementById('emailDosen').value = dosen.email;
                    document.getElementById('teleponDosen').value = dosen.telepon;

                    document.getElementById('dosenModal').classList.remove('hidden');
                }
            }

            // Fungsi untuk menghapus dosen
            function deleteDosen(id) {
                if (confirm('Apakah Anda yakin ingin menghapus data dosen ini?')) {
                    const index = dosenData.findIndex(d => d.id == id);
                    if (index !== -1) {
                        dosenData.splice(index, 1);
                        loadDosenData();
                        showNotification('Data dosen berhasil dihapus!', 'Data telah dihapus dari sistem.');
                    }
                }
            }

            // Fungsi untuk menampilkan notifikasi
            function showNotification(title, message = '') {
                const notification = document.getElementById('notification');
                const notificationTitle = document.getElementById('notificationTitle');
                const notificationText = document.getElementById('notificationText');

                notificationTitle.textContent = title;
                notificationText.textContent = message;
                notification.classList.remove('hidden');
                notification.classList.remove('translate-x-full');

                setTimeout(() => {
                    hideNotification();
                }, 4000);
            }

            // Fungsi untuk menyembunyikan notifikasi
            function hideNotification() {
                const notification = document.getElementById('notification');
                notification.classList.add('translate-x-full');
                setTimeout(() => {
                    notification.classList.add('hidden');
                }, 300);
            }
        });
    </script>
</body>

</html>
