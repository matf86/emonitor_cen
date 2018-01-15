<?php

use Illuminate\Database\Seeder;

class DevUsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('users')->insert([
            'name' => 'Mateusz',
            'email' => 'mat@example.com',
            'password' => bcrypt('123456'),
        ]);
    }
}
