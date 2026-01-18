<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin | Universitas Pamulang</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="stylesheet" href="{{ asset('css/style.css') }}">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700&display=swap" rel="stylesheet">
</head>

<body class="bg-gray-50 text-gray-800">
    <div class="flex h-screen overflow-hidden">
        <div class="hidden md:flex flex-col w-64 bg-white shadow-xl z-20">
            <!-- Logo -->
            <div class="p-6 border-b">
                <div class="flex items-center space-x-3">
                    <img src="{{ asset('img/unpam.png') }}" alt="Logo Universitas" class="w-10 h-10 rounded-lg">
                    <div>
                        <h1 class="text-xl font-bold text-gray-900">UNPAM</h1>
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
        </div>

        <!-- Mobile sidebar overlay -->
        <div id="mobileSidebar" class="fixed inset-0 bg-gray-900 bg-opacity-50 z-30 hidden md:hidden"></div>

        <!-- Mobile sidebar -->
        <div id="mobileSidebarMenu"
            class="fixed inset-y-0 left-0 w-64 bg-white shadow-xl z-40 transform -translate-x-full transition-transform md:hidden">
            <!-- Logo -->
            <div class="p-6 border-b">
                <div class="flex items-center space-x-3">
                    <img src="{{ asset('img/unpam.png') }}" alt="Logo Universitas" class="w-10 h-10 rounded-lg">
                    <div>
                        <h1 class="text-xl font-bold text-gray-900">UNPAM</h1>
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

                <form id="logout-form" action="{{ route('logout') }}" method="POST" class="hidden">
                    @csrf
                    <button id="mobileLogoutBtn"
                    class="flex items-center w-full p-3 rounded-lg text-gray-700 hover:bg-gray-100 mt-8">
                    <i class="fas fa-sign-out-alt w-5 mr-3 text-gray-500"></i>
                    <span>Keluar</span>
                </button>
                </form>
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
                        <!-- User dropdown -->
                        <div class="relative">
                            <button id="userDropdownBtn" class="flex items-center space-x-2 focus:outline-none">
                                <div
                                    class="w-10 h-10 rounded-full gradient-bg flex items-center justify-center text-white font-bold">
                                    <i class="fas fa-user"></i>
                                </div>
                                <span class="hidden md:block font-medium">{{ Auth::user()->name }}</span>
                                <i class="fas fa-chevron-down hidden md:block"></i>
                            </button>

                            <!-- Dropdown menu -->
                            <div id="userDropdown"
                                class="absolute right-0 mt-2 w-48 bg-white rounded-lg shadow-lg border hidden z-10">
                                <div class="p-4 border-b">
                                    <p class="font-semibold">{{ Auth::user()->name }}</p>
                                    <p class="text-sm text-gray-500">{{ Auth::user()->email }}</p>
                                </div>
                                <div class="p-2">
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
                                        @foreach ($mhs as $data)
                                            <tr class="hover:bg-gray-50">
                                                <td class="px-6 py-4">{{ $data->id }}</td>
                                                <td class="px-6 py-4 font-medium">{{ $data->nama }}</td>
                                                <td class="px-6 py-4">{{ $data->nim }}</td>
                                                <td class="px-6 py-4">
                                                    <span
                                                        class="px-3 py-1 text-xs rounded-full bg-blue-100 text-blue-700">
                                                        {{ $data->jurusan }}
                                                    </span>
                                                </td>
                                                <td class="px-6 py-4 text-center">
                                                    <div class="flex justify-center gap-2">
                                                        <a href="#"
                                                            class="btn-edit px-3 py-1.5 text-xs font-medium rounded-lg bg-yellow-100 text-yellow-700 hover:bg-yellow-200 transition">Edit</a>
                                                        <button
                                                            class="btn-delete px-3 py-1.5 text-xs font-medium rounded-lg bg-red-100 text-red-700 hover:bg-red-200 transition">Delete</button>
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
                                                        <a href="#"
                                                            class="btn-edit px-3 py-1.5 text-xs font-medium rounded-lg bg-yellow-100 text-yellow-700 hover:bg-yellow-200 transition">Edit</a>
                                                        <button
                                                            class="btn-delete px-3 py-1.5 text-xs font-medium rounded-lg bg-red-100 text-red-700 hover:bg-red-200 transition">Delete</button>
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
                                            Nama Dosen</th>
                                        <th
                                            class="px-6 py-4 text-left text-xs font-semibold text-gray-700 uppercase tracking-wider">
                                            NIP</th>
                                        <th
                                            class="px-6 py-4 text-left text-xs font-semibold text-gray-700 uppercase tracking-wider">
                                            Fakultas</th>
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
                        <label for="nidn" class="block text-sm font-medium text-gray-700 mb-2">NIP *</label>
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

    <script src="{{ asset('js/app.js') }}"></script>
</body>

</html>
