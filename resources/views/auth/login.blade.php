<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login - Sistem Kampus</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>

<body class="bg-gradient-to-r from-blue-500 to-indigo-600 h-screen flex items-center justify-center font-sans">

    <div class="bg-white rounded-3xl shadow-xl w-full max-w-md p-8">
        <!-- Logo -->
        <div class="flex justify-center mb-6">
            <img src="{{ asset('img/unpam.png') }}" alt="Logo" class="w-24 h-24">
        </div>

        <h1 class="text-3xl font-bold text-center text-gray-700 mb-2">Login Admin</h1>
        <p class="text-center text-gray-500 mb-6">Sistem Absensi Mahasiswa & Dosen</p>

        <!-- Error Message -->
        <div id="error-msg" class="bg-red-100 text-red-700 p-3 rounded mb-4 text-center hidden"></div>

        <form id="login-form" action="{{ route('login.submit') }}" method="POST" class="space-y-6">
            @csrf
            <!-- Email -->
            <div class="relative">
                <input type="email" name="email" required placeholder=" "
                    class="peer placeholder-transparent w-full px-4 pt-5 pb-2 border rounded-xl focus:outline-none focus:ring-2 focus:ring-blue-500">
                <label
                    class="absolute left-4 top-2 text-gray-400 text-sm transition-all
                  peer-placeholder-shown:top-5 peer-placeholder-shown:text-gray-400 peer-placeholder-shown:text-base
                  peer-focus:top-2 peer-focus:text-gray-700 peer-focus:text-sm">Email</label>
            </div>

            <!-- Password -->
            <div class="relative">
                <input type="password" name="password" required placeholder=" "
                    class="peer placeholder-transparent w-full px-4 pt-5 pb-2 border rounded-xl focus:outline-none focus:ring-2 focus:ring-blue-500">
                <label
                    class="absolute left-4 top-2 text-gray-400 text-sm transition-all
                  peer-placeholder-shown:top-5 peer-placeholder-shown:text-gray-400 peer-placeholder-shown:text-base
                  peer-focus:top-2 peer-focus:text-gray-700 peer-focus:text-sm">Password</label>
            </div>

            <!-- Submit Button -->
            <button type="submit"
                class="w-full bg-gradient-to-r from-blue-500 to-indigo-600 text-white py-3 rounded-xl shadow-lg hover:from-blue-600 hover:to-indigo-700 transition-all">
                Masuk
            </button>
        </form>

        <p class="text-center text-gray-400 mt-6 text-sm">&copy; 2026 Sistem Kampus. All rights reserved.</p>
    </div>

    <script>
        document.getElementById('login-form').addEventListener('submit', async function(e) {
            e.preventDefault();
            const form = this;
            const formData = new FormData(form);

            try {
                const res = await fetch(form.action, {
                    method: 'POST',
                    body: formData,
                    headers: {
                        'X-Requested-With': 'XMLHttpRequest'
                    }
                });

                if (res.ok) {
                    // redirect ke dashboard
                    window.location.href = "{{ route('dashboard') }}";
                } else {
                    const errorDiv = document.getElementById('error-msg');
                    errorDiv.textContent = 'Email atau password salah!';
                    errorDiv.classList.remove('hidden');
                }
            } catch (err) {
                const errorDiv = document.getElementById('error-msg');
                errorDiv.textContent = 'Terjadi kesalahan, silakan coba lagi.';
                errorDiv.classList.remove('hidden');
            }
        });
    </script>


</body>

</html>
