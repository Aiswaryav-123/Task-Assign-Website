@extends('admin.layout')

@section('title', 'Edit Task - Admin Panel')

@section('content')
<div class="card" style="max-width: 650px; margin: 0 auto;">
    <div class="card-header-flex">
        <h1 class="card-title">Edit Task</h1>
        <a href="{{ route('admin.tasks.index') }}" class="btn-secondary">← Back to Task List</a>
    </div>

    <form action="{{ route('admin.tasks.update', $task->id) }}" method="POST" id="edit-task-form">
        @csrf
        @method('PUT')

        <div class="form-group">
            <label for="title" class="form-label">Task Title *</label>
            <input 
                type="text" 
                name="title" 
                id="title" 
                class="form-control" 
                value="{{ old('title', $task->title) }}" 
                required
            >
            @error('title')
                <div class="error-message">{{ $message }}</div>
            @enderror
        </div>

        <div class="form-group">
            <label for="description" class="form-label">Task Description *</label>
            <textarea 
                name="description" 
                id="description" 
                rows="4" 
                class="form-control" 
                required
            >{{ old('description', $task->description) }}</textarea>
            @error('description')
                <div class="error-message">{{ $message }}</div>
            @enderror
        </div>

        <div class="form-group">
            <label for="user_id" class="form-label">Assign to Staff Member *</label>
            <select name="user_id" id="user_id" class="form-control" required>
                @foreach($staffMembers as $staff)
                    <option value="{{ $staff->id }}" {{ old('user_id', $task->user_id) == $staff->id ? 'selected' : '' }}>
                        {{ $staff->name }} ({{ $staff->email }})
                    </option>
                @endforeach
            </select>
            @error('user_id')
                <div class="error-message">{{ $message }}</div>
            @enderror
        </div>

        <div class="form-group">
            <label for="status" class="form-label">Task Status *</label>
            <select name="status" id="status" class="form-control" required>
                <option value="open" {{ old('status', $task->status) === 'open' ? 'selected' : '' }}>Open</option>
                <option value="completed" {{ old('status', $task->status) === 'completed' ? 'selected' : '' }}>Completed</option>
            </select>
            @error('status')
                <div class="error-message">{{ $message }}</div>
            @enderror
        </div>

        <div style="display: flex; gap: 1rem; margin-top: 1.5rem;">
            <button type="submit" class="btn-primary" id="update-task-btn">Update Task</button>
            <a href="{{ route('admin.tasks.index') }}" class="btn-secondary">Cancel</a>
        </div>
    </form>
</div>
@endsection
