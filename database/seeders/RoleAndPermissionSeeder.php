<?php

namespace Database\Seeders;

use App\Models\Permission;
use App\Models\Role;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class RoleAndPermissionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Permission::firstOrCreate(['name' => 'create-computer']);
        Permission::firstOrCreate(['name' => 'delete-computer']);
        Permission::firstOrCreate(['name' => 'edit-computer']);
        Permission::firstOrCreate(['name' => 'list-computer']);
        Permission::firstOrCreate(['name' => 'view-computer']);

        Permission::firstOrCreate(['name' => 'create-booking-computer']);
        Permission::firstOrCreate(['name' => 'cancel-booking-computer']);
        Permission::firstOrCreate(['name' => 'list-history-booking']);

        // New permissions
        Permission::firstOrCreate(['name' => 'create-walkin-booking']);
        Permission::firstOrCreate(['name' => 'reschedule-booking']);

        $admin_role = Role::firstOrCreate(['name' => 'admin']);
        $customer_role = Role::firstOrCreate(['name' => 'customer']);

        $admin_role->syncPermissions([
            'create-computer',
            'delete-computer',
            'edit-computer',
            'list-computer',
            'view-computer',
            'cancel-booking-computer',
            'list-history-booking',
            'create-walkin-booking',
        ]);

        $customer_role->syncPermissions([
            'list-computer',
            'view-computer',
            'cancel-booking-computer',
            'list-history-booking',
            'create-booking-computer',
            'reschedule-booking',
        ]);
    }
}
