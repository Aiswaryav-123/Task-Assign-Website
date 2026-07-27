@extends('admin.layout')

@section('title', 'Edit Staff - Admin Panel')

@section('content')
<div class="card" style="max-width: 600px; margin: 0 auto;">
    <div class="card-header-flex">
        <h1 class="card-title">Edit Staff Member</h1>
        <a href="{{ route('admin.staff.index') }}" class="btn-secondary">← Back to Staff List</a>
    </div>

    <form action="{{ route('admin.staff.update', $staff->id) }}" method="POST" id="edit-staff-form">
        @csrf
        @method('PUT')

        <div class="form-group">
            <label for="name" class="form-label">Full Name *</label>
            <input 
                type="text" 
                name="name" 
                id="name" 
                class="form-control" 
                value="{{ old('name', $staff->name) }}" 
                required
            >
            @error('name')
                <div class="error-message">{{ $message }}</div>
            @enderror
        </div>

        <div class="form-group">
            <label for="email" class="form-label">Email Address *</label>
            <input 
                type="email" 
                name="email" 
                id="email" 
                class="form-control" 
                value="{{ old('email', $staff->email) }}" 
                required
            >
            @error('email')
                <div class="error-message">{{ $message }}</div>
            @enderror
        </div>

        <div class="form-group">
            <label for="password" class="form-label">New Password (Leave blank to keep unchanged)</label>
            <input 
                type="password" 
                name="password" 
                id="password" 
                class="form-control" 
                placeholder="•••••••• (Optional, min. 8 characters)"
            >
            @error('password')
                <div class="error-message">{{ $message }}</div>
            @enderror
        </div>

        <div class="form-group">
            <label for="status" class="form-label">Account Status *</label>
            <select name="status" id="status" class="form-control" required>
                <option value="active" {{ old('status', $staff->status) === 'active' ? 'selected' : '' }}>Active</option>
                <option value="inactive" {{ old('status', $staff->status) === 'inactive' ? 'selected' : '' }}>Inactive</option>
            </select>
            @error('status')
                <div class="error-message">{{ $message }}</div>
            @enderror
        </div>

        <div style="display: flex; gap: 1rem; margin-top: 1.5rem;">
            <button type="submit" class="btn-primary" id="update-staff-btn">Update Staff Account</button>
            <a href="{{ route('admin.staff.index') }}" class="btn-secondary">Cancel</a>
        </div>
    </form>
</div>
@endsection
