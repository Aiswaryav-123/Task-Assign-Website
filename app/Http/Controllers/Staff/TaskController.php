<?php

namespace App\Http\Controllers\Staff;

use App\Http\Controllers\Controller;
use App\Models\Task;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\Rule;

class TaskController extends Controller
{
    /**
     * Display assigned task details for Staff member.
     */
    public function show($id)
    {
        $task = Task::where('user_id', Auth::id())->findOrFail($id);
        return view('users.tasks.show', compact('task'));
    }

    /**
     * Update task status ONLY. Staff restricted from changing title or assignment.
     */
    public function updateStatus(Request $request, $id)
    {
        $task = Task::where('user_id', Auth::id())->findOrFail($id);

        $validated = $request->validate([
            'status' => ['required', Rule::in(['open', 'completed'])],
        ]);

        $task->update([
            'status' => $validated['status'],
        ]);

        return redirect()->back()->with('status', 'Task status updated successfully!');
    }
}
