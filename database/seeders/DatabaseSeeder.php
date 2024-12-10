<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;
use Spatie\Permission\Models\Role;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // Rollar mavjudligini tekshirish va yaratish
        if (!Role::where('name', 'admin')->exists()) {
            Role::create(['name' => 'admin']);
        }

        if (!Role::where('name', 'user')->exists()) {
            Role::create(['name' => 'user']);
        }

        // Admin foydalanuvchisini yaratish
        $admin = User::firstOrCreate(
            ['email' => 'admin@gmail.com'],
            [
                'name' => 'Admin',
                'password' => bcrypt('adminpassword'),
            ]
        );

        $admin->assignRole('admin'); // Admin rolini biriktirish

        // Oddiy foydalanuvchilarni yaratish
        User::factory(10)->create()->each(function ($user) {
            $user->assignRole('user');
        });
    }
}
