<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;
use Illuminate\Support\Facades\Auth;

class RoleController extends Controller
{
    /**
     * Display a listing of the roles.
     */
    public function index()
    {
        /** @var User $user */
        $user = Auth::user();
        abort_unless($user->hasPermissionTo('roles.view'), 403, 'Unauthorized access.');

        // Fetch all roles
        $roles = Role::paginate(10);
        return view('admin.roles.index', compact('roles'));
    }

    /**
     * Show the form for creating a new role.
     */
    public function create()
    {
        /** @var User $user */
        $user = Auth::user();
        abort_unless($user->hasPermissionTo('roles.create'), 403, 'Unauthorized access.');

        // Fetch all available permissions to assign to the new role
        $permissions = Permission::all();
        return view('admin.roles.create', compact('permissions'));
    }

    /**
     * Store a newly created role in storage.
     */
    public function store(Request $request)
    {
        /** @var User $user */
        $user = Auth::user();
        abort_unless($user->hasPermissionTo('roles.create'), 403, 'Unauthorized access.');

        // Validate the role name and permissions
        $request->validate([
            'name' => 'required|unique:roles,name',
            'permissions' => 'required|array',
        ]);

        // Create the role
        $role = Role::create(['name' => $request->name, 'guard_name' => 'web']);

        // Sync the selected permissions to the role
        $role->syncPermissions($request->permissions);

        return redirect()->route('admin.roles.index')
            ->with('success', 'Role created successfully.');
    }

    /**
     * Show the form for editing the specified role.
     */
    public function edit(Role $role)
    {
        /** @var User $user */
        $user = Auth::user();
        abort_unless($user->hasPermissionTo('roles.edit'), 403, 'Unauthorized access.');

        // Fetch all permissions and currently assigned permissions
        $permissions = Permission::all();
        $rolePermissions = $role->permissions->pluck('name')->toArray();

        return view('admin.roles.edit', compact('role', 'permissions', 'rolePermissions'));
    }

    /**
     * Update the specified role in storage.
     */
    public function update(Request $request, Role $role)
    {
        /** @var User $user */
        $user = Auth::user();
        abort_unless($user->hasPermissionTo('roles.edit'), 403, 'Unauthorized access.');

        // Validate input data
        $request->validate([
            'name' => 'required|unique:roles,name,' . $role->id,
            'permissions' => 'required|array',
        ]);

        // Update role name
        $role->update(['name' => $request->name]);

        // Sync updated permissions
        $role->syncPermissions($request->permissions);

        return redirect()->route('admin.roles.index')
            ->with('success', 'Role updated successfully.');
    }

    /**
     * Remove the specified role from storage.
     */
    public function destroy(Role $role)
    {
        /** @var User $user */
        $user = Auth::user();
        abort_unless($user->hasPermissionTo('roles.delete'), 403, 'Unauthorized access.');

        // Delete the role
        $role->delete();

        return redirect()->route('admin.roles.index')
            ->with('success', 'Role deleted successfully.');
    }
}
