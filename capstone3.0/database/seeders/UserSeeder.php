<?php

namespace Database\Seeders;
use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run()
    {
        User::create([
            'name' => 'Aron Malicdem',
            'email' => 'aaron@gmail.com',
            'password' => bcrypt('admin'),
            'role_id' => 1,
        ]);
    }
}
