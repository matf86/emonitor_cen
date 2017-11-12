<?php

use Illuminate\Database\Seeder;

class TestUsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run(Faker\Generator $faker)
    {
        DB::table('users')->insert([
            'name' => 'Test_Name',
            'email' => $faker->email,
            'password' => 'secret',
        ]);
    }
}
