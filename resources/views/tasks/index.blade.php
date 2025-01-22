<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Daftar Tugas</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11/dist/sweetalert2.all.min.js"></script>
</head>

<body class="bg-gray-100">

    <!-- Navbar -->
    <nav class="bg-gradient-to-r from-blue-500 to-indigo-700 p-4 shadow-lg">
        <div class="container mx-auto flex justify-between items-center">
            <a href="#" class="text-white text-2xl font-semibold">Daftar Tugas</a>
            <div class="flex items-center">
                <!-- Untuk sapaan -->
                <span class="text-white text-lg mr-4" id="greeting"></span>
                <form id="logout-form" action="/logout" method="POST">
                    @csrf
                    <button type="button"
                        class="bg-white text-blue-700 px-4 py-2 rounded-md shadow-md hover:bg-gray-100"
                        id="logout-button">Logout</button>
                </form>
            </div>
        </div>
    </nav>

    <!-- Main Container -->
    <div class="container mx-auto mt-8 px-4">

        <!-- Button Tambah Tugas -->
        <a href="/tasks/create"
            class="bg-green-500 hover:bg-green-600 text-white font-bold py-2 px-4 rounded-md shadow-lg mb-4 inline-flex items-center">
            <i class="fas fa-plus mr-2"></i> Tambah Tugas
        </a>

        <!-- Menampilkan tabel Tugas yang sudah dibuat -->
        <div class="overflow-x-auto bg-white rounded-lg shadow-lg">
            <table class="min-w-full table-auto">
                <thead class="bg-blue-500 text-white">
                    <tr>
                        <th class="py-2 px-4 text-center">No</th>
                        <th class="py-2 px-4 text-center">Title</th>
                        <th class="py-2 px-4 text-center">Description</th>
                        <th class="py-2 px-4 text-center">Status</th>
                        <th class="py-2 px-4 text-center">Action</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($tasks as $task)
                        <tr class="border-t">
                            <td class="py-2 px-4 text-center">{{ $loop->iteration }}</td>
                            <td class="py-2 px-4 text-center">{{ $task->title }}</td>
                            <td class="py-2 px-4 text-center">{{ $task->description }}</td>
                            <td class="py-2 px-4 text-center">
                                <span
                                    class="inline-block px-2 py-1 text-white rounded-full
                                    {{ $task->status === 'completed'
                                        ? 'bg-green-500'
                                        : ($task->status === 'in-progress'
                                            ? 'bg-yellow-500'
                                            : 'bg-gray-500') }}">
                                    {{ ucfirst($task->status) }}
                                </span>
                            </td>
                            <td class="py-2 px-4 text-center">
                                <a href="/tasks/{{ $task->id }}/edit"
                                    class="bg-yellow-500 hover:bg-yellow-600 text-white py-1 px-3 rounded-md shadow-sm mr-2">Edit</a>
                                <form action="/tasks/{{ $task->id }}" method="POST"
                                    class="d-inline delete-form inline-block">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit"
                                        class="bg-red-500 hover:bg-red-600 text-white py-1 px-3 rounded-md shadow-sm">Hapus</button>
                                </form>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const greetingElement = document.getElementById('greeting');
            const userName = '{{ auth()->user()->name }}'; // untuk mengambil nama berdasar user login

            const currentHour = new Date().getHours();
            let greeting;

            // Menentukan sapaan berdasarkan waktu
            if (currentHour >= 5 && currentHour < 12) {
                greeting = `Selamat Pagi, ${userName}`;
            } else if (currentHour >= 12 && currentHour < 18) {
                greeting = `Selamat Siang, ${userName}`;
            } else if (currentHour >= 18 && currentHour < 21) {
                greeting = `Selamat Sore, ${userName}`;
            } else {
                greeting = `Selamat Malam, ${userName}`;
            }

            // Menampilkan sapaan di navbar
            greetingElement.textContent = greeting;

            // Konfirmasi logout
            const logoutButton = document.getElementById('logout-button');
            logoutButton.addEventListener('click', function() {
                Swal.fire({
                    title: 'Anda yakin ingin logout?',
                    icon: 'warning',
                    showCancelButton: true,
                    confirmButtonText: 'Ya',
                    cancelButtonText: 'Batal',
                }).then((result) => {
                    if (result.isConfirmed) document.getElementById('logout-form').submit();
                });
            });

            // Konfirmasi delete
            document.querySelectorAll('.delete-form').forEach((form) => {
                form.addEventListener('submit', function(e) {
                    e.preventDefault();
                    Swal.fire({
                        title: 'Yakin hapus tugas?',
                        icon: 'warning',
                        showCancelButton: true,
                        confirmButtonText: 'Hapus',
                        cancelButtonText: 'Batal',
                    }).then((result) => {
                        if (result.isConfirmed) form.submit();
                    });
                });
            });
        });
    </script>
</body>

</html>
