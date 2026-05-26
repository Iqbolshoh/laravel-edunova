<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Spatie\Permission\Models\{Role, Permission};
use App\Models\User;

/**
 * Class RolePermissionSeeder
 *
 * Sets up RBAC using Spatie Permission package, creating superadmin, teacher, and student roles.
 */
class RolePermissionSeeder extends Seeder
{
    /*
    |---------------------------------------------------------------
    | run
    |---------------------------------------------------------------
    | Seeds roles, permissions, and users for RBAC setup.
    |
    */
    public function run(): void
    {
        /*
        |---------------------------------------------------------------
        | config
        |---------------------------------------------------------------
        | Defines permissions, roles, and users for seeding.
        |
        */
        $config = [
            /*
            |---------------------------------------------------------------
            | permissions
            |---------------------------------------------------------------
            | Defines resources and their allowed actions for an educational platform.
            |
            */
            'permissions' => [
                'roles' => ['view', 'create', 'edit', 'delete', 'assign'],
                'users' => ['view', 'create', 'edit', 'delete'],
                'courses' => ['view', 'create', 'edit', 'delete', 'enroll'],
                'lessons' => ['view', 'create', 'edit', 'delete', 'complete'],
            ],

            /*
            |---------------------------------------------------------------
            | roles
            |---------------------------------------------------------------
            | Maps superadmin, teacher, and student roles to permissions.
            |
            */
            'roles' => [
                'superadmin' => [], // Gets all permissions automatically

                'teacher' => [
                    'courses' => ['view', 'create', 'edit', 'delete'],
                    'lessons' => ['view', 'create', 'edit', 'delete'],
                    'users' => ['view'],
                ],

                'student' => [
                    'courses' => ['view', 'enroll'],
                    'lessons' => ['view', 'complete'],
                ],
            ],

            /*
            |---------------------------------------------------------------
            | users_by_role
            |---------------------------------------------------------------
            | Groups users by superadmin, teacher, and student roles.
            | Matches the users created in UserSeeder.
            |
            */
            'users_by_role' => [
                'superadmin' => [
                    [
                        'name' => 'Super Admin',
                        'email' => 'admin@templates.uz',
                        'password' => bcrypt('$qb01S7#o&05'),
                    ],
                ],

                'teacher' => [
                    [
                        'name' => 'Teacher',
                        'email' => 'teacher@templates.uz',
                        'password' => bcrypt('$qb01S7#o&05'),
                    ],
                ],

                'student' => [
                    [
                        'name' => 'Student',
                        'email' => 'student@templates.uz',
                        'password' => bcrypt('$qb01S7#o&05'),
                    ],
                ],
            ],
        ];

        /*
        |---------------------------------------------------------------
        | createPermissions
        |---------------------------------------------------------------
        | Creates permissions for defined resources and actions.
        |
        */
        collect($config['permissions'])->each(
            fn($actions, $resource) =>
            collect($actions)->each(
                fn($action) =>
                Permission::firstOrCreate(['name' => "$resource.$action", 'guard_name' => 'web'])
            )
        );

        /*
        |---------------------------------------------------------------
        | createRolesAndAssignPermissions
        |---------------------------------------------------------------
        | Creates roles and syncs their specific permissions.
        |
        */
        collect($config['roles'])->each(function ($permissions, $roleName) {
            $role = Role::firstOrCreate(['name' => $roleName, 'guard_name' => 'web']);

            // Superadmin gets all permissions, others get specified ones
            $perms = $roleName === 'superadmin' ? Permission::pluck('name') : collect($permissions)
                ->flatMap(fn($actions, $resource) => collect($actions)->map(fn($action) => "$resource.$action"));

            $role->syncPermissions($perms);
        });

        /*
        |---------------------------------------------------------------
        | createUsersAndAssignRoles
        |---------------------------------------------------------------
        | Creates users and assigns them to their respective roles.
        |
        */
        collect($config['users_by_role'])->each(
            fn($users, $roleName) =>
            collect($users)->each(fn($userData) => User::firstOrCreate(
                ['email' => $userData['email']],
                [
                    'name' => $userData['name'],
                    'password' => $userData['password'],
                ],
            )->syncRoles($roleName))
        );

        /*
        |---------------------------------------------------------------
        | outputSuccessMessage
        |---------------------------------------------------------------
        | Outputs success message after seeding.
        |
        */
        $this->command->info('2. Superadmin, teacher, and student roles seeded successfully!');
    }
}
