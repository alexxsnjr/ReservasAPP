<?php

use Illuminate\Database\Seeder;

class ProfesoresTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {

        $profesor = [
            'name' => 'Alex',
            'email'  => 'alex@gmail.com',
            'password' => bcrypt('123456'),
            'remember_token' => ' ',

        ];

        \App\Profesor::create($profesor);
    }
}
