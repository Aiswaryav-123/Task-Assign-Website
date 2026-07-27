@extends('admin.layout')

@section('title', 'Task Management - Admin Panel')

@section('content')
<div class="card">
    <div class="card-header-flex">
        <div>
            <h1 class="card-title">Task Management</h1>
            <p style="color: var(--text-muted); font-size: 0.875rem;">Create, edit, assign, and track staff tasks</p>
        </div>
        <a href="{{ route('admin.tasks.create') }}" class="btn-primary" id="btn-create-new-task">+ Create New Task</a>
    </div>

    <!-- Filter & Search -->
    <form action="{{ route('admin.tasks.index') }}" method="GET" style="margin-bottom: 1.25rem; display: flex; flex-wrap: wrap; gap: 0.75rem;">
        <input 
            type="text" 
            name="search" 
            value="{{ request('search') }}" 
            placeholder="Search by title or description..." 
            class="form-control" 
            style="max-width: 280px;"
            id="task-search-input"
        >
        <select name="status" class="form-control" style="max-width: 160px;" id="task-filter-status">
            <option value="">All Statuses</option>
            <option value="open" {{ request('status') === 'open' ? 'selected' : '' }}>Open</option>
            <option value="completed" {{ request('status') === 'completed' ? 'selected' : '' }}>Completed</option>
        </select>
        <select name="staff_id" class="form-control" style="max-width: 200px;" id="task-filter-staff">
            <option value="">All Staff Members</option>
            @foreach($staffMembers as $staff)
                <option value="{{ $staff->id }}" {{ request('staff_id') == $staff->id ? 'selected' : '' }}>{{ $staff->name }}</option>
            @endforeach
        </select>
        <button type="submit" class="btn-secondary">Filter</button>
        @if(request('search') || request('status') || request('staff_id'))
            <a href="{{ route('admin.tasks.index') }}" class="btn-secondary">Clear</a>
        @endif
    </form>

    @if($tasks->isEmpty())
        <div style="text-align: center; padding: 2rem; color: var(--text-muted);">
            No tasks found matching criteria.
        </div>
    @else
        <div class="table-responsive">
            <table class="data-table">
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Title</th>
                        <th>Assigned Staff</th>
                        <th>Status</th>
                        <th>Created Date</th>
                        <th style="text-align: right;">Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($tasks as $task)
                        <tr>
                            <td>#{{ $task->id }}</td>
                            <td><strong>{{ $task->title }}</strong></td>
                            <td>
                                @if($task->user)
                                    <span style="font-weight: 500;">{{ $task->user->name }}</span>
                                    <br><small style="color: var(--text-muted);">{{ $task->user->email }}</small>
                                @else
                                    <span style="color: var(--text-muted); italic">Unassigned</span>
                                @endif
                            </td>
                            <td>
                                <span class="badge badge-{{ $task->status }}">
                                    {{ ucfirst($task->status) }}
                                </span>
                            </td>
                            <td>{{ $task->created_at->format('M d, Y') }}</td>
                            <td style="text-align: right;">
                                <div style="display: inline-flex; gap: 0.4rem;">
                                    <a href="{{ route('admin.tasks.show', $task->id) }}" class="btn-info-sm" id="view-task-{{ $task->id }}">View</a>
                                    <a href="{{ route('admin.tasks.edit', $task->id) }}" class="btn-edit-sm" id="edit-task-{{ $task->id }}">Edit</a>
                                    <form action="{{ route('admin.tasks.destroy', $task->id) }}" method="POST" style="display: inline;" onsubmit="return confirmDelete(event, 'task')">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn-danger-sm" id="delete-task-{{ $task->id }}">Delete</button>
                                    </form>
                                </div>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>

        <div style="margin-top: 1.25rem;">
            {{ $tasks->links() }}
        </div>
    @endif
</div>
@endsection
