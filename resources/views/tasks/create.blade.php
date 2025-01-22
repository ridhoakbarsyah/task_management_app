<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tambah Tugas</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>

<body class="bg-gray-100 font-sans">
    <div class="max-w-lg mx-auto mt-10 p-8 bg-white rounded-lg shadow-md">
        <h2 class="text-2xl font-bold text-center text-blue-600 mb-6">Tambah Tugas</h2>
        <form method="POST" action="/tasks">
            @csrf
            <div class="mb-4">
                <label for="title" class="block text-lg font-semibold text-gray-700 mb-2">Title</label>
                <input type="text"
                    class="w-full px-4 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500"
                    id="title" name="title" placeholder="Enter task title" required>
            </div>
            <div class="mb-4">
                <label for="description" class="block text-lg font-semibold text-gray-700 mb-2">Description</label>
                <textarea class="w-full px-4 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500"
                    id="description" name="description" rows="4" placeholder="Describe your task"></textarea>
            </div>
            <div class="mb-4">
                <label for="status" class="block text-lg font-semibold text-gray-700 mb-2">Status</label>
                <select
                    class="w-full px-4 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500"
                    id="status" name="status" required>
                    <option value="Pending">Pending</option>
                    <option value="In Progress">In Progress</option>
                    <option value="Completed">Completed</option>
                </select>
            </div>
            <div class="flex justify-between">
                <button type="submit"
                    class="px-6 py-2 bg-blue-600 text-white rounded-md hover:bg-blue-700 focus:outline-none">Tambah</button>
                <a href="/tasks"
                    class="px-6 py-2 bg-gray-300 text-gray-800 rounded-md hover:bg-gray-400 focus:outline-none">Back</a>
            </div>
        </form>
    </div>
</body>

</html>
