<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use App\Models\Admin;

class AdminSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $admin = (object)[
            'name' => 'Administrator',
            'email' => 'admin@admin.com',
            'phone' => '08122332233',
            'password' => Hash::make('password'),
            'email_verified_at' => now()
        ];

        Admin::updateOrCreate(
            [
                'email' => $admin->email,
            ],
            [
                'name' => $admin->name,
                'email' => $admin->email,
                'phone' => $admin->phone,
                'password' => $admin->password,
                'email_verified_at' => $admin->email_verified_at
            ]
        );
    }
}
