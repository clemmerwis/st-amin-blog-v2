<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use App\Models\User;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        User::create([
            'name' => 'Test Man',
            'email' => 'test@testmail.com',
            'is_admin' => 1,
            'password' => Hash::make("password")
        ]);

        User::factory()->count(2)->create();
    }
}
