<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class UsersSeeder extends Seeder
{
    public function run(): void
    {
        // Owner Admin
        $admin = User::firstOrCreate(
            ['email' => 'admin@pietyl.test'],
            [
                'name' => 'Owner Admin',
                'password' => Hash::make('password'),
                'is_active' => true,
            ]
        );
        $admin->syncRoles(['Owner Admin']);

        // Accountant
        $accountant = User::firstOrCreate(
            ['email' => 'accountant@pietyl.test'],
            [
                'name' => 'Accountant',
                'password' => Hash::make('password'),
                'is_active' => true,
            ]
        );
        $accountant->syncRoles(['Accountant Bookkeeper']);

        // Sales Cashier
        $cashier = User::firstOrCreate(
            ['email' => 'cashier@pietyl.test'],
            [
                'name' => 'Sales Cashier',
                'password' => Hash::make('password'),
                'is_active' => true,
            ]
        );
        $cashier->syncRoles(['Sales Cashier']);

        // Inventory Custodian
        $inventory = User::firstOrCreate(
            ['email' => 'inventory@pietyl.test'],
            [
                'name' => 'Inventory Custodian',
                'password' => Hash::make('password'),
                'is_active' => true,
            ]
        );
        $inventory->syncRoles(['Inventory Stock Custodian']);

        // Delivery Rider
        $rider = User::firstOrCreate(
            ['email' => 'rider@pietyl.test'],
            [
                'name' => 'Delivery Rider',
                'password' => Hash::make('password'),
                'is_active' => true,
            ]
        );
        $rider->syncRoles(['Delivery Rider Driver']);
    }
}
