<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\User;
use Spatie\Permission\Models\Role;
use Illuminate\Support\Facades\Hash;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $user = User::create([
            'name' => 'Anik P',
            'email' => 'anik@gmail.com',
            'password' => Hash::make('12345678'),
        ]);
        $user->assignRole('admin');

        // Create 49 fake users
        User::factory()->count(49)->create()->each(function ($user, $index) {
            if ($index < 1) {
                $user->assignRole('admin');
            } elseif ($index < 4) {
                $user->assignRole('employee');
            }
        });
    }
}

