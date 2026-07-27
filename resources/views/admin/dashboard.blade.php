@extends('admin.layout')

@section('title', 'Admin Dashboard - Task Management')

@section('styles')
<style>
    .stats-grid {
        display: grid;
        grid-template-columns: repeat(auto-fit, minmax(220px, 1fr));
        gap: 1.25rem;
        margin-bottom: 1.75rem;
    }

    .stat-card {
        background: #ffffff;
        border: 1px solid var(--border-color);
        border-top: 4px solid var(--primary-blue);
        border-radius: 6px;
        padding: 1.25rem;
        display: flex;
        align-items: center;
        gap: 1rem;
        box-shadow: 0 1px 3px rgba(0,0,0,0.05);
    }

    .stat-icon {
        width: 44px;
        height: 44px;
        background: #e7f1ff;
        color: #0c419a;
        border-radius: 4px;
        display: flex;
        align-items: center;
        justify-content: center;
        font-size: 1.25rem;
    }

    .stat-val {
        font-size: 1.6rem;
        font-weight: 700;
        color: #1e293b;
        line-height: 1.2;
    }

    .stat-lbl {
        color: var(--text-muted);
        font-size: 0.85rem;
    }

    .quick-actions {
        display: flex;
        gap: 0.75rem;
    }
</style>
@endsection

@section('content')
<div style="margin-bottom: 1.5rem;">
    <h1 style="font-size: 1.5rem; font-weight: 700; color: #1e293b;">Dashboard Overview</h1>
    <p style="color: var(--text-muted); font-size: 0.875rem;">Welcome back, {{ $user->name }}!</p>
</div>

<!-- Metrics Cards -->
<div class="stats-grid">
    <div class="stat-card" id="card-total-staff">
        <div class="stat-icon">👥</div>
        <div>
            <div class="stat-val" id="stat-total-staff-val">{{ $stats['total_staff'] }}</div>
            <div class="stat-lbl">Total Staff</div>
        </div>
    </div>

    <div class="stat-card" id="card-total-tasks">
        <div class="stat-icon">📋</div>
        <div>
            <div class="stat-val" id="stat-total-tasks-val">{{ $stats['total_tasks'] }}</div>
            <div class="stat-lbl">Total Tasks</div>
        </div>
    </div>

    <div class="stat-card" id="card-open-tasks">
        <div class="stat-icon">⏳</div>
        <div>
            <div class="stat-val" id="stat-open-tasks-val">{{ $stats['open_tasks'] }}</div>
            <div class="stat-lbl">Open Tasks</div>
        </div>
    </div>

    <div class="stat-card" id="card-closed-tasks">
        <div class="stat-icon">✅</div>
        <div>
            <div class="stat-val" id="stat-closed-tasks-val">{{ $stats['closed_tasks'] }}</div>
            <div class="stat-lbl">Closed Tasks</div>
        </div>
    </div>
</div>

<!-- Recent Activity / Quick Actions -->
<div class="card">
    <div class="card-header-flex">
        <h2 class="card-title">Quick System Management</h2>
        <div class="quick-actions">
            <a href="{{ route('admin.staff.create') }}" class="btn-primary" id="btn-add-staff-quick">+ Add Staff</a>
            <a href="{{ route('admin.tasks.create') }}" class="btn-secondary" id="btn-create-task-quick">+ Create Task</a>
        </div>
    </div>

    <h3 style="font-size: 0.95rem; margin-bottom: 1rem; color: #475569;">Recent Tasks</h3>
    @if($recentTasks->isEmpty())
        <p style="color: var(--text-muted); font-size: 0.9rem;">No tasks created yet.</p>
    @else
        <div class="table-responsive">
            <table class="data-table">
                <thead>
                    <tr>
                        <th>Title</th>
                        <th>Assigned Staff</th>
                        <th>Status</th>
                        <th>Created At</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($recentTasks as $task)
                        <tr>
                            <td><strong>{{ $task->title }}</strong></td>
                            <td>{{ $task->user->name ?? 'Unassigned' }}</td>
                            <td>
                                <span class="badge badge-{{ $task->status }}">
                                    {{ ucfirst($task->status) }}
                                </span>
                            </td>
                            <td>{{ $task->created_at->format('M d, Y') }}</td>
                            <td>
                                <a href="{{ route('admin.tasks.show', $task->id) }}" class="btn-info-sm">View</a>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    @endif
</div>
@endsection
