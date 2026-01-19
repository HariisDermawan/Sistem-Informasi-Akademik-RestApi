document.getElementById('toggleSidebar').addEventListener('click', function () {
    const sidebar = document.getElementById('sidebar');
    sidebar.classList.toggle('hidden');
    sidebar.classList.toggle('absolute');
    sidebar.classList.toggle('z-50');
    sidebar.classList.toggle('h-full');
});

document.addEventListener('click', function (event) {
    const sidebar = document.getElementById('sidebar');
    const toggleBtn = document.getElementById('toggleSidebar');

    // Jika sidebar sedang terbuka di mobile dan klik di luar sidebar dan toggle button
    if (window.innerWidth < 768 &&
        !sidebar.classList.contains('hidden') &&
        !sidebar.contains(event.target) &&
        !toggleBtn.contains(event.target)) {
        sidebar.classList.add('hidden');
    }
});

// Responsif: sembunyikan sidebar secara default di mobile
window.addEventListener('resize', function () {
    const sidebar = document.getElementById('sidebar');
    if (window.innerWidth >= 768) {
        sidebar.classList.remove('hidden', 'absolute', 'z-50', 'h-full');
    } else {
        // Di mobile, sembunyikan sidebar secara default
        sidebar.classList.add('hidden');
    }
});

// Inisialisasi: sembunyikan sidebar di mobile saat pertama kali load
if (window.innerWidth < 768) {
    document.getElementById('sidebar').classList.add('hidden');
}
function updateClock() {
    const now = new Date();

    // Format waktu
    const hours = now.getHours().toString().padStart(2, '0');
    const minutes = now.getMinutes().toString().padStart(2, '0');
    const seconds = now.getSeconds().toString().padStart(2, '0');
    const timeString = `${hours}:${minutes}:${seconds}`;

    // Format tanggal
    const days = ['Minggu', 'Senin', 'Selasa', 'Rabu', 'Kamis', 'Jumat', 'Sabtu'];
    const months = ['Januari', 'Februari', 'Maret', 'April', 'Mei', 'Juni',
        'Juli', 'Agustus', 'September', 'Oktober', 'November', 'Desember'];

    const dayName = days[now.getDay()];
    const date = now.getDate();
    const monthName = months[now.getMonth()];
    const year = now.getFullYear();
    const dateString = `${dayName}, ${date} ${monthName} ${year}`;

    // Update elemen
    document.getElementById('real-time-clock').textContent = timeString;
    document.getElementById('current-date').textContent = dateString;
}


document.addEventListener('DOMContentLoaded', function () {
    const msg = localStorage.getItem('loginSuccess');
    if (msg) {
        const container = document.createElement('div');
        container.className = 'bg-green-100 text-green-700 p-3 rounded mb-4 text-center';
        container.textContent = msg;

        const main = document.querySelector('main');
        main.insertBefore(container, main.firstChild);

        // Hapus pesan setelah ditampilkan
        localStorage.removeItem('loginSuccess');
    }
});
// Update jam setiap detik
updateClock();
setInterval(updateClock, 1000);

