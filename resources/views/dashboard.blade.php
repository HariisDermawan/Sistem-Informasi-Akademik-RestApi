<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard Modern & Profesional</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700&display=swap" rel="stylesheet">
</head>
<body class="bg-gray-50">
    <div class="flex h-screen">
        <aside id="sidebar" class="sidebar-transition w-64 bg-white border-r border-gray-200 flex flex-col">
            <div class="p-6 border-b border-gray-200">
                <div class="flex items-center space-x-3">
                    <div class="w-30 h-30 rounded-lg bg-whiteoverflow-hidden flex items-center justify-center p-1">
                        <img src="{{ asset('img/unpam.png') }}" alt="AnalyticsPro Logo"
                            class="w-full h-full object-contain">
                    </div>
                    <div>
                        <h1 class="text-xl font-bold text-gray-800">UNIVERSITAS <b><span class="text-blue-600">PAMULANG</span></b></h1>
                    </div>
                </div>
            </div>
            <nav class="flex-1 p-4">
                <ul class="space-y-2">
                    <li>
                        <a href="{{ route('dashboard') }}"
                            class="flex items-center space-x-3 p-3 rounded-lg bg-blue-50 text-blue-600">
                            <i class="fas fa-home text-lg"></i>
                            <span class="font-medium">Dashboard</span>
                        </a>
                    </li>
                    <li>
                        <a href="{{ route('mahasiswas.index') }}"
                            class="flex items-center space-x-3 p-3 rounded-lg text-gray-700 hover:bg-gray-100">
                            <i class="fas fa-users text-lg"></i>
                            <span class="font-medium">Data Mahasiswa</span>
                        </a>

                    </li>
                    <li>
                        <a href="{{ route('dosens.index') }}"
                            class="flex items-center space-x-3 p-3 rounded-lg text-gray-700 hover:bg-gray-100 transition-colors">
                            <i class="fas fa-chalkboard-teacher text-lg"></i>
                            <span class="font-medium">Data Dosen</span>
                        </a>
                    </li>
                    <li>
                        <form action="{{ route('logout') }}" method="POST">
                            @csrf
                            <button type="submit"
                                class="flex items-center space-x-3 p-3 rounded-lg text-red-600 hover:bg-red-50 transition-colors">
                                <i class="fas fa-power-off text-lg"></i>
                                <span class="font-medium">Logout</span>
                            </button>
                        </form>
                    </li>

                </ul>
            </nav>
            <div class="p-4 border-t border-gray-200">
                <div class="flex items-center space-x-3">
                    <div class="w-10 h-10 rounded-full bg-blue-100 flex items-center justify-center">
                        <span class="font-bold text-blue-600">AD</span>
                    </div>
                    <div class="flex-1">
                        <h4 class="font-medium text-gray-800">Admin Dashboard</h4>
                        <p class="text-xs text-gray-500">admin@example.com</p>
                    </div>
                </div>
            </div>
        </aside>
        <div class="flex-1 flex flex-col overflow-hidden">
            <header class="bg-white border-b border-gray-200 p-4 flex items-center justify-between">
                <div class="flex items-center space-x-4">
                    <button id="toggleSidebar" class="md:hidden text-gray-700 focus:outline-none">
                        <i class="fas fa-bars text-xl"></i>
                    </button>
                </div>

                <div class="flex items-center space-x-4">
                    <div class="flex items-center space-x-3">
                        <div class="hidden md:block text-right">
                            <h4 class="font-medium text-gray-800">Admin Dashboard</h4>
                            <p class="text-xs text-gray-500">Administrator</p>
                        </div>
                        <div class="w-9 h-9 rounded-full bg-blue-100 flex items-center justify-center">
                            <span class="font-bold text-blue-600">AD</span>
                        </div>
                    </div>
                </div>
            </header>


            <main class="flex-1 overflow-y-auto p-4 md:p-6">
                <!-- Statistik Akademik -->
                <div class="grid grid-cols-1 lg:grid-cols-3 gap-4 mb-6">
                    <!-- Data Mahasiswa -->
                    <div class="card-shadow bg-white rounded-xl p-5">
                        <div class="flex justify-between items-start">
                            <div class="flex-1">
                                <p class="text-gray-500 text-sm">Total Mahasiswa</p>
                                <h3 class="text-2xl font-bold text-gray-800 mt-1">{{ $mahasiswaCount }}</h3>

                            </div>
                            <div class="w-16 h-16 rounded-lg bg-blue-100 flex items-center justify-center ml-4">
                                <i class="fas fa-user-graduate text-blue-600 text-2xl"></i>
                            </div>
                        </div>
                    </div>

                    <!-- Data Dosen -->
                    <div class="card-shadow bg-white rounded-xl p-5">
                        <div class="flex justify-between items-start">
                            <div class="flex-1">
                                <p class="text-gray-500 text-sm">Total Dosen</p>
                                <h3 class="text-2xl font-bold text-gray-800 mt-1">{{ $dosenCount }}</h3>

                            </div>
                            <div class="w-16 h-16 rounded-lg bg-green-100 flex items-center justify-center ml-4">
                                <i class="fas fa-chalkboard-teacher text-green-600 text-2xl"></i>
                            </div>
                        </div>
                    </div>

                    <!-- Waktu & Tanggal -->
                    <div class="card-shadow bg-white rounded-xl p-5">
                        <div class="flex justify-between items-start">
                            <div class="flex-1">
                                <p class="text-gray-500 text-sm">Waktu & Tanggal</p>
                                <h3 id="real-time-clock" class="text-2xl font-bold text-gray-800 mt-1">00:00:00</h3>
                                <p id="current-date" class="text-lg font-medium text-gray-700 mt-2"></p>

                            </div>
                            <div class="w-16 h-16 rounded-lg bg-purple-100 flex items-center justify-center ml-4">
                                <i class="fas fa-clock text-purple-600 text-2xl"></i>
                            </div>
                        </div>
                    </div>
                </div>


                <div class="grid grid-cols-1 lg:grid-cols-2 gap-6 mb-6">
                    <div class="card-shadow bg-white rounded-xl p-5">
                        <div class="flex justify-center items-center mb-6">
                            <h2 class="text-lg font-bold text-gray-800">Data Mahasiswa</h2>
                        </div>

                        <div class="overflow-x-auto">
                            <table class="w-full">
                                <thead>
                                    <tr class="text-left text-gray-500 text-sm border-b">
                                        <th class="pb-3 font-medium">ID</th>
                                        <th class="pb-3 font-medium">NIM</th>
                                        <th class="pb-3 font-medium">Nama</th>
                                    </tr>
                                </thead>
                                  <tbody class="text-sm text-gray-700 divide-y">
                                @foreach ($mhs as $item)
                                    <tr class="hover:bg-gray-50 transition">
                                        <td class="px-4 py-3">{{ $item->id }}</td>
                                        <td class="px-4 py-3 font-medium">{{ $item->nim }}</td>
                                        <td class="px-4 py-3">{{ $item->nama }}</td>
                                        <td class="px-4 py-3">
                                            <span
                                                class="px-3 py-1 text-xs font-medium rounded-full bg-blue-50 text-blue-700">
                                                {{ $item->jurusan }}
                                            </span>
                                        </td>
                                        
                                    </tr>
                                @endforeach
                            </tbody>
                            </table>
                        </div>
                    </div>

                    <div class="card-shadow bg-white rounded-xl p-5">
                        <div class="flex justify-center items-center mb-6">
                            <h2 class="text-lg font-bold text-gray-800">Data Dosen</h2>
                        </div>
                        <div class="overflow-x-auto">
                            <table class="w-full">
                                <thead>
                                    <tr class="text-left text-gray-500 text-sm border-b">
                                        <th class="pb-3 font-medium">ID</th>
                                        <th class="pb-3 font-medium">NIP</th>
                                        <th class="pb-3 font-medium">Nama</th>
                                    </tr>
                                </thead>
                                  <tbody class="text-sm text-gray-700 divide-y">
                                @foreach ($dns as $item)
                                    <tr class="hover:bg-gray-50 transition">
                                        <td class="px-4 py-3">{{ $item->id }}</td>
                                        <td class="px-4 py-3 font-medium">{{ $item->nip }}</td>
                                        <td class="px-4 py-3">{{ $item->nama }}</td>
                                        <td class="px-4 py-3">
                                            <span
                                                class="px-3 py-1 text-xs font-medium rounded-full bg-blue-50 text-green-700">
                                                {{ $item->jurusan }}
                                            </span>
                                        </td>
                                        
                                    </tr>
                                @endforeach
                            </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </main>
        </div>
    </div>
    <div id="login-toast"
        class="fixed top-4 right-4 bg-green-500 text-white px-4 py-3 rounded-lg shadow-lg opacity-0 transform translate-x-20 transition-all duration-500">
        Login Susseccfully!
    </div>

</body>
<script src="{{ asset('js/app.js') }}"></script>
<script>
    @if (session('success'))
        const toast = document.getElementById('login-toast');
        toast.classList.remove('opacity-0', 'translate-x-20');
        toast.classList.add('opacity-100', 'translate-x-0');
        setTimeout(() => {
            toast.classList.add('opacity-0', 'translate-x-20');
            toast.classList.remove('opacity-100', 'translate-x-0');
        }, 3000);
    @endif
</script>
</html>
