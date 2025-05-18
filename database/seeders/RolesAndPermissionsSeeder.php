<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;

class RolesAndPermissionsSeeder extends Seeder
{
    public function run()
    {
        // Reset cached roles and permissions
        app()[\Spatie\Permission\PermissionRegistrar::class]->forgetCachedPermissions();

        // Define permissions
        $permissions = [
            'view super admin dashboard', // super admin
            'view companies', // super admin
            'create company', // super admin
            'edit company', // super admin
            'delete company', // super admin
            'view users', // super admin
            'create user', // super admin
            'edit user', // super admin
            'view admin dashboard', // admin
            'view dashboard', // qc - supervisor - segment qc
            'view inspections', // qc - supervisor - segment qc
            'create inspection', // qc - supervisor - segment qc
            'edit inspection', // qc -supervisor - segment qc
            'view all inspections', // super admin - admin
            'inspector view inspections' // inspector
        ];

        foreach ($permissions as $permission) {
            Permission::create(['name' => $permission]);
        }

        // Define roles and assign permissions
        Role::create(['name' => 'super admin'])->givePermissionTo('view companies','create company','edit company','delete company','view users','create user','edit user','view all inspections');
        Role::create(['name' => 'admin'])->givePermissionTo('view all inspections');
        Role::create(['name' => 'inspector'])->givePermissionTo('inspector view inspections');
        Role::create(['name' => 'qc'])->givePermissionTo('view inspections','create inspection','edit inspection');
        Role::create(['name' => 'segment qc'])->givePermissionTo('view inspections','create inspection','edit inspection');
        Role::create(['name' => 'supervisor'])->givePermissionTo('view inspections','create inspection','edit inspection');
    }
}
