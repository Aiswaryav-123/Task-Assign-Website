@extends('users.layout')

@section('title', 'My Assigned Tasks - Staff Dashboard')

@section('styles')
<style>
    .stats-summary {
        display: grid;
        grid-template-columns: repeat(auto-fit, minmax(200px, 1fr));
        gap: 1.25rem;
        margin-bottom: 1.75rem;
    }

    .summary-card {
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

    .summary-icon {
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

    .summary-val {
        font-size: 1.5rem;
        font-weight: 700;
        color: #1e293b;
    }

    .summary-lbl {
        color: var(--text-muted);
        font-size: 0.85rem;
    }
</style>
@endsection

@section('content')
<div style="margin-bottom: 1.5rem;">
    <h1 style="font-size: 1.5rem; font-weight: 700; color: #1e293b;">My Assigned Tasks</h1>
    <p style="color: var(--text-muted); font-size: 0.875rem;">Welcome, {{ $user->name }}!</p>
</div>

<!-- Task Overview Metrics -->
<div class="stats-summary">
    <div class="summary-card" id="staff-stat-total">
        <div class="summary-icon">📋</div>
        <div>
            <div class="summary-val">{{ $stats['total_assigned'] }}</div>
            <div class="summary-lbl">Total Assigned Tasks</div>
        </div>
    </div>

    <div class="summary-card" id="staff-stat-open">
        <div class="summary-icon">⏳</div>
        <div>
            <div class="summary-val">{{ $stats['open_tasks'] }}</div>
            <div class="summary-lbl">Open Tasks</div>
        </div>
    </div>

    <div class="summary-card" id="staff-stat-completed">
        <div class="summary-icon">✅</div>
        <div>
            <div class="summary-val">{{ $stats['completed_tasks'] }}</div>
            <div class="summary-lbl">Completed Tasks</div>
        </div>
    </div>
</div>

<div class="card">
    <div class="card-header-flex">
        <h2 class="card-title">Assigned Task List</h2>
    </div>

    @if($tasks->isEmpty())
        <div style="text-align: center; padding: 2rem; color: var(--text-muted);">
            No tasks assigned to you right now.
        </div>
    @else
        <div class="table-responsive">
            <table class="data-table">
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Task Title</th>
                        <th>Status</th>
                        <th>Assigned On</th>
                        <th>Quick Status Update</th>
                        <th style="text-align: right;">Action</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($tasks as $task)
                        <tr>
                            <td>#{{ $task->id }}</td>
                            <td><strong>{{ $task->title }}</strong></td>
                            <td>
                                <span class="badge badge-{{ $task->status }}">
                                    {{ ucfirst($task->status) }}
                                </span>
                            </td>
                            <td>{{ $task->created_at->format('M d, Y') }}</td>
                            <td>
                                <!-- Quick Status Update Form (Staff status update only) -->
                                <form action="{{ route('staff.tasks.updateStatus', $task->id) }}" method="POST" style="display: flex; align-items: center; gap: 0.5rem;">
                                    @csrf
                                    @method('PATCH')
                                    <select name="status" class="form-control" style="font-size: 0.8rem; padding: 0.3rem 0.5rem; max-width: 130px;" onchange="this.form.submit()">
                                        <option value="open" {{ $task->status === 'open' ? 'selected' : '' }}>Open</option>
                                        <option value="completed" {{ $task->status === 'completed' ? 'selected' : '' }}>Completed</option>
                                    </select>
                                </form>
                            </td>
                            <td style="text-align: right;">
                                <a href="{{ route('staff.tasks.show', $task->id) }}" class="btn-info-sm" id="view-assigned-task-{{ $task->id }}">View Details</a>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    @endif
</div>
@endsection
