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

        $user = [
            'name' => 'Admin',
            'email'  => 'admin@admin.com',
            'password' => bcrypt('123456'),
            'remember_token' => ' ',
        ];

        \App\User::create($user);
    }
}
