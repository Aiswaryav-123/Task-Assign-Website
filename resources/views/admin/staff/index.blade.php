@extends('admin.layout')

@section('title', 'Staff Management - Admin Panel')

@section('content')
<div class="card">
    <div class="card-header-flex">
        <div>
            <h1 class="card-title">Staff Members</h1>
            <p style="color: var(--text-muted); font-size: 0.875rem;">Manage staff user accounts and permissions</p>
        </div>
        <a href="{{ route('admin.staff.create') }}" class="btn-primary" id="btn-add-new-staff">+ Add New Staff</a>
    </div>

    <!-- Search Bar -->
    <form action="{{ route('admin.staff.index') }}" method="GET" style="margin-bottom: 1.25rem; display: flex; gap: 0.75rem;">
        <input 
            type="text" 
            name="search" 
            value="{{ request('search') }}" 
            placeholder="Search by name or email..." 
            class="form-control" 
            style="max-width: 320px;"
            id="staff-search-input"
        >
        <button type="submit" class="btn-secondary">Search</button>
        @if(request('search'))
            <a href="{{ route('admin.staff.index') }}" class="btn-secondary">Clear</a>
        @endif
    </form>

    @if($staffMembers->isEmpty())
        <div style="text-align: center; padding: 2rem; color: var(--text-muted);">
            No staff members found.
        </div>
    @else
        <div class="table-responsive">
            <table class="data-table">
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Name</th>
                        <th>Email</th>
                        <th>Status</th>
                        <th>Assigned Tasks</th>
                        <th>Created At</th>
                        <th style="text-align: right;">Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($staffMembers as $staff)
                        <tr>
                            <td>#{{ $staff->id }}</td>
                            <td><strong>{{ $staff->name }}</strong></td>
                            <td>{{ $staff->email }}</td>
                            <td>
                                <span class="badge badge-{{ $staff->status }}">
                                    {{ ucfirst($staff->status) }}
                                </span>
                            </td>
                            <td>{{ $staff->tasks_count }} tasks</td>
                            <td>{{ $staff->created_at->format('M d, Y') }}</td>
                            <td style="text-align: right;">
                                <div style="display: inline-flex; gap: 0.4rem;">
                                    <a href="{{ route('admin.staff.show', $staff->id) }}" class="btn-info-sm" id="view-staff-{{ $staff->id }}">View</a>
                                    <a href="{{ route('admin.staff.edit', $staff->id) }}" class="btn-edit-sm" id="edit-staff-{{ $staff->id }}">Edit</a>
                                    <form action="{{ route('admin.staff.destroy', $staff->id) }}" method="POST" style="display: inline;" onsubmit="return confirmDelete(event, 'staff member')">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn-danger-sm" id="delete-staff-{{ $staff->id }}">Delete</button>
                                    </form>
                                </div>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>

        <div style="margin-top: 1.25rem;">
            {{ $staffMembers->links() }}
        </div>
    @endif
</div>
@endsection
