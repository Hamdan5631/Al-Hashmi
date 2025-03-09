<?php

namespace Database\Seeders;

use App\Enums\Admin\AdminRoles;
use App\Models\Admin;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class AdminSeeder extends Seeder
{
    public function run(): void
    {
        $adminEmail = 'admin@petbidding.com';

        $admin = Admin::query()->where('email', $adminEmail)->first();

        if (!$admin) {
            $admin = new Admin();
        }

        $admin->name = 'Admin';
        $admin->email = 'admin@alhashmi.com';
        $admin->password = Hash::make('password');
        $admin->role = AdminRoles::SUPER_ADMIN;
        $admin->save();
    }
}
