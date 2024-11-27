<?php

namespace Database\Seeders;

use App\Models\roleModel;
use App\Models\User;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        roleModel::insert([
            'nama_role' => 'admin'
        ]);
        roleModel::insert([
            'nama_role' => 'user'
        ]);

        User::insert([
            'name' => 'admin username',
            'email' => 'admin@gmail.com',
            'role_id' => 1,
            'password' => bcrypt(1234567890)
        ]);
    }
}