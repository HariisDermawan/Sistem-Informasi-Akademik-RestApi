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
                        <h1 class="text-xl font-bold text-gray-800">UNIVERSITAS <b><span
                                    class="text-blue-600">PAMULANG</span></b></h1>
                    </div>
                </div>
            </div>
            <nav class="flex-1 p-4">
                <ul class="space-y-2">
                    <li>
                        <a href="{{ route('dashboard') }}"
                            class="flex items-center space-x-3 p-3 rounded-lg text-gray-700 hover:bg-gray-100 transition-colors">
                            <i class="fas fa-home text-lg"></i>
                            <span class="font-medium">Dashboard</span>
                        </a>
                    </li>
                    <li>
                        <a href="{{ route('mahasiswas.index') }}"
                            class="flex items-center space-x-3 p-3 rounded-lg bg-blue-50 text-blue-600">
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
                        <h4 class="font-medium text-gray-800">{{ Auth::user()->name }}</h4>
                        <p class="text-xs text-gray-500">{{ Auth::user()->email }}</p>
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
                            <h4 class="font-medium text-gray-800">{{ Auth::user()->name }}</h4>
                            <p class="text-xs text-gray-500">{{ Auth::user()->email }}</p>
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
                                <h3 class="text-2xl font-bold text-gray-800 mt-1">1,245</h3>

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
                                <h3 class="text-2xl font-bold text-gray-800 mt-1">48</h3>

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
                <div class="bg-white rounded-xl shadow-md p-6">
                    <!-- Header -->
                    <div class="flex items-center justify-between mb-6">
                        <div>
                            <h2 class="text-lg font-semibold text-gray-800">Data Mahasiswa</h2>
                        </div>

                        <a href="{{ route('mahasiswas.create') }}" onclick="openModal(); return false;"
                            class="inline-flex items-center px-4 py-2 text-sm font-medium text-white bg-blue-600 rounded-lg hover:bg-blue-700 transition">
                            + Tambah Mahasiswa
                        </a>


                    </div>
                    <!-- MODAL -->
                    <div id="modalTambahMahasiswa"
                        class="fixed inset-0 z-50 hidden items-center justify-center bg-black/40 backdrop-blur-sm">

                        <div class="bg-white w-full max-w-md mx-4 rounded-2xl shadow-2xl transform transition-all scale-95 opacity-0"
                            id="modalContent">

                            <!-- Header -->
                            <div class="px-6 py-4 border-b">
                                <h3 class="text-xl font-semibold text-gray-800">
                                    Tambah Mahasiswa
                                </h3>
                                <p class="text-sm text-gray-500 mt-1">
                                    Lengkapi data mahasiswa baru
                                </p>
                            </div>

                            <!-- Body -->
                            <form action="{{ route('mahasiswas.store') }}" method="POST">
                                @csrf
                                <div class="px-6 py-6 space-y-5">

                                    <div>
                                        <label class="block text-sm font-medium text-gray-700 mb-1">
                                            NIM
                                        </label>
                                        <input type="text" name="nim"
                                            class="w-full px-4 py-3 rounded-xl border border-gray-200 focus:ring-2 focus:ring-blue-500 focus:border-blue-500 outline-none transition"
                                            placeholder="Contoh: 20221001">
                                    </div>

                                    <div>
                                        <label class="block text-sm font-medium text-gray-700 mb-1">
                                            Nama Mahasiswa
                                        </label>
                                        <input type="text" name="nama"
                                            class="w-full px-4 py-3 rounded-xl border border-gray-200 focus:ring-2 focus:ring-blue-500 focus:border-blue-500 outline-none transition"
                                            placeholder="Nama lengkap">
                                    </div>

                                    <div>
                                        <label class="block text-sm font-medium text-gray-700 mb-1">
                                            Jurusan
                                        </label>
                                        <select name="jurusan"
                                            class="w-full px-4 py-3 rounded-xl border border-gray-200 focus:ring-2 focus:ring-blue-500 focus:border-blue-500 outline-none transition">
                                            <option value="">Pilih Jurusan</option>
                                            <option>Informatika</option>
                                            <option>Sistem Informasi</option>
                                            <option>Teknik Komputer</option>
                                        </select>
                                    </div>
                                </div>
                                <!-- Footer -->
                                <div
                                    class="flex items-center justify-end gap-3 px-6 py-4 border-t bg-gray-50 rounded-b-2xl">
                                    <button type="button" onclick="closeModal()"
                                        class="px-4 py-2 text-sm rounded-lg text-gray-600 hover:bg-gray-200 transition">
                                        Batal
                                    </button>
                                    <button type="submit"
                                        class="px-5 py-2 text-sm font-medium text-white rounded-lg bg-blue-600 hover:bg-blue-700 transition shadow">
                                        Simpan
                                    </button>
                                </div>
                            </form>
                        </div>
                    </div>
                    <!-- Table -->
                    <div class="overflow-x-auto">
                        <table class="min-w-full border border-gray-200 rounded-lg overflow-hidden">
                            <thead class="bg-gray-50">
                                <tr class="text-left text-sm text-gray-600">
                                    <th class="px-4 py-3 font-semibold">ID</th>
                                    <th class="px-4 py-3 font-semibold">NIM</th>
                                    <th class="px-4 py-3 font-semibold">Nama</th>
                                    <th class="px-4 py-3 font-semibold">Jurusan</th>
                                    <th class="px-4 py-3 font-semibold text-center">Action</th>
                                </tr>
                            </thead>

                            <tbody class="text-sm text-gray-700 divide-y">
                                @foreach ($mahasiswa as $item)
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
                                        <td class="px-4 py-3">
                                            <div class="flex justify-center gap-2">
                                                <a href="{{ route('mahasiswas.edit', $item->id) }}"
                                                    class="px-3 py-1 text-xs font-medium text-blue-600 border border-blue-600 rounded-lg hover:bg-blue-50 transition">
                                                    Edit
                                                </a>
                                                <button
                                                    class="px-3 py-1 text-xs font-medium text-red-600 border border-red-600 rounded-lg hover:bg-red-50 transition">
                                                    Hapus
                                                </button>
                                            </div>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                        <!-- Pagination -->
                        <div class="mt-6 bg-white border border-gray-200 rounded-lg px-4 py-3">
                            {{ $mahasiswa->links('pagination::tailwind') }}
                        </div>
                    </div>
                </div>
            </main>
        </div>
    </div>
    <div id="login-toast"
        class="fixed top-4 right-4 bg-green-500 text-white px-4 py-3 rounded-lg shadow-lg opacity-0 transform translate-x-20 transition-all duration-500">
        Data Mahasiswa Berhasil Ditambahkan!
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

    const modal = document.getElementById('modalTambahMahasiswa');
    const modalContent = document.getElementById('modalContent');

    function openModal() {
        modal.classList.remove('hidden');
        modal.classList.add('flex');

        setTimeout(() => {
            modalContent.classList.remove('scale-95', 'opacity-0');
            modalContent.classList.add('scale-100', 'opacity-100');
        }, 50);
    }

    function closeModal() {
        modalContent.classList.add('scale-95', 'opacity-0');

        setTimeout(() => {
            modal.classList.add('hidden');
            modal.classList.remove('flex');
        }, 200);
    }
</script>

</html>
