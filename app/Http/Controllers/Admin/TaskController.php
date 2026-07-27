<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Task;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;

class TaskController extends Controller
{
    /**
     * Display a listing of tasks for Admin.
     */
    public function index(Request $request)
    {
        $query = Task::with('user');

        if ($request->filled('status')) {
            $query->where('status', $request->status);
        }

        if ($request->filled('staff_id')) {
            $query->where('user_id', $request->staff_id);
        }

        if ($request->filled('search')) {
            $search = $request->search;
            $query->where(function ($q) use ($search) {
                $q->where('title', 'like', "%{$search}%")
                  ->orWhere('description', 'like', "%{$search}%");
            });
        }

        $tasks = $query->latest()->paginate(10);
        $staffMembers = User::staff()->get();

        return view('admin.tasks.index', compact('tasks', 'staffMembers'));
    }

    /**
     * Show the form for creating a new task.
     */
    public function create()
    {
        $staffMembers = User::staff()->where('status', 'active')->get();
        return view('admin.tasks.create', compact('staffMembers'));
    }

    /**
     * Store a newly created task in storage.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'title' => ['required', 'string', 'max:255'],
            'description' => ['required', 'string'],
            'status' => ['required', Rule::in(['open', 'completed'])],
            'user_id' => ['required', 'exists:users,id'],
        ]);

        Task::create($validated);

        return redirect()->route('admin.tasks.index')->with('status', 'Task created and assigned successfully!');
    }

    /**
     * Display the specified task.
     */
    public function show($id)
    {
        $task = Task::with('user')->findOrFail($id);
        return view('admin.tasks.show', compact('task'));
    }

    /**
     * Show the form for editing the specified task.
     */
    public function edit($id)
    {
        $task = Task::findOrFail($id);
        $staffMembers = User::staff()->get();
        return view('admin.tasks.edit', compact('task', 'staffMembers'));
    }

    /**
     * Update the specified task in storage.
     */
    public function update(Request $request, $id)
    {
        $task = Task::findOrFail($id);

        $validated = $request->validate([
            'title' => ['required', 'string', 'max:255'],
            'description' => ['required', 'string'],
            'status' => ['required', Rule::in(['open', 'completed'])],
            'user_id' => ['required', 'exists:users,id'],
        ]);

        $task->update($validated);

        return redirect()->route('admin.tasks.index')->with('status', 'Task updated successfully!');
    }

    /**
     * Remove the specified task from storage.
     */
    public function destroy($id)
    {
        $task = Task::findOrFail($id);
        $task->delete();

        return redirect()->route('admin.tasks.index')->with('status', 'Task deleted successfully.');
    }
}
