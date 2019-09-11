<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('users')->insert([
            'name' => "Clane Tester",
            'email' => 'clane.tester@gmail.com',
            'password' => Hash::make('password'),
        ]);
    }
}
