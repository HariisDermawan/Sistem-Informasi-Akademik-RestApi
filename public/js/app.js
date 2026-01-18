const baseUrl = 'http://localhost:8000/api'; // Ganti sesuai URL API Laravel-mu

// --- LOGIN FORM (jika ada di halaman lain) ---
const loginForm = document.getElementById('loginForm');
if (loginForm) {
    loginForm.addEventListener('submit', async (e) => {
        e.preventDefault();
        const email = document.getElementById('email').value;
        const password = document.getElementById('password').value;
        const errorDiv = document.getElementById('error');

        try {
            const res = await fetch(`${baseUrl}/login`, {
                method: 'POST',
                headers: { 'Content-Type': 'application/json' },
                body: JSON.stringify({ email, password }),
                credentials: 'include' // Untuk session-based auth
            });
            const data = await res.json();
            if (!res.ok) {
                errorDiv.textContent = data.message || 'Login gagal';
                return;
            }

            // Simpan user di session storage
            sessionStorage.setItem('user', JSON.stringify(data.user));
            window.location.href = 'dashboard.html';
        } catch (err) {
            console.error(err);
            errorDiv.textContent = 'Login gagal, coba lagi';
        }
    });
}

// --- DASHBOARD / ADMIN PANEL ---
document.addEventListener('DOMContentLoaded', function() {
    // Mobile menu
    document.getElementById('mobileMenuBtn').addEventListener('click', function() {
        document.getElementById('mobileSidebarMenu').classList.remove('-translate-x-full');
        document.getElementById('mobileSidebar').classList.remove('hidden');
    });

    document.getElementById('mobileSidebar').addEventListener('click', function() {
        document.getElementById('mobileSidebarMenu').classList.add('-translate-x-full');
        document.getElementById('mobileSidebar').classList.add('hidden');
    });

    // User dropdown
    document.getElementById('userDropdownBtn').addEventListener('click', function() {
        document.getElementById('userDropdown').classList.toggle('hidden');
    });

    document.addEventListener('click', function(e) {
        if (!e.target.closest('#userDropdownBtn') && !e.target.closest('#userDropdown')) {
            document.getElementById('userDropdown').classList.add('hidden');
        }
    });

    // Menu navigation
    const menuItems = document.querySelectorAll('nav a');
    menuItems.forEach(item => {
        item.addEventListener('click', function(e) {
            e.preventDefault();

            // Remove active class from all menu items
            menuItems.forEach(menu => menu.classList.remove('active-menu'));

            // Add active class to clicked menu
            this.classList.add('active-menu');

            // Hide all content sections
            const contentSections = document.querySelectorAll('.content-section');
            contentSections.forEach(section => {
                section.classList.add('hidden');
                section.classList.remove('fade-in');
            });

            // Show selected content
            const menuType = this.getAttribute('data-menu');
            const contentSection = document.getElementById(menuType + 'Content');
            if (contentSection) {
                contentSection.classList.remove('hidden');
                setTimeout(() => {
                    contentSection.classList.add('fade-in');
                }, 10);

                // Load data jika berpindah ke halaman mahasiswa atau dosen
                if (menuType === 'mahasiswa') {
                    loadMahasiswaTable();
                } else if (menuType === 'dosen') {
                    loadDosenTable();
                }
            }

            // Close mobile menu if open
            if (window.innerWidth < 768) {
                document.getElementById('mobileSidebarMenu').classList.add('-translate-x-full');
                document.getElementById('mobileSidebar').classList.add('hidden');
            }
        });
    });

    // Add mahasiswa button
    document.getElementById('addMahasiswaBtn').addEventListener('click', function() {
        document.getElementById('mahasiswaModalTitle').textContent = 'Tambah Mahasiswa';
        document.getElementById('mahasiswaForm').reset();
        document.getElementById('mahasiswaId').value = '';
        document.getElementById('mahasiswaModal').classList.remove('hidden');
    });

    // Add dosen button
    document.getElementById('addDosenBtn').addEventListener('click', function() {
        document.getElementById('dosenModalTitle').textContent = 'Tambah Dosen';
        document.getElementById('dosenForm').reset();
        document.getElementById('dosenId').value = '';
        document.getElementById('dosenModal').classList.remove('hidden');
    });

    // Modal close buttons
    document.getElementById('closeMahasiswaModal').addEventListener('click', closeMahasiswaModal);
    document.getElementById('cancelMahasiswaBtn').addEventListener('click', closeMahasiswaModal);
    document.getElementById('closeDosenModal').addEventListener('click', closeDosenModal);
    document.getElementById('cancelDosenBtn').addEventListener('click', closeDosenModal);

    // Mahasiswa form submit
    document.getElementById('mahasiswaForm').addEventListener('submit', async function(e) {
        e.preventDefault();

        const id = document.getElementById('mahasiswaId').value;
        const nim = document.getElementById('nim').value;
        const nama = document.getElementById('namaMahasiswa').value;
        const prodi = document.getElementById('prodi').value;

        try {
            let url = `${baseUrl}/mahasiswa`;
            let method = 'POST';
            
            if (id) {
                url = `${baseUrl}/mahasiswa/${id}`;
                method = 'PUT';
            }

            const response = await fetch(url, {
                method: method,
                headers: { 
                    'Content-Type': 'application/json',
                    'X-CSRF-TOKEN': '{{ csrf_token() }}'
                },
                body: JSON.stringify({ 
                    nim, 
                    nama, 
                    jurusan: prodi 
                }),
                credentials: 'include'
            });

            if (response.ok) {
                showNotification('Data mahasiswa berhasil disimpan!');
                closeMahasiswaModal();
                
                // Reload data jika sedang di halaman mahasiswa
                if (!document.getElementById('mahasiswaContent').classList.contains('hidden')) {
                    loadMahasiswaTable();
                }
                
                // Update tabel dashboard
                fetchDashboardData();
            } else {
                const error = await response.json();
                showNotification('Gagal menyimpan data', error.message || 'Terjadi kesalahan', 'error');
            }
        } catch (error) {
            console.error('Error:', error);
            showNotification('Gagal menyimpan data', 'Terjadi kesalahan jaringan', 'error');
        }
    });

    // Dosen form submit
    document.getElementById('dosenForm').addEventListener('submit', async function(e) {
        e.preventDefault();

        const id = document.getElementById('dosenId').value;
        const nidn = document.getElementById('nidn').value;
        const nama = document.getElementById('namaDosen').value;
        const prodi = document.getElementById('prodi').value;

        try {
            let url = `${baseUrl}/dosen`;
            let method = 'POST';
            
            if (id) {
                url = `${baseUrl}/dosen/${id}`;
                method = 'PUT';
            }

            const response = await fetch(url, {
                method: method,
                headers: { 
                    'Content-Type': 'application/json',
                    'X-CSRF-TOKEN': '{{ csrf_token() }}'
                },
                body: JSON.stringify({ 
                    nip: nidn, 
                    nama, 
                    fakultas: prodi 
                }),
                credentials: 'include'
            });

            if (response.ok) {
                showNotification('Data dosen berhasil disimpan!');
                closeDosenModal();
                
                // Reload data jika sedang di halaman dosen
                if (!document.getElementById('dosenContent').classList.contains('hidden')) {
                    loadDosenTable();
                }
                
                // Update tabel dashboard
                fetchDashboardData();
            } else {
                const error = await response.json();
                showNotification('Gagal menyimpan data', error.message || 'Terjadi kesalahan', 'error');
            }
        } catch (error) {
            console.error('Error:', error);
            showNotification('Gagal menyimpan data', 'Terjadi kesalahan jaringan', 'error');
        }
    });

    // Logout buttons
    const logoutButtons = ['logoutBtn', 'mobileLogoutBtn', 'headerLogoutBtn'];
    logoutButtons.forEach(btnId => {
        if (document.getElementById(btnId)) {
            document.getElementById(btnId).addEventListener('click', showLogoutModal);
        }
    });

    // Logout modal buttons
    document.getElementById('cancelLogoutBtn').addEventListener('click', function() {
        document.getElementById('logoutModal').classList.add('hidden');
    });

   document.getElementById('confirmLogoutBtn').addEventListener('click', async function () {
    try {
        // Kirim request logout ke server
        await fetch(`${baseUrl}/logout`, {
            method: 'POST',
            headers: {
                'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
            },
            credentials: 'include'
        });

        // Tampilkan notifikasi
        showNotification('Logout berhasil!', 'Sampai jumpa kembali.');
        document.getElementById('logoutModal').classList.add('hidden');

        // Ambil URL dari data attribute
        const loginUrl = document.getElementById('routes')?.getAttribute('data-login-url') || '/login';
        
        // Redirect ke halaman login setelah delay
        setTimeout(() => {
            window.location.href = loginUrl;
        }, 1500);
    } catch (error) {
        console.error('Logout error:', error);
        showNotification('Logout berhasil!', 'Sampai jumpa kembali.');
        document.getElementById('logoutModal').classList.add('hidden');
        
        setTimeout(() => {
            window.location.href = 'http://localhost:8000/';
        }, 1500);
    }
});

    // Notification close
    document.getElementById('closeNotification').addEventListener('click', function() {
        hideNotification();
    });

    // Modal background click to close
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

    // Edit and delete buttons in dashboard
    document.addEventListener('click', function(e) {
        // Edit button in dashboard mahasiswa table
        if (e.target.closest('#dashboardContent .btn-edit') &&
            e.target.closest('table:first-of-type')) {
            e.preventDefault();
            const row = e.target.closest('tr');
            const cells = row.querySelectorAll('td');

            // Isi form modal dengan data dari tabel
            document.getElementById('mahasiswaModalTitle').textContent = 'Edit Mahasiswa';
            document.getElementById('mahasiswaId').value = cells[0].textContent;
            document.getElementById('nim').value = cells[2].textContent;
            document.getElementById('namaMahasiswa').value = cells[1].textContent;
            document.getElementById('prodi').value = cells[3].querySelector('span').textContent;
            document.getElementById('mahasiswaModal').classList.remove('hidden');
        }

        // Delete button in dashboard mahasiswa table
        if (e.target.closest('#dashboardContent .btn-delete') &&
            e.target.closest('table:first-of-type')) {
            e.preventDefault();
            const row = e.target.closest('tr');
            const id = row.querySelector('td:first-child').textContent;
            
            if (confirm('Apakah Anda yakin ingin menghapus data mahasiswa ini?')) {
                deleteMahasiswa(id, row);
            }
        }

        // Edit button in dashboard dosen table
        if (e.target.closest('#dashboardContent .btn-edit') &&
            e.target.closest('table:last-of-type')) {
            e.preventDefault();
            const row = e.target.closest('tr');
            const cells = row.querySelectorAll('td');

            // Isi form modal dengan data dari tabel
            document.getElementById('dosenModalTitle').textContent = 'Edit Dosen';
            document.getElementById('dosenId').value = cells[0].textContent;
            document.getElementById('nidn').value = cells[2].textContent;
            document.getElementById('namaDosen').value = cells[1].textContent;
            document.getElementById('prodi').value = cells[3].querySelector('span').textContent;
            document.getElementById('dosenModal').classList.remove('hidden');
        }

        // Delete button in dashboard dosen table
        if (e.target.closest('#dashboardContent .btn-delete') &&
            e.target.closest('table:last-of-type')) {
            e.preventDefault();
            const row = e.target.closest('tr');
            const id = row.querySelector('td:first-child').textContent;
            
            if (confirm('Apakah Anda yakin ingin menghapus data dosen ini?')) {
                deleteDosen(id, row);
            }
        }
    });

    // Fungsi untuk memuat data mahasiswa ke tabel halaman mahasiswa
    async function loadMahasiswaTable() {
        try {
            const response = await fetch(`${baseUrl}/mahasiswa`, {
                credentials: 'include'
            });
            
            if (response.ok) {
                const data = await response.json();
                const tableBody = document.getElementById('mahasiswaTableBody');
                
                if (tableBody) {
                    tableBody.innerHTML = '';
                    
                    data.data.forEach((mahasiswa, index) => {
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
                                <div class="text-gray-900">${mahasiswa.jurusan}</div>
                                <div class="text-gray-500">Aktif</div>
                            </td>
                            <td class="px-6 py-4">
                                <div class="flex items-center space-x-3">
                                    <button class="text-blue-600 hover:text-blue-900 edit-mahasiswa-list" data-id="${mahasiswa.id}">
                                        <i class="fas fa-edit"></i>
                                    </button>
                                    <button class="text-red-600 hover:text-red-900 delete-mahasiswa-list" data-id="${mahasiswa.id}">
                                        <i class="fas fa-trash"></i>
                                    </button>
                                </div>
                            </td>
                        `;
                        tableBody.appendChild(row);
                    });

                    // Tambahkan event listener untuk tombol edit dan delete di list
                    document.querySelectorAll('.edit-mahasiswa-list').forEach(button => {
                        button.addEventListener('click', async function() {
                            const id = this.getAttribute('data-id');
                            await editMahasiswaFromList(id);
                        });
                    });

                    document.querySelectorAll('.delete-mahasiswa-list').forEach(button => {
                        button.addEventListener('click', async function() {
                            const id = this.getAttribute('data-id');
                            if (confirm('Apakah Anda yakin ingin menghapus data mahasiswa ini?')) {
                                await deleteMahasiswa(id);
                            }
                        });
                    });
                }
            }
        } catch (error) {
            console.error('Error loading mahasiswa:', error);
        }
    }

    // Fungsi untuk memuat data dosen ke tabel halaman dosen
    async function loadDosenTable() {
        try {
            const response = await fetch(`${baseUrl}/dosen`, {
                credentials: 'include'
            });
            
            if (response.ok) {
                const data = await response.json();
                const tableBody = document.getElementById('dosenTableBody');
                
                if (tableBody) {
                    tableBody.innerHTML = '';
                    
                    data.data.forEach((dosen, index) => {
                        const row = document.createElement('tr');
                        row.innerHTML = `
                            <td class="px-6 py-4">
                                <div class="flex items-center">
                                    <div class="flex-shrink-0 w-10 h-10 rounded-full bg-gradient-to-br from-green-100 to-green-200 flex items-center justify-center text-green-600 font-bold">
                                        ${dosen.nama.charAt(0)}
                                    </div>
                                    <div class="ml-4">
                                        <div class="font-medium text-gray-900">${dosen.nama}</div>
                                        <div class="text-gray-500">${dosen.nip}</div>
                                    </div>
                                </div>
                            </td>
                            <td class="px-6 py-4">
                                <div class="text-gray-900">${dosen.nip}</div>
                            </td>
                            <td class="px-6 py-4">
                                <div class="text-gray-900">${dosen.fakultas || 'Teknik'}</div>
                            </td>
                            <td class="px-6 py-4">
                                <div class="flex items-center space-x-3">
                                    <button class="text-green-600 hover:text-green-900 edit-dosen-list" data-id="${dosen.id}">
                                        <i class="fas fa-edit"></i>
                                    </button>
                                    <button class="text-red-600 hover:text-red-900 delete-dosen-list" data-id="${dosen.id}">
                                        <i class="fas fa-trash"></i>
                                    </button>
                                </div>
                            </td>
                        `;
                        tableBody.appendChild(row);
                    });

                    // Tambahkan event listener untuk tombol edit dan delete di list
                    document.querySelectorAll('.edit-dosen-list').forEach(button => {
                        button.addEventListener('click', async function() {
                            const id = this.getAttribute('data-id');
                            await editDosenFromList(id);
                        });
                    });

                    document.querySelectorAll('.delete-dosen-list').forEach(button => {
                        button.addEventListener('click', async function() {
                            const id = this.getAttribute('data-id');
                            if (confirm('Apakah Anda yakin ingin menghapus data dosen ini?')) {
                                await deleteDosen(id);
                            }
                        });
                    });
                }
            }
        } catch (error) {
            console.error('Error loading dosen:', error);
        }
    }

    // Fungsi untuk mengedit mahasiswa dari list
    async function editMahasiswaFromList(id) {
        try {
            const response = await fetch(`${baseUrl}/mahasiswa/${id}`, {
                credentials: 'include'
            });
            
            if (response.ok) {
                const mahasiswa = await response.json();
                
                document.getElementById('mahasiswaModalTitle').textContent = 'Edit Mahasiswa';
                document.getElementById('mahasiswaId').value = mahasiswa.id;
                document.getElementById('nim').value = mahasiswa.nim;
                document.getElementById('namaMahasiswa').value = mahasiswa.nama;
                document.getElementById('prodi').value = mahasiswa.jurusan;
                document.getElementById('mahasiswaModal').classList.remove('hidden');
            }
        } catch (error) {
            console.error('Error fetching mahasiswa:', error);
            showNotification('Gagal memuat data', 'Terjadi kesalahan', 'error');
        }
    }

    // Fungsi untuk mengedit dosen dari list
    async function editDosenFromList(id) {
        try {
            const response = await fetch(`${baseUrl}/dosen/${id}`, {
                credentials: 'include'
            });
            
            if (response.ok) {
                const dosen = await response.json();
                
                document.getElementById('dosenModalTitle').textContent = 'Edit Dosen';
                document.getElementById('dosenId').value = dosen.id;
                document.getElementById('nidn').value = dosen.nip;
                document.getElementById('namaDosen').value = dosen.nama;
                document.getElementById('prodi').value = dosen.fakultas || 'Teknik';
                document.getElementById('dosenModal').classList.remove('hidden');
            }
        } catch (error) {
            console.error('Error fetching dosen:', error);
            showNotification('Gagal memuat data', 'Terjadi kesalahan', 'error');
        }
    }

    // Fungsi untuk menghapus mahasiswa
    async function deleteMahasiswa(id, row = null) {
        try {
            const response = await fetch(`${baseUrl}/mahasiswa/${id}`, {
                method: 'DELETE',
                headers: {
                    'X-CSRF-TOKEN': '{{ csrf_token() }}'
                },
                credentials: 'include'
            });

            if (response.ok) {
                showNotification('Data mahasiswa berhasil dihapus!');
                
                // Hapus baris dari tabel dashboard jika row diberikan
                if (row) {
                    row.remove();
                }
                
                // Reload data jika sedang di halaman mahasiswa
                if (!document.getElementById('mahasiswaContent').classList.contains('hidden')) {
                    loadMahasiswaTable();
                }
                
                // Update data dashboard
                fetchDashboardData();
            } else {
                const error = await response.json();
                showNotification('Gagal menghapus data', error.message || 'Terjadi kesalahan', 'error');
            }
        } catch (error) {
            console.error('Error deleting mahasiswa:', error);
            showNotification('Gagal menghapus data', 'Terjadi kesalahan jaringan', 'error');
        }
    }

    // Fungsi untuk menghapus dosen
    async function deleteDosen(id, row = null) {
        try {
            const response = await fetch(`${baseUrl}/dosen/${id}`, {
                method: 'DELETE',
                headers: {
                    'X-CSRF-TOKEN': '{{ csrf_token() }}'
                },
                credentials: 'include'
            });

            if (response.ok) {
                showNotification('Data dosen berhasil dihapus!');
                
                // Hapus baris dari tabel dashboard jika row diberikan
                if (row) {
                    row.remove();
                }
                
                // Reload data jika sedang di halaman dosen
                if (!document.getElementById('dosenContent').classList.contains('hidden')) {
                    loadDosenTable();
                }
                
                // Update data dashboard
                fetchDashboardData();
            } else {
                const error = await response.json();
                showNotification('Gagal menghapus data', error.message || 'Terjadi kesalahan', 'error');
            }
        } catch (error) {
            console.error('Error deleting dosen:', error);
            showNotification('Gagal menghapus data', 'Terjadi kesalahan jaringan', 'error');
        }
    }

    // Fungsi untuk mengambil data dashboard
    async function fetchDashboardData() {
        try {
            // Anda bisa menambahkan fetch untuk data statistik dashboard di sini
            // Contoh: const stats = await fetch(`${baseUrl}/dashboard/stats`, { credentials: 'include' });
        } catch (error) {
            console.error('Error fetching dashboard data:', error);
        }
    }

    // Modal functions
    function closeMahasiswaModal() {
        document.getElementById('mahasiswaModal').classList.add('hidden');
    }

    function closeDosenModal() {
        document.getElementById('dosenModal').classList.add('hidden');
    }

    function showLogoutModal() {
        document.getElementById('logoutModal').classList.remove('hidden');
    }

    function showNotification(title, message = '', type = 'success') {
        const notification = document.getElementById('notification');
        const notificationTitle = document.getElementById('notificationTitle');
        const notificationText = document.getElementById('notificationText');

        // Set warna berdasarkan type
        if (type === 'error') {
            notification.className = 'fixed top-4 right-4 bg-gradient-to-r from-red-500 to-red-600 text-white px-6 py-4 rounded-xl shadow-lg transform transition-all duration-300 translate-x-full hidden z-50 max-w-sm';
        } else {
            notification.className = 'fixed top-4 right-4 bg-gradient-to-r from-green-500 to-emerald-600 text-white px-6 py-4 rounded-xl shadow-lg transform transition-all duration-300 translate-x-full hidden z-50 max-w-sm';
        }

        notificationTitle.textContent = title;
        notificationText.textContent = message;
        notification.classList.remove('hidden');
        notification.classList.remove('translate-x-full');

        setTimeout(() => {
            hideNotification();
        }, 4000);
    }

    function hideNotification() {
        const notification = document.getElementById('notification');
        notification.classList.add('translate-x-full');
        setTimeout(() => {
            notification.classList.add('hidden');
        }, 300);
    }

    // Load initial data jika halaman dashboard terbuka
    if (!document.getElementById('dashboardContent').classList.contains('hidden')) {
        fetchDashboardData();
    }
});