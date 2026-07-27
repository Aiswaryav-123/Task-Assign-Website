@extends('users.layout')

@section('title', 'Task Details - Staff Portal')

@section('content')
<div class="card" style="max-width: 700px; margin: 0 auto;">
    <div class="card-header-flex">
        <div>
            <h1 class="card-title">Task Details</h1>
            <p style="color: var(--text-muted); font-size: 0.875rem;">Task #{{ $task->id }} • Assigned to you</p>
        </div>
        <a href="{{ route('staff.dashboard') }}" class="btn-secondary">← Back to My Tasks</a>
    </div>

    <!-- Title (View only - staff cannot edit) -->
    <div style="margin-bottom: 1.5rem; background: #e7f1ff; padding: 1rem 1.25rem; border-radius: 4px; border: 1px solid #b6d4fe;">
        <div style="color: #0c419a; font-size: 0.75rem; font-weight: 700; text-transform: uppercase; margin-bottom: 0.2rem;">Task Title</div>
        <h2 style="font-size: 1.2rem; font-weight: 700; color: #0d47a1;">{{ $task->title }}</h2>
    </div>

    <!-- Description (View only - staff cannot edit) -->
    <div style="margin-bottom: 1.5rem;">
        <div style="color: var(--text-muted); font-size: 0.8rem; font-weight: 600; text-transform: uppercase; margin-bottom: 0.4rem;">Description</div>
        <div style="background: #f8f9fa; border: 1px solid var(--border-color); padding: 1.25rem; border-radius: 4px; white-space: pre-line; line-height: 1.6; font-size: 0.95rem; color: #212529;">
            {{ $task->description }}
        </div>
    </div>

    <!-- Update Task Status Form (Status update only) -->
    <div style="background: #e7f1ff; border: 1px solid #b6d4fe; padding: 1.25rem; border-radius: 6px; margin-bottom: 1.5rem;">
        <h3 style="font-size: 0.95rem; font-weight: 700; margin-bottom: 0.75rem; color: #0c419a;">Update Task Status</h3>
        
        <form action="{{ route('staff.tasks.updateStatus', $task->id) }}" method="POST" id="update-status-form">
            @csrf
            @method('PATCH')

            <div style="display: flex; align-items: center; gap: 1rem; flex-wrap: wrap;">
                <div style="flex: 1; min-width: 200px;">
                    <select name="status" id="status" class="form-control" style="width: 100%; font-weight: 600;" required>
                        <option value="open" {{ $task->status === 'open' ? 'selected' : '' }}>⏳ Open (In Progress)</option>
                        <option value="completed" {{ $task->status === 'completed' ? 'selected' : '' }}>✅ Completed</option>
                    </select>
                </div>
                <button type="submit" class="btn-primary" id="save-status-btn">Save Status Update</button>
            </div>
        </form>
    </div>

    <div style="border-top: 1px solid var(--border-color); padding-top: 1rem; display: flex; justify-content: space-between; font-size: 0.8rem; color: var(--text-muted);">
        <span>Assigned Date: {{ $task->created_at->format('M d, Y h:i A') }}</span>
        <span>Last Updated: {{ $task->updated_at->format('M d, Y h:i A') }}</span>
    </div>
</div>
@endsection
