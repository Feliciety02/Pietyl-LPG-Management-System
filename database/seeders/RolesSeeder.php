<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;

class RolesSeeder extends Seeder
{
    public function run(): void
    {
        $roles = [
            'Owner Admin',
            'Accountant Bookkeeper',
            'Sales Cashier',
            'Inventory Stock Custodian',
            'Delivery Rider Driver',
        ];

        foreach ($roles as $role) {
            Role::firstOrCreate(['name' => $role]);
        }
    }
}
