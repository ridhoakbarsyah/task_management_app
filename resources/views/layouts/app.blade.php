<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'Manajemen Tugas')</title>
    <!-- Tailwind CSS -->
    <script src="https://cdn.tailwindcss.com"></script>
    <!-- SweetAlert2 CSS -->
    <link href="https://cdn.jsdelivr.net/npm/sweetalert2@11/dist/sweetalert2.min.css" rel="stylesheet">
</head>

<body class="flex flex-col min-h-screen bg-gray-100">
    <!-- Navbar -->
    <nav class="bg-white shadow-md sticky top-0 z-10">
        <div class="container mx-auto px-4 flex items-center justify-between py-4">
            <a class="text-lg font-bold text-blue-600 hover:text-blue-800 transition" href="#">Manajemen Tugas</a>
            <button class="lg:hidden text-gray-500 focus:outline-none" id="menu-button">
                <svg class="w-6 h-6" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                    stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16m-7 6h7" />
                </svg>
            </button>
            <div class="hidden lg:flex space-x-6 items-center" id="navbarNav">
                <ul class="flex space-x-4 items-center">
                    @auth
                        <li>
                            <a class="text-gray-700 hover:text-blue-600 transition" href="/tasks">Tugas</a>
                        </li>
                        <li>
                            <form action="{{ route('logout') }}" method="POST">
                                @csrf
                                <button type="submit" class="btn btn-danger">Logout</button>
                            </form>
                        </li>
                    @else
                        <li>
                            <a class="text-gray-700 hover:text-blue-600 transition" href="/login">Login</a>
                        </li>
                        <li>
                            <a class="text-gray-700 hover:text-blue-600 transition" href="/register">Register</a>
                        </li>
                    @endauth
                </ul>
            </div>
        </div>
    </nav>

    <!-- Main Content -->
    <main class="flex-grow container mx-auto px-4 mt-8">
        <div class="flex justify-center">
            <div class="w-full lg:w-2/3 bg-white rounded-lg shadow-lg p-6">
                @yield('content')
            </div>
        </div>
    </main>

    <!-- Footer -->
    <footer class="bg-white shadow-inner py-4 text-center">
        <div class="container mx-auto px-4">
            <p class="text-gray-600">
                &copy; {{ date('Y') }} <a href="#" class="text-blue-500 hover:underline">Manajemen
                    Tugas</a>.<br>
                Ridho Akbarsyah Ramadhan
            </p>
        </div>
    </footer>

    <!-- Navbar Toggle Script -->
    <script>
        document.getElementById('menu-button').addEventListener('click', function() {
            const navbarNav = document.getElementById('navbarNav');
            navbarNav.classList.toggle('hidden');
            navbarNav.classList.toggle('flex');
            navbarNav.classList.toggle('flex-col');
            navbarNav.classList.toggle('items-center');
        });
    </script>

    <!-- SweetAlert2 JS -->
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11/dist/sweetalert2.all.min.js"></script>

    <script>
        // Menambahkan konfirmasi penghapusan menggunakan SweetAlert2
        const deleteForms = document.querySelectorAll('.delete-form');
        deleteForms.forEach((form) => {
            form.addEventListener('submit', function(event) {
                event.preventDefault(); // Mencegah pengiriman form langsung

                const taskTitle = this.closest('tr').querySelector('td:nth-child(2)')
                    .textContent; // Mengambil title tugas

                // Menampilkan SweetAlert2 konfirmasi
                Swal.fire({
                    title: Hapus Tugas: $ {
                        taskTitle
                    } ? ,
                    text: "Apakah Anda yakin ingin menghapus tugas ini?",
                    icon: 'warning',
                    showCancelButton: true,
                    confirmButtonColor: '#3085d6',
                    cancelButtonColor: '#d33',
                    confirmButtonText: 'Hapus',
                    cancelButtonText: 'Batal'
                }).then((result) => {
                    if (result.isConfirmed) {
                        form.submit(); // Kirim form jika user mengonfirmasi
                        Swal.fire(
                            'Dihapus!',
                            Tugas "${taskTitle}"
                            telah dihapus.,
                            'success'
                        );
                    }
                });
            });
        });

        // Waktu timeout untuk logout otomatis
        const sessionTimeout = 15 * 60 * 1000;
        const warningTime = 2 * 60 * 1000; // 2 menit sebelum logout

        let timeout;
        let warningTimeout;

        function startSessionTimeout() {
            clearTimeout(timeout);
            clearTimeout(warningTimeout);

            // peringatan 2 menit sebelum logout
            warningTimeout = setTimeout(() => {
                alert("Anda akan logout dalam 2 menit karena tidak ada aktivitas.");
            }, sessionTimeout - warningTime);

            // Logout otomatis setelah 15 menit
            timeout = setTimeout(() => {
                alert("Anda telah logout karena tidak ada aktivitas.");
                window.location.href = "{{ route('logout') }}";
            }, sessionTimeout);
        }

        // Reset timer setiap ada aktivitas
        function resetSessionTimeout() {
            startSessionTimeout();
        }

        // Event listener untuk aktivitas pengguna
        window.onload = startSessionTimeout;
        document.addEventListener('mousemove', resetSessionTimeout);
        document.addEventListener('keydown', resetSessionTimeout);
    </script>
</body>

</html>
