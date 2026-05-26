<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Spatie\Permission\Models\Role;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;

class UserController extends Controller
{
    /**
     * Display a listing of the users.
     */
    public function index()
    {
        /** @var User $user */
        $user = Auth::user();
        abort_unless($user->hasPermissionTo('users.view'), 403, 'Unauthorized access.');

        // Fetch all users with their associated roles
        $users = User::with('roles')->paginate(10);
        return view('admin.users.index', compact('users'));
    }

    /**
     * Show the form for creating a new user.
     */
    public function create()
    {
        /** @var User $user */
        $user = Auth::user();
        abort_unless($user->hasPermissionTo('users.create'), 403, 'Unauthorized access.');

        // Fetch all roles to display in the role selection dropdown
        $roles = Role::all();
        return view('admin.users.create', compact('roles'));
    }

    /**
     * Store a newly created user in storage and assign roles.
     */
    public function store(Request $request)
    {
        /** @var User $user */
        $user = Auth::user();
        abort_unless($user->hasPermissionTo('users.create'), 403, 'Unauthorized access.');

        // Validate incoming request data
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users',
            'password' => 'required|string|min:8|confirmed',
            'roles' => 'required|array', // Ensure roles are passed as an array
        ]);

        // Create the new user
        $userModel = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
        ]);

        // Assign selected roles to the user
        $userModel->syncRoles($request->roles);

        return redirect()->route('admin.users.index')
            ->with('success', 'User created successfully.');
    }

    /**
     * Show the form for editing the specified user.
     */
    public function edit(User $user)
    {
        /** @var User $currentUser */
        $currentUser = Auth::user();
        abort_unless($currentUser->hasPermissionTo('users.edit'), 403, 'Unauthorized access.');

        // Fetch all roles to display in the edit form
        $roles = Role::all();
        // Get roles currently assigned to the user
        $userRoles = $user->roles->pluck('name')->toArray();

        return view('admin.users.edit', compact('user', 'roles', 'userRoles'));
    }

    /**
     * Update the specified user in storage and sync roles.
     */
    public function update(Request $request, User $user)
    {
        /** @var User $currentUser */
        $currentUser = Auth::user();
        abort_unless($currentUser->hasPermissionTo('users.edit'), 403, 'Unauthorized access.');

        // Validate incoming request data
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users,email,' . $user->id,
            'roles' => 'required|array',
        ]);

        // Update user basic information
        $user->update([
            'name' => $request->name,
            'email' => $request->email,
        ]);

        // Update password only if a new one is provided
        if ($request->filled('password')) {
            $request->validate(['password' => 'string|min:8|confirmed']);
            $user->update(['password' => Hash::make($request->password)]);
        }

        // Sync the updated roles to the user
        $user->syncRoles($request->roles);

        return redirect()->route('admin.users.index')
            ->with('success', 'User updated successfully.');
    }

    /**
     * Remove the specified user from storage.
     */
    public function destroy(User $user)
    {
        /** @var User $currentUser */
        $currentUser = Auth::user();
        abort_unless($currentUser->hasPermissionTo('users.delete'), 403, 'Unauthorized access.');

        // Delete the user from the database
        $user->delete();

        return redirect()->route('admin.users.index')
            ->with('success', 'User deleted successfully.');
    }
}
