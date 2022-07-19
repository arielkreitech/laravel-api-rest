<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $userAdmin = User::create([
            'name' => "Administrator",
            'email' => "admin@test.cu",
            'email_verified_at' => now(),
            'password' => bcrypt('123456A*'),
            'is_admin' => 1
]);
    }
}
