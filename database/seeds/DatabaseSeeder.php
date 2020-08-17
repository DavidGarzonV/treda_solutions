<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        DB::table('users')->insert([
            'id' => 1,
            'name' => 'Test',
            'email' => 'test@test.com',
            'password' => '$2y$10$p.OyTPYJba4OE9RhDmBZPeYfb5rijArRrAqHGz.dbeVkL6YGeMOaO',
            'remember_token' => Str::random(10),
        ]);
    }
}
