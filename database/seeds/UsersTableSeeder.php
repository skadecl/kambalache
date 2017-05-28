<?php

use Illuminate\Database\Seeder;
use Illuminate\Database\Eloquent\Model;


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
        'password' => '$2a$06$PtILtVy01ofUj8IKNAvpK.Y0G4AzdTPSNuK063k8QTh6oB9lvvKwa',
        'region' => 13,
        'address' => 'Vicuña Mackenna 123',
        'access' => 5
      ]);
    }
}
