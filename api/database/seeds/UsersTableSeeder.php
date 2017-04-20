<?php

use Illuminate\Database\Seeder;

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
        'first_name' => 'Roberto',
        'last_name' => 'Román',
        'email' => 'rf.romang@gmail.com',
        'password' => '1234',
        'access' => 5
      ]);
    }
}
