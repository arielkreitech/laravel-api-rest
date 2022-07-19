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
            'phone' => 555555,
            'id_card' => 'K278978',
            'date_of_birth' => now(),
            'city_code' => 82100,
            'is_admin' => 1
]);
    }
}
