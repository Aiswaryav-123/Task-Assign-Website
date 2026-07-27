@extends('admin.layout')

@section('title', 'Staff Details - Admin Panel')

@section('content')
<div class="card" style="margin-bottom: 1.5rem;">
    <div class="card-header-flex">
        <div>
            <h1 class="card-title">Staff Details</h1>
            <p style="color: var(--text-muted); font-size: 0.875rem;">Profile & assigned tasks breakdown</p>
        </div>
        <div style="display: flex; gap: 0.5rem;">
            <a href="{{ route('admin.staff.edit', $staff->id) }}" class="btn-edit-sm" style="padding: 0.5rem 1rem; font-size: 0.85rem;">Edit Staff</a>
            <a href="{{ route('admin.staff.index') }}" class="btn-secondary">← Back to Staff List</a>
        </div>
    </div>

    <div style="display: grid; grid-template-columns: repeat(auto-fit, minmax(200px, 1fr)); gap: 1.5rem; background: rgba(15, 23, 42, 0.6); padding: 1.25rem; border-radius: var(--radius-md); border: 1px solid var(--border-color);">
        <div>
            <div style="color: var(--text-muted); font-size: 0.8rem; text-transform: uppercase;">Staff Name</div>
            <div style="font-size: 1.1rem; font-weight: 700; margin-top: 0.2rem;">{{ $staff->name }}</div>
        </div>
        <div>
            <div style="color: var(--text-muted); font-size: 0.8rem; text-transform: uppercase;">Email Address</div>
            <div style="font-size: 1rem; margin-top: 0.2rem;">{{ $staff->email }}</div>
        </div>
        <div>
            <div style="color: var(--text-muted); font-size: 0.8rem; text-transform: uppercase;">Account Status</div>
            <div style="margin-top: 0.2rem;">
                <span class="badge badge-{{ $staff->status }}">{{ ucfirst($staff->status) }}</span>
            </div>
        </div>
        <div>
            <div style="color: var(--text-muted); font-size: 0.8rem; text-transform: uppercase;">Joined Date</div>
            <div style="font-size: 0.95rem; margin-top: 0.2rem;">{{ $staff->created_at->format('M d, Y h:i A') }}</div>
        </div>
    </div>
</div>

<div class="card">
    <h2 class="card-title" style="margin-bottom: 1rem;">Assigned Tasks ({{ $staff->tasks->count() }})</h2>

    @if($staff->tasks->isEmpty())
        <div style="color: var(--text-muted); padding: 1.5rem; text-align: center;">
            No tasks currently assigned to this staff member.
        </div>
    @else
        <div class="table-responsive">
            <table class="data-table">
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Task Title</th>
                        <th>Status</th>
                        <th>Created At</th>
                        <th style="text-align: right;">Action</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($staff->tasks as $task)
                        <tr>
                            <td>#{{ $task->id }}</td>
                            <td><strong>{{ $task->title }}</strong></td>
                            <td>
                                <span class="badge badge-{{ $task->status }}">{{ ucfirst($task->status) }}</span>
                            </td>
                            <td>{{ $task->created_at->format('M d, Y') }}</td>
                            <td style="text-align: right;">
                                <a href="{{ route('admin.tasks.show', $task->id) }}" class="btn-info-sm">View Task</a>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    @endif
</div>
@endsection
