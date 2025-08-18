<?php
namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

class AdminUserSeeder extends Seeder
{
    public function run()
    {
        $exists = \App\Models\User::where('email', 'admin@admin.com')->exists();
        if (!$exists) {
            \App\Models\User::create([
                'name' => 'Admin',
                'email' => 'admin@admin.com',
                'email_verified_at' => Carbon::now(),
                'password' => Hash::make('admin123'),
                'role' => 'admin',
                'remember_token' => 'admin_token',
            ]);
        }
    }
}
