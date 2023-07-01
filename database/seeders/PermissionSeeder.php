<?php

namespace Database\Seeders;

use App\Enums\Roles;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;

class PermissionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        app()[\Spatie\Permission\PermissionRegistrar::class]->forgetCachedPermissions();

        $permissionsConfig = config('users-permissions');

        foreach ($permissionsConfig as $group) {
            foreach ($group as $permission) {
                Permission::create(['name' => $permission]);
            }
        }

        /* ------------------Customer---------------- */
        $customer = Role::create(['name' => Roles::Customer->value]);
        $customer->givePermissionTo(array_values($permissionsConfig['account']));

        /* ------------------Editor------------------ */
        $editorPermissions = array_merge(
            array_values($permissionsConfig['categories']),
            array_values($permissionsConfig['products']),
        );
        $editor = Role::create(['name' => Roles::Editor->value]);
        $editor->givePermissionTo($editorPermissions);

        /* ------------------Manager------------------ */
        $manager = Role::create(['name' => Roles::Manager->value]);
        $manager->givePermissionTo(array_merge(
            $editorPermissions,
            array_values($permissionsConfig['orders']),
        ));

        /* ------------------Admin-------------------- */
        $role = Role::create(['name' => Roles::Admin->value]);
        $role->givePermissionTo(Permission::all());
    }
}
