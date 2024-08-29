<?php

namespace Database\Seeders;

use App\Enums\RoleEnum;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class RolePermissionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $rolesWithPermissions = [
            enum_value(RoleEnum::ADMIN) => ['all-access'],
            enum_value(RoleEnum::OFFICER) => ['officer'],
            enum_value(RoleEnum::USER)=> ['user'],
        ];

        foreach ($rolesWithPermissions as $roleName => $permissions) {
            $role = \Spatie\Permission\Models\Role::create(['name' => $roleName, 'guard_name' => 'web']);
            foreach ($permissions as $permission) {
                \Spatie\Permission\Models\Permission::firstOrCreate(
                    ['name' => $permission, 'guard_name' => 'web']
                );
                $role->givePermissionTo($permission);
            }
        }
    }

}
