@extends('admin.layout')

@section('title', 'Task Details - Admin Panel')

@section('content')
<div class="card" style="max-width: 750px; margin: 0 auto;">
    <div class="card-header-flex">
        <div>
            <h1 class="card-title">Task #{{ $task->id }}: {{ $task->title }}</h1>
            <p style="color: var(--text-muted); font-size: 0.875rem;">Created {{ $task->created_at->format('M d, Y h:i A') }}</p>
        </div>
        <div style="display: flex; gap: 0.5rem;">
            <a href="{{ route('admin.tasks.edit', $task->id) }}" class="btn-edit-sm" style="padding: 0.5rem 1rem; font-size: 0.85rem;">Edit Task</a>
            <a href="{{ route('admin.tasks.index') }}" class="btn-secondary">← Back to Tasks</a>
        </div>
    </div>

    <div style="display: grid; grid-template-columns: 1fr 1fr; gap: 1.5rem; margin-bottom: 1.5rem; background: rgba(15, 23, 42, 0.6); padding: 1.25rem; border-radius: var(--radius-md); border: 1px solid var(--border-color);">
        <div>
            <div style="color: var(--text-muted); font-size: 0.8rem; text-transform: uppercase;">Assigned Staff Member</div>
            <div style="font-size: 1.05rem; font-weight: 700; margin-top: 0.2rem;">
                {{ $task->user->name ?? 'Unassigned' }}
            </div>
            <div style="font-size: 0.85rem; color: var(--text-muted);">{{ $task->user->email ?? '' }}</div>
        </div>

        <div>
            <div style="color: var(--text-muted); font-size: 0.8rem; text-transform: uppercase;">Current Status</div>
            <div style="margin-top: 0.4rem;">
                <span class="badge badge-{{ $task->status }}">{{ ucfirst($task->status) }}</span>
            </div>
        </div>
    </div>

    <div style="margin-bottom: 1.5rem;">
        <h3 style="font-size: 1rem; font-weight: 600; margin-bottom: 0.5rem; color: var(--text-muted);">Description</h3>
        <div style="background: rgba(15, 23, 42, 0.4); border: 1px solid var(--border-color); padding: 1.25rem; border-radius: var(--radius-md); white-space: pre-line; line-height: 1.6; font-size: 0.95rem;">
            {{ $task->description }}
        </div>
    </div>

    <div style="display: flex; justify-content: space-between; align-items: center; border-top: 1px solid var(--border-color); padding-top: 1rem; color: var(--text-muted); font-size: 0.8rem;">
        <span>Last Updated: {{ $task->updated_at->format('M d, Y h:i A') }}</span>
        <form action="{{ route('admin.tasks.destroy', $task->id) }}" method="POST" onsubmit="return confirmDelete(event, 'task')">
            @csrf
            @method('DELETE')
            <button type="submit" class="btn-danger-sm">Delete Task</button>
        </form>
    </div>
</div>
@endsection
