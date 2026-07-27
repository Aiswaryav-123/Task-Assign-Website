<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rule;

class StaffController extends Controller
{
    /**
     * Display a listing of staff members.
     */
    public function index(Request $request)
    {
        $query = User::staff();

        if ($request->filled('search')) {
            $search = $request->search;
            $query->where(function ($q) use ($search) {
                $q->where('name', 'like', "%{$search}%")
                  ->orWhere('email', 'like', "%{$search}%");
            });
        }

        $staffMembers = $query->withCount('tasks')->latest()->paginate(10);

        return view('admin.staff.index', compact('staffMembers'));
    }

    /**
     * Show the form for creating a new staff member.
     */
    public function create()
    {
        return view('admin.staff.create');
    }

    /**
     * Store a newly created staff member in storage.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users,email'],
            'password' => ['required', 'string', 'min:8'],
            'status' => ['required', Rule::in(['active', 'inactive'])],
        ]);

        User::create([
            'name' => $validated['name'],
            'email' => $validated['email'],
            'password' => Hash::make($validated['password']),
            'role' => 'staff',
            'status' => $validated['status'],
        ]);

        return redirect()->route('admin.staff.index')->with('status', 'Staff member created successfully!');
    }

    /**
     * Display the specified staff member.
     */
    public function show($id)
    {
        $staff = User::staff()->with('tasks')->findOrFail($id);
        return view('admin.staff.show', compact('staff'));
    }

    /**
     * Show the form for editing the specified staff member.
     */
    public function edit($id)
    {
        $staff = User::staff()->findOrFail($id);
        return view('admin.staff.edit', compact('staff'));
    }

    /**
     * Update the specified staff member in storage.
     */
    public function update(Request $request, $id)
    {
        $staff = User::staff()->findOrFail($id);

        $validated = $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', Rule::unique('users', 'email')->ignore($staff->id)],
            'password' => ['nullable', 'string', 'min:8'],
            'status' => ['required', Rule::in(['active', 'inactive'])],
        ]);

        $staffData = [
            'name' => $validated['name'],
            'email' => $validated['email'],
            'status' => $validated['status'],
        ];

        if (!empty($validated['password'])) {
            $staffData['password'] = Hash::make($validated['password']);
        }

        $staff->update($staffData);

        return redirect()->route('admin.staff.index')->with('status', 'Staff member updated successfully!');
    }

    /**
     * Soft delete the specified staff member.
     */
    public function destroy($id)
    {
        $staff = User::staff()->findOrFail($id);
        $staff->delete(); // Soft delete

        return redirect()->route('admin.staff.index')->with('status', 'Staff member deleted successfully (soft delete).');
    }
}
