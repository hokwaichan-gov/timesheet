<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\User;

class AdminSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $user = User::create([
            'first_name' => 'Admin',
            'last_name' => 'User',
            'email' => 'admin@email.com',
            'password' => bcrypt('password'),
            'user_type' => 'admin',
        ]);

        $user->employee()->create([
            'name' => $user->first_name . ' ' . $user->last_name,
        ]);
    }
}
