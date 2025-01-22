<?php

namespace App\Http\Controllers;

use App\Models\Task;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class TaskController extends Controller
{
    // Menampilkan daftar tugas
    public function index()
    {
        $tasks = Task::where('user_id', Auth::id())->get();
        return view('tasks.index', compact('tasks'));
    }

    public function create()
    {
        return view('tasks.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'nullable|string',
            'status' => 'required|in:Pending,In Progress,Completed',
        ]);

        // Tambahkan user_id saat menyimpan data
        Task::create([
            'title' => $request->title,
            'description' => $request->description,
            'status' => $request->status,
            'user_id' => Auth::id(), // Menyimpan user_id pengguna yang sedang login
        ]);

        return redirect('/tasks')->with('success', 'Tugas berhasil ditambahkan!');
    }

    public function edit(Task $task)
    {
        $this->authorizeTask($task); // Pastikan hanya pemilik tugas yang bisa mengedit
        return view('tasks.edit', compact('task'));
    }

    public function update(Request $request, Task $task)
    {
        $this->authorizeTask($task); // Pastikan hanya pemilik tugas yang bisa mengupdate

        $request->validate([
            'title' => 'required|string|max:255',
        ]);

        $task->update($request->all());

        return redirect('/tasks')->with('success', 'Tugas berhasil diupdate!.');
    }

    public function destroy(Task $task)
    {
        $this->authorizeTask($task); // Pastikan hanya pemilik tugas yang bisa menghapus
        $task->delete();

        return redirect('/tasks')->with('success', 'Tugas berhasil dihapus!.');
    }

    protected function authorizeTask(Task $task)
    {
        if ($task->user_id !== Auth::id()) {
            abort(403, 'Unauthorized action.');
        }
    }
}
