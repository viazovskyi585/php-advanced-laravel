<?php

namespace Database\Seeders;

use App\Enums\Roles;
use App\Models\User;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Seeder;

class UserSeeder extends Seeder
{
    const ADMIN_EMAIL = 'admin@example.com';
    /**
     * Run the database seeds.
     */

    protected function assignRoles(array | Collection $users, Roles $role): void
    {
        foreach ($users as $user) {
            $user->assignRole($role->value);
        }
    }

    protected function createAdmin(): void
    {
        if (!User::where('email', self::ADMIN_EMAIL)->exists()) {
            $admin = User::factory()->withEmail(self::ADMIN_EMAIL)->create();
            $this->assignRoles([$admin], Roles::ADMIN);
        }
    }

    protected function createManagers(): void
    {
        $managers = User::factory()->count(2)->create();
        $this->assignRoles($managers, Roles::MANAGER);
    }

    protected function createEditors(): void
    {
        $editors = User::factory()->count(2)->create();
        $this->assignRoles($editors, Roles::EDITOR);
    }

    protected function createCustomers(): void
    {
        $customers = User::factory()->count(10)->create();
        $this->assignRoles($customers, Roles::CUSTOMER);
    }

    public function run(): void
    {
        $this->createAdmin();
        $this->createManagers();
        $this->createEditors();
        $this->createCustomers();
    }
}
