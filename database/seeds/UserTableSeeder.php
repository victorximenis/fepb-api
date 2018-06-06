<?php

use Illuminate\Database\Seeder;

class UserTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('users')->insert([
            'name' => 'Victor Ximenis',
            'email' => 'victorximenis@gmail.com',
            'password' => app('hash')->make('123123'),
            'remember_token' => str_random(10),
        ]);
    }
}
