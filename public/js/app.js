const baseUrl = 'http://localhost:8000/api'; // Ganti sesuai URL API Laravel-mu

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

// --- DASHBOARD ---
if (window.location.pathname.includes('dashboard.html')) {

    const mahasiswaTable = document.getElementById('mahasiswaTable');
    const dosenTable = document.getElementById('dosenTable');
    const logoutBtn = document.getElementById('logoutBtn');

    // Logout
    logoutBtn.addEventListener('click', async () => {
        await fetch(`${baseUrl}/logout`, {
            method: 'POST',
            credentials: 'include'
        });
        sessionStorage.clear();
        window.location.href = 'index.html';
    });

    // Fetch Mahasiswa
    async function fetchMahasiswa() {
        const res = await fetch(`${baseUrl}/mahasiswa`, { credentials: 'include' });
        const data = await res.json();
        mahasiswaTable.innerHTML = '';
        data.data.forEach(m => {
            mahasiswaTable.innerHTML += `
                <tr>
                    <td class="border px-4 py-2">${m.nim}</td>
                    <td class="border px-4 py-2">${m.nama}</td>
                    <td class="border px-4 py-2">${m.jurusan}</td>
                </tr>
            `;
        });
    }

    // Fetch Dosen
    async function fetchDosen() {
        const res = await fetch(`${baseUrl}/dosen`, { credentials: 'include' });
        const data = await res.json();
        dosenTable.innerHTML = '';
        data.data.forEach(d => {
            dosenTable.innerHTML += `
                <tr>
                    <td class="border px-4 py-2">${d.nip}</td>
                    <td class="border px-4 py-2">${d.nama}</td>
                    <td class="border px-4 py-2">${d.jurusan}</td>
                </tr>
            `;
        });
    }

    fetchMahasiswa();
    fetchDosen();
}
