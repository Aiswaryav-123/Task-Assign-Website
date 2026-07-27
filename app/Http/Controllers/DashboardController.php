<?php

namespace App\Http\Controllers;

use App\Models\Task;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class DashboardController extends Controller
{
    /**
     * Display Admin Dashboard.
     */
    public function adminDashboard()
    {
        $user = Auth::user();

        $stats = [
            'total_staff' => User::staff()->count(),
            'total_tasks' => Task::count(),
            'open_tasks' => Task::where('status', 'open')->count(),
            'closed_tasks' => Task::where('status', 'completed')->count(),
        ];

        $recentTasks = Task::with('user')->latest()->take(5)->get();

        return view('admin.dashboard', compact('user', 'stats', 'recentTasks'));
    }

    /**
     * Display Staff Dashboard.
     */
    public function staffDashboard()
    {
        $user = Auth::user();

        $tasks = Task::where('user_id', $user->id)->latest()->get();

        $stats = [
            'total_assigned' => $tasks->count(),
            'open_tasks' => $tasks->where('status', 'open')->count(),
            'completed_tasks' => $tasks->where('status', 'completed')->count(),
        ];

        return view('users.dashboard', compact('user', 'tasks', 'stats'));
    }
}
